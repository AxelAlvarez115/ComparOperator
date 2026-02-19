<?php

class ReviewRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll(){
        $request = $this->db->query("SELECT * FROM review");
        $reviews = [];

        while($data = $request->fetch(PDO::FETCH_ASSOC)){
            $reviews[] = new Review($data);
        }

        return $reviews;
    }

    public function getReviewsByTourOperatorId($tourOperatorId) {
        $request = $this->db->prepare("SELECT * FROM review WHERE tour_operator_id = ?");
        $request->execute([$tourOperatorId]);
        $reviews = [];

        while($data = $request->fetch(PDO::FETCH_ASSOC)){
            $reviews[] = new Review($data);
        }

        return $reviews;
    }
    
}
