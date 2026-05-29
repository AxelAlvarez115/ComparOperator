<?php

class TourOperatorRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findAll(): array {
        $stmt = $this->db->query('SELECT * FROM tour_operator');
        return array_map(fn($row) => new TourOperator($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function findById(int $id): ?TourOperator {
        $stmt = $this->db->prepare('SELECT * FROM tour_operator WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new TourOperator($data) : null;
    }

    /**
     * Returns tour operators serving a given location, including the destination price.
     */
    public function findByLocation(string $location): array {
        $stmt = $this->db->prepare(
            'SELECT t.*, d.price
             FROM tour_operator t
             INNER JOIN destination d ON d.tour_operator_id = t.id
             WHERE d.location = ?'
        );
        $stmt->execute([$location]);
        return array_map(fn($row) => new TourOperator($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function create(TourOperator $tourOperator): bool {
        $stmt = $this->db->prepare(
            'INSERT INTO tour_operator (name, link, is_premium) VALUES (?, ?, ?)'
        );
        return $stmt->execute([
            $tourOperator->getName(),
            $tourOperator->getLink(),
            (int) $tourOperator->getIsPremium(),
        ]);
    }

    public function update(int $id, string $name, string $link, bool $isPremium): bool {
        $stmt = $this->db->prepare(
            'UPDATE tour_operator SET name = ?, link = ?, is_premium = ? WHERE id = ?'
        );
        return $stmt->execute([$name, $link, (int) $isPremium, $id]);
    }
}
