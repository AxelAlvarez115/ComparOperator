<?php

class DestinationRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM destination');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new Destination($row), $rows);
    }

    function findAllMainDestination() {
        $stmt = $this->db->query("SELECT * FROM destination WHERE tour_operator_id = 0");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new Destination($row), $rows);
    }

    public function getDestinationById($id) {
        $request = $this->db->prepare("SELECT * FROM destination WHERE id = ?");
        $request->execute([$id]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Destination(
                $data['id'],
                $data['location'],
                $data['country'],
                $data['image'],
                $data['price'],
                $data['tour_operator_id']
            );
        }
        return null;
    }

    public function getByLocation($location) {
        $request = $this->db->prepare("SELECT * FROM destination WHERE location = ?");
        $request->execute([$location]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Destination($data);
        }
        return null;
    }

    public function getLowerPriceByLocation($location) {
        $request = $this->db->prepare("SELECT MIN(price) as min_price FROM tour_operator WHERE location = ?");
        $request->execute([$location]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        return $data['min_price'] ?? null;
    } 

}