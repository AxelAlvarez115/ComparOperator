<?php

class AuthorRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll(){
        $request = $this->db->query("SELECT * FROM author");
        $authors = [];

        while($data = $request->fetch(PDO::FETCH_ASSOC)){
            $authors[] = new Author($data);
        }

        return $authors;
    }
}