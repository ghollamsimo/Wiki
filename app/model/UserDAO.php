<?php

require_once 'User.php';

class UserDAO{
    private $user;
    private $conn;
    public function __construct(){
        $this->conn = new DataBaseConnection();
        $this->user = new User();
    }

    public function CreateUser(User $user){
        try {
            $name = $user->getName();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $image = $user->getImage();

            $query = $this->conn->prepare('INSERT INTO users (Nom , Email , password , image) VALUES (:nom , :email , :password , :image)') ;
            $query->bindParam(':nom' , $name);
            $query->bindParam(':email' , $email);
            $query->bindParam(':password' , $password);
            $query->bindParam(':image' , $image);
            $query->execute();
        }catch (Exception $e){
            echo 'M3lem Douz Tgad Had lerror Li 3endek henaya lah ihfdek' . $e->getMessage();
        }


    }
}