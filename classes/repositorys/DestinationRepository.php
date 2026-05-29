<?php

class DestinationRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findAll(): array {
        $stmt = $this->db->query('SELECT * FROM destination');
        return array_map(fn($row) => new Destination($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function findAllMainDestination(): array {
        // One card per unique location: prefer tour_operator_id=0 rows, fall back to lowest id
        $stmt = $this->db->query(
            'SELECT d.* FROM destination d
             INNER JOIN (
                 SELECT location, MIN(id) AS min_id FROM destination GROUP BY location
             ) t ON d.id = t.min_id
             ORDER BY d.location'
        );
        return array_map(fn($row) => new Destination($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function findById(int $id): ?Destination {
        $stmt = $this->db->prepare('SELECT * FROM destination WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new Destination($data) : null;
    }

    public function findByLocation(string $location): ?Destination {
        $stmt = $this->db->prepare('SELECT * FROM destination WHERE location = ?');
        $stmt->execute([$location]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new Destination($data) : null;
    }

    public function findByTourOperator(int $tourOperatorId): array {
        $stmt = $this->db->prepare('SELECT * FROM destination WHERE tour_operator_id = ?');
        $stmt->execute([$tourOperatorId]);
        return array_map(fn($row) => new Destination($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getLowestPriceByLocation(string $location): ?int {
        $stmt = $this->db->prepare(
            'SELECT MIN(d.price) as min_price
             FROM destination d
             INNER JOIN tour_operator t ON t.id = d.tour_operator_id
             WHERE d.location = ?'
        );
        $stmt->execute([$location]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return isset($data['min_price']) ? (int) $data['min_price'] : null;
    }

    public function create(string $location, string $country, int $price, string $image, int $tourOperatorId): bool {
        $stmt = $this->db->prepare(
            'INSERT INTO destination (location, country, price, image, tour_operator_id) VALUES (?, ?, ?, ?, ?)'
        );
        return $stmt->execute([$location, $country, $price, $image, $tourOperatorId]);
    }

    public function update(int $id, string $location, string $country, int $price, int $tourOperatorId): bool {
        $stmt = $this->db->prepare(
            'UPDATE destination SET location = ?, country = ?, price = ?, tour_operator_id = ? WHERE id = ?'
        );
        return $stmt->execute([$location, $country, $price, $tourOperatorId, $id]);
    }
}
