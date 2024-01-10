<?php

class Category
{
    private $namecategory;
    private $idcategory;

    public function __construct()
    {

    }

    public function getNameCategory(){
        return $this->namecategory;
    }



    public function setCategory($category) {
        $this->namecategory = $category;
    }

    public function getId()
    {
        return $this->idcategory;
    }

    public function setId($valeu){
        return $this->idcategory = $valeu;
    }
}