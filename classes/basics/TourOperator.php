<?php

class TourOperator {
    private int $id;
    private string $name;
    private string $link;
    private bool $isPremium;
    private array $destinations;
    private array $reviews;
    private array $scores;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->isPremium = $data['isPremium'];
        $this->link = $data['link'];
        $this->destinations = $data['destinations'] ?? [];
        $this->reviews = $data['reviews'] ?? [];
        $this->scores = $data['scores'] ?? [];
    }
    public function getId(){ 
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getLink() {
        return $this->link;
    }

    public function getIsPremium() {
        return $this->isPremium;
    }

    public function getDestinations() {
        return $this->destinations;
    }

    public function getReviews() {
        return $this->reviews;
    }

    public function getScores() {
        return $this->scores;
    }
}