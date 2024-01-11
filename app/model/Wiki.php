<?php

class Wiki
{
    private $id;
    private $title;
    private $descreption;
    private $image;
    private $date;
    private $etat;
    private $tag;
    private $category;
    private $userid;

    public function __construct(){

    }

    public function getId(){
        return $this->id;
    }
    public function setId($value){
        return $this->id = $value;
    }
    public function getTitle(){
        return $this->title;
    }
    public function setTitle($value){
        return $this->title = $value;
    }
    public function getDescreption()
    {
        return $this->descreption;
    }
    public function setDescreption($value){
        return $this->descreption = $value;
    }
    public function getImage(){
        return $this->image;
    }
    public function setImage($value){
        return $this->image = $value;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function setDate($value){
        return $this->date = $value;
    }
    public function getEtat(){
        return $this->etat;
    }
    public function setEtat($value){
        return $this->etat = $value;
    }
    public function getTag(){
        return $this->tag;
    }

    public function setTag($value){
        return $this->tag = $value;
    }
    public function getCategory(){
        return $this->category;
    }
    public function setCategory($value){
        return $this->category = $value;
    }
    public function getUserId()
    {
        return $this->userid;
    }
    public function setUserId($value){
        return $this->userid = $value;
    }
}