<?php
require_once 'db.php';
require_once 'Destination.php';

class DestinationManager {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll(){
        $request = $this->db->query("SELECT * FROM destination");
        $destinations = [];

        while($data = $request->fetch(PDO::FETCH_ASSOC)){
            $destinations[] = new Destination(
            $data['id'],
            $data['location'],
            $data['country'],
            $data['image'],
            $data['price'],
            $data['tour_operator_id']
            );
        }
        return $destinations;
    }

    function getAllDistinctLocations() {
        $request = $this->db->query("SELECT DISTINCT location FROM destination");
        $locations = [];
        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
            $locations[] = $data['location'];
        }
        return $locations;
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
            return new Destination(
                $data['id'],
                $data['location'],
                $data['country'],
                $data['image']
            );
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