<?php
require_once 'db.php';
require_once 'Destination.php';

class DestinationManager {

    public function getAll(){
        $db = Database::getConnection();
        $request = $db->query("SELECT * FROM destination");
        $destinations = [];

        while($data = $request->fetch(PDO::FETCH_ASSOC)){
            $destinations[] = new Destination(
            $data['id'],
            $data['location'],
            $data['country'],
            $data['image']
            );
        }
        return $destinations;
    }

    public function getDestinationById($id) {
        return $this->destinations[$id] ?? null;
    }

}