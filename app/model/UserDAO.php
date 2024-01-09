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
            $id = $user->getId();
            $name = $user->getName();
            $email = $user->getEmail();
            $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
            $image = $user->getImage();
            $role = "Auteur";

            $query = $this->conn->prepare('INSERT INTO users (iduser, Nom, Email, password, image, role) VALUES (:iduser, :nom, :email, :password, :image, :role)');
            $query->bindParam(':iduser', $id);
            $query->bindParam(':nom', $name);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);
            $query->bindParam(':image', $image);
            $query->bindParam(':role', $role);
            $query->execute();

            return true;
        } catch (Exception $e) {
            echo 'M3lem Douz Douz Tgad Had lerror Li 3endek henaya lah ihfdek' . $e->getMessage();
            return false;
        }
    }





    public function getUserInfo(User $user)
    {
        $userId = $user->getId();

        try {

            $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE iduser = ?");
            $stmt->bindParam(1, $userId, PDO::PARAM_INT);
            $stmt->execute();

            $rows = $stmt->rowCount();

            if ($rows > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = new User();
                $user->setEmail($row['Email']);

                // Check if the image is null
                $user->setImage($row['image'] ?? '6596afe3182a6_profile_pic.png');

                $user->setName($row['Nom']);
                $user->setId($row['iduser']);

                return $user;
            } else {
                return false;
            }
        } catch (Exception $e) {
            error_log("Error in UserModel: " . $e->getMessage());
            return null;
        }
    }


    public function selectLastUser() {
        $stmt = $this->conn->prepare("SELECT * FROM users ORDER BY iduser LIMIT 1");

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function verifyUser(User $user)
    {
        $email = $user->getEmail();
        $password = $user->getPassword();

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (password_verify($password, $result['password'])) {
                return $result; // Password verification successful
            } else {
                echo 'Password verification failed. Provided password: ' . $password . ', Hashed password from DB: ' . $result['password'];
                return false;
            }
        } else {
            echo 'No user found with this email';
            return false;
        }
    }





    public function getUser()
    {
        return $this->user;
    }


    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}