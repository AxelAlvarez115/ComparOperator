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
        $stmt = $this->db->prepare(
            'SELECT r.*, a.name as author_name
             FROM review r
             LEFT JOIN author a ON a.id = r.author_id
             WHERE r.tour_operator_id = ?
             ORDER BY r.id DESC'
        );
        $stmt->execute([$tourOperatorId]);
        return array_map(fn($row) => new Review($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function create(string $message, int $tourOperatorId, int $authorId): bool {
        $stmt = $this->db->prepare(
            'INSERT INTO review (message, tour_operator_id, author_id) VALUES (?, ?, ?)'
        );
        return $stmt->execute([$message, $tourOperatorId, $authorId]);
    }
}
