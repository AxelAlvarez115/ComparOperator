<?php

class TourOperatorRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findAll(){
        $request = $this->db->query("SELECT * FROM tour_operator");
        $tourOperators = [];

        while($data = $request->fetch(PDO::FETCH_ASSOC)){
            $tourOperators[] = new TourOperator($data);
        }

        return $tourOperators;
    }

    public function findByLocation($location) {
        $destinationRepository = new DestinationRepository($this->db);
        $stmt = $this->db->prepare("SELECT * FROM tour_operator WHERE location = ?");
        $stmt->execute([$location]);
        $tourOperators = [];

        while($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            $tourOperators[] = new TourOperator($data);
        }

        return $tourOperators;
    }
}