<?php

class Review {
    private int $id;
    private string $message;
    private int $tour_operator_id;
    private int $author_id;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->message = $data['message'];
        $this->tour_operator_id = $data['tour_operator_id'];
        $this->author_id = $data['author_id'];
    }

    public function getId() {
        return $this->id;

    }

    public function getMessage() {
        return $this->message;
    }

    public function getTourOperatorId() {
        return $this->tour_operator_id;
    }

    public function getAuthorId() {
        return $this->author_id;
    }

}