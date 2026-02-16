<?php

class TourOperator {
    private int $id;
    private string $name;
    private bool $is_premium;
    private ?string $link;
    private int $grade_count;
    private int $grade_total;

    public function __construct($id,$name,$is_premium,$link=null, $grade_count, $grade_total){
        $this->id = $id;
        $this->name = $name;
        $this->is_premium = $is_premium;
        $this->link = $link;
        $this->grade_count = $grade_count;
        $this->grade_total = $grade_total;
    }
    public function getId(){ 
        return $this->id;
    }

    public function isPremium(){ 
        return $this->is_premium; }


    public function getName(){ 
        return $this->name; }
        
    public function getLink(){ 
        return $this->link; }
}