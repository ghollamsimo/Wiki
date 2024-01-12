<?php

require_once 'Wiki.php';

class WikiDAO
{
    private $conn;
    private $wiki;

    public function __construct()
    {
        $this->conn = new DataBaseConnection();
        $this->wiki = new Wiki();
    }

    public function CreateWiki(Wiki $wiki)
    {
        try {
            $title = $wiki->getTitle();
            $descreption = $wiki->getDescreption();
            $image = $wiki->getImage();
            $date = $wiki->getDate();
            $tag = $wiki->getTag();
            $etat = $wiki->getEtat();
            $user = $wiki->getUserId();
            $category = $wiki->getCategory();

            $query = $this->conn->prepare("INSERT INTO wiki (title, Descreption, etat, image, iduser) 
     VALUES (:title, :desc, :etat, :img, :iduser)");
            $query->bindParam(':title', $title);
            $query->bindParam(':desc', $descreption);
            $query->bindParam(':etat', $etat);
            $query->bindParam(':img', $image);
            $query->bindParam(':iduser', $user);

            $query->execute();
        } catch (Exception $e) {
            echo 'Alllla Matheme9nich' . $e->getMessage();
        }
    }
    public function ReadWiki()
    {
        try {
            $query = $this->conn->prepare('SELECT * FROM wiki');
            $query->execute();
            $stmt = $query->fetchAll(PDO::FETCH_ASSOC);
            $wikis = [];
            foreach ($stmt as $data) {
                $wiki = new Wiki();
                $wiki->setId($data['idwiki']);
                $wiki->setTitle($data['Title']);
                $wiki->setDescreption($data['Descreption']);
                $wiki->setImage($data['image']);
                $wiki->setDate($data['ladate']);
                $wiki->setEtat($data['etat']);

                $wikis [] = $wiki;

            }

            return $wikis;
        } catch (Exception $e) {
            echo 'Wa safi wa siiiiir' . $e->getMessage();
            return [];
        }
    }

    public function ReadOneWiki(Wiki $wiki){
        try {
            $id = $wiki->getId();
            $query = $this->conn->prepare('SELECT * FROM wiki WHERE idwiki = :idwiki');
            $query->bindParam(':idwiki' , $id);
            $query->execute();
            return $query->fetch();
        }catch (Exception $e){
            echo 'Waaa Reb l3ali' . $e->getMessage();
        }
    }


    public function Archiver(Wiki $wiki)
    {
        try {
            $wikiid = $wiki->getId();

            $req = $this->conn->prepare("UPDATE wiki SET etat = 'Archiver' WHERE idwiki = :id");
            $req->bindParam(':id' , $wikiid);
            $req->execute();
        } catch (Exception $e) {
            error_log("Error in update: " . $e->getMessage());
        }
    }
    public function NonArchiver(Wiki $wiki)
    {
        try {
            $wikiid = $wiki->getId();

            $req = $this->conn->prepare("UPDATE wiki SET etat = 'Publier' WHERE idwiki = :id");
            $req->bindParam(':id' , $wikiid);
            $req->execute();
        } catch (Exception $e) {
            error_log("Error in update: " . $e->getMessage());
        }
    }


}