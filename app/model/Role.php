<?php

class Role{
    private $idrole;
    private $role;

    public function __construct(){

    }

    public function getidrole(){
        return $this->idrole;
    }

    public function setidrole($value){
        return $this->idrole = $value;
    }

    public function getrole(){
        return $this->role;
    }

    public function setRole($value){
        return $this->role = $value;
    }
}