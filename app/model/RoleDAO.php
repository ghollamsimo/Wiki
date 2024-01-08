<?php

require_once 'Role.php';

class RoleDAO{
    private $role;
    private $conn;

    public function __construct(){
        $this->conn = new DataBaseConnection();
        $this->role = new Role();
    }

    public function CreateRole(){

        $query = $this->conn->prepare('SELECT * FROM role where idrole = :idrole');
        $query->bindParam(':idrole' , );
    }
}