<?php

class ReviewRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findAll(): array {
        $stmt = $this->db->query(
            'SELECT r.*, a.name as author_name
             FROM review r
             LEFT JOIN author a ON a.id = r.author_id'
        );
        return array_map(fn($row) => new Review($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function findByTourOperator(int $tourOperatorId): array {
        // grade : on prend review.grade, et à défaut (avis anciens dont la note
        // est stockée dans la table score) on retombe sur score.value.
        $stmt = $this->db->prepare(
            'SELECT r.id, r.message, r.tour_operator_id, r.author_id,
                    a.name AS author_name,
                    COALESCE(r.grade, s.value) AS grade
             FROM review r
             LEFT JOIN author a ON a.id = r.author_id
             LEFT JOIN score  s ON s.tour_operator_id = r.tour_operator_id
                                AND s.author_id = r.author_id
             WHERE r.tour_operator_id = ?
             ORDER BY r.id DESC'
        );
        $stmt->execute([$tourOperatorId]);
        return array_map(fn($row) => new Review($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function create(string $message, int $tourOperatorId, int $authorId, ?int $grade = null): bool {
        $stmt = $this->db->prepare(
            'INSERT INTO review (message, grade, tour_operator_id, author_id) VALUES (?, ?, ?, ?)'
        );
        return $stmt->execute([$message, $grade, $tourOperatorId, $authorId]);
    }
}
