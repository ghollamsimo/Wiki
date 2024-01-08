<?php

class DataBaseConnection{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'wiki';
    private $conn;

    public function __construct(){
        try {
            $dbh = "mysql:host={$this->host};dbname={$this->database}";
            $this->conn = new PDO($dbh, $this->username, $this->password);
        }catch(PDOException $e){
            echo 'lahama 9ad La Connection m3a Dik DataBase Lah Irhem Lik lwalidin' . $e->getMessage();
        }
    }

    public function prepare($sql)
    {
        return $this->conn->prepare($sql);
    }
}