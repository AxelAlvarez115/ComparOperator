<?php

class ScoreRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll(){
        $request = $this->db->query("SELECT * FROM score");
        $scores = [];

        while($data = $request->fetch(PDO::FETCH_ASSOC)){
            $scores[] = new Score($data);
        }

        return $scores;
    }

    public function getScoresByTourOperatorId($tourOperatorId) {
        $request = $this->db->prepare("SELECT * FROM score WHERE tour_operator_id = ?");
        $request->execute([$tourOperatorId]);
        $scores = [];

        while($data = $request->fetch(PDO::FETCH_ASSOC)){
            $scores[] = new Score($data);
        }

        return $scores;
    }
    
}