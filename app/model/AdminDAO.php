<?php

require_once 'Admin.php';

class AdminDAO
{
    private $conn;
    private Admin $admin;

    public function __construct()
    {
        $this->conn = new DataBaseConnection();
        $this->admin = new Admin();
    }

    public function login()
    {
        header('Location:/wiki/public/dashboard/index');
    }

    public function analyseuser()
    {
        try {
            $query = $this->conn->prepare('SELECT COUNT(*) FROM users');
            $stmt = $query;
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo '3endek Error Ou Diiiiiiima Kokab' . $e->getMessage();
            return false;
        }
    }

    public function getWikiCount()
    {
        try {
            $query = $this->conn->prepare('SELECT COUNT(*) FROM wiki');
            $stmt = $query;
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error fetching wiki count: ' . $e->getMessage();
            return false;
        }
    }

    public function getCategoryCount()
    {
        try {
            $query = $this->conn->prepare('SELECT COUNT(*) FROM category');
            $stmt = $query;
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error fetching category count: ' . $e->getMessage();
            return false;
        }
    }

    public function GetUsers()
    {
        try {
            $query = $this->conn->prepare('SELECT * FROM users');
            $query->execute();

            $users = [];

            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $user = new Admin();
                $user->setName($data['Nom']);
                $user->setEmail($data['Email']);
                $user->setRole($data['role']);

                $users[] = $user;
            }

            return $users;

        } catch (Exception $e) {
            echo '3endek Error Ou Diiiiiiima Kokab' . $e->getMessage();
            return [];
        }
    }

    public function CreateCategory(Admin $category){
        try {
            $name = $category->getName();
            $query = $this->conn->prepare('INSERT INTO category(namecategory) VALUES (:namecategory)');
            $stmt = $query;
            $stmt->bindParam(':namecategory' ,  $name);
            $stmt->execute();

            return true;
        }catch(Exception $e){
            echo 'Lkhobz dero Jou3' . $e->getMessage();
            return false;
        }
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }
}
