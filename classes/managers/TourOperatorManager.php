<?php
require_once 'db.php';
require_once '../basics/TourOperateur.php';
require_once 'DestinationManager.php';

class TourOperatorManager {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll(){
        $request = $this->db->query("SELECT * FROM tour_operator");
        $tourOperators = [];

        while($data = $request->fetch(PDO::FETCH_ASSOC)){
            $tourOperators[] = new TourOperator($data);
        }

        return $tourOperators;
    }

    public function getTourOperatorByDestinationLocation($location) {
        $destinationManager = new DestinationManager($this->db);
        $destination = $destinationManager->getByLocation($location);
        if (!$destination) {
            return [];
        }
        $request = $this->db->prepare("SELECT * FROM tour_operator WHERE id IN (SELECT tour_operator_id FROM tour_operator_destination WHERE destination_id = ?)");
        $request->execute([$destination->getId()]);
        $tourOperators = [];

        while($data = $request->fetch(PDO::FETCH_ASSOC)){
            $tourOperators[] = new TourOperator($data);
        }

        return $tourOperators;
    }
}