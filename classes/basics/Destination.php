<?php

class Destination {
    private int $id;
    private string $location;
    private string $country;
    private string $image;

    public function __construct($id,$location,$country,$image){
    $this->id = $id;
    $this->location = $location;
     $this->country = $country;
     $this->image = $image;
    }

    public function getId(){ 
        return $this->id; }
    public function getLocation(){ 
        return $this->location; }
    public function getCountry(){ 
        return $this->country; }
    public function getImage(){ 
return $this->image; }
}