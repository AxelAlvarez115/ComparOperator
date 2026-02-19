<?php

class Score {
    private int $id;
    private int $value;
    private int $tour_operator_id;
    private int $author_id;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->value = $data['value'];
        $this->tour_operator_id = $data['tour_operator_id'];
        $this->author_id = $data['author_id'];
    }

    public function getId() {
        return $this->id;
    }

    public function getValue() {
        return $this->value;
    }

    public function getTourOperatorId() {
        return $this->tour_operator_id;
    }

    public function getAuthorId() {
        return $this->author_id;
    }
}