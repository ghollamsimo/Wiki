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
            $category = $wiki->getCategory();

            $query = $this->conn->prepare("INSERT INTO wiki (title, Descreption, etat, image) 
         VALUES (:title, :desc, null,  :img)");
            $query->bindParam(':title', $title);
            $query->bindParam(':desc', $descreption);
            $query->bindParam(':img', $image);
            $query->bindParam('null', $etat);

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