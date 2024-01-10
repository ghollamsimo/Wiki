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

            $query = $this->conn->prepare("INSERT INTO wiki (title, Descreption, image) 
         VALUES (:title, :desc, :img)");
            $query->bindParam(':title', $title);
            $query->bindParam(':desc', $descreption);
            $query->bindParam(':img', $image);

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




}