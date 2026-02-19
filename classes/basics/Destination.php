<?php

class Destination {
    private int $id;
    private string $location;
    private string $country;
    private string $price;
    private string $image;
    private int $tour_operator_id;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->location = $data['location'];
        $this->country = $data['country'];
        $this->image = $data['image'];
        $this->price = $data['price'];
        $this->tour_operator_id = $data['tour_operator_id'];
    }

    public function getId() {
        return $this->id;
    }

    public function getLocation() {
        return $this->location;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getImage() {
        return $this->image;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getTourOperatorId() {
        return $this->tour_operator_id;
    }

}