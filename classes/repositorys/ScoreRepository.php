<?php

class ScoreRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findAll(): array {
        $stmt = $this->db->query('SELECT * FROM score');
        return array_map(fn($row) => new Score($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function findByTourOperator(int $tourOperatorId): array {
        $stmt = $this->db->prepare('SELECT * FROM score WHERE tour_operator_id = ?');
        $stmt->execute([$tourOperatorId]);
        return array_map(fn($row) => new Score($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getAverageByTourOperator(int $tourOperatorId): ?float {
        $stmt = $this->db->prepare(
            'SELECT AVG(value) as avg_score FROM score WHERE tour_operator_id = ?'
        );
        $stmt->execute([$tourOperatorId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return isset($data['avg_score']) ? round((float) $data['avg_score'], 1) : null;
    }

    public function create(int $value, int $tourOperatorId, int $authorId): bool {
        $stmt = $this->db->prepare(
            'INSERT INTO score (value, tour_operator_id, author_id) VALUES (?, ?, ?)'
        );
        return $stmt->execute([$value, $tourOperatorId, $authorId]);
    }

    public function createOrIgnore(int $value, int $tourOperatorId, int $authorId): void {
        $stmt = $this->db->prepare(
            'INSERT IGNORE INTO score (value, tour_operator_id, author_id) VALUES (?, ?, ?)'
        );
        $stmt->execute([$value, $tourOperatorId, $authorId]);
    }
}
