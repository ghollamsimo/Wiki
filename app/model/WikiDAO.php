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
            $etat = 'Publier';
            $user = $wiki->getUserId();
            $category = $wiki->getCategory();

            $this->validateCategoryExists($category);

            $query = $this->conn->prepare("INSERT INTO wiki (title, Descreption, etat, image, iduser, idcategory) 
            VALUES (:title, :desc, :etat, :img, :iduser, :idcategory)");
            $query->bindParam(':title', $title);
            $query->bindParam(':desc', $descreption);
            $query->bindParam(':etat', $etat);
            $query->bindParam(':img', $image);
            $query->bindParam(':iduser', $user);
            $query->bindParam(':idcategory', $category);
            $query->execute();

            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }



    public function SearchWikiByTitleAndCategory($title, $category , $tag)
    {
        $sql = "SELECT wiki.idwiki, wiki.Title, wiki.Descreption, category.namecategory FROM wiki JOIN category ON category.idcategory = wiki.idcategory JOIN wiki_tag ON wiki_tag.id = wiki_tag.idwiki  WHERE (wiki.Title LIKE :title OR category.namecategory LIKE :category OR LIKE :tag ) AND etat = 'Publier' ";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $titleParam = '%' . $title . '%';
        $categoryParam = '%' . $category . '%';
        $tag = '%' . $tag . '%';

        $stmt->bindParam(':title', $titleParam, PDO::PARAM_STR);
        $stmt->bindParam(':category', $categoryParam, PDO::PARAM_STR);
        $stmt->bindParam(':tag' , $tag);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    private function validateCategoryExists($categoryId)
    {
        $query = $this->conn->prepare("SELECT COUNT(*) FROM category WHERE idcategory = :idcategory");
        $query->bindParam(':idcategory', $categoryId);
        $query->execute();

        if ($query->fetchColumn() == 0) {
            throw new Exception('Invalid category ID: ' . $categoryId);
        }
    }

    public function ReadWiki()
    {
        try {
            $query = $this->conn->prepare('SELECT category.namecategory , wiki.* FROM category 
            JOIN wiki on wiki.idcategory = category.idcategory 
 JOIN wiki_tag ON wiki_tag.idwiki = wiki.idwiki
WHERE etat = "Publier" ');
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
                $wiki->setNameCtaegory($data['namecategory']);
                $wikis[] = $wiki;
            }

            return $wikis;
        } catch (Exception $e) {
            echo 'Wa safi wa siiiiir' . $e->getMessage();
            return [];
        }
    }
    public function ReadLastWiki()
    {
        try {
            $query = $this->conn->prepare('SELECT category.*, wiki.* FROM category JOIN wiki ON wiki.idcategory = category.idcategory WHERE etat = "Publier" ORDER BY wiki.ladate DESC LIMIT 3');
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
                $wiki->setNameCtaegory($data['namecategory']);
                $wiki->setEtat($data['etat']);

                $wikis[] = $wiki;
            }

            return $wikis;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }


    public function ReadOneWiki(Wiki $wiki)
    {
        try {
            $id = $wiki->getId();
            $query = $this->conn->prepare('SELECT category.* , wiki.* FROM category JOIN wiki on wiki.idcategory = category.idcategory WHERE idwiki = :idwiki  ORDER BY wiki.ladate');
            $query->bindParam(':idwiki', $id);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            echo 'Waaa Reb l3ali' . $e->getMessage();
        }
    }
    public function Archiver(Wiki $wiki)
    {
        try {
            $wikiid = $wiki->getId();

            $req = $this->conn->prepare("UPDATE wiki SET etat = 'Archiver' WHERE idwiki = :id");
            $req->bindParam(':id', $wikiid);
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
            $req->bindParam(':id', $wikiid);
            $req->execute();
        } catch (Exception $e) {
            error_log("Error in update: " . $e->getMessage());
        }
    }



    public function DeleteWiki(Wiki $wiki)
    {
        try {
            $id = $wiki->getId();
            $query = $this->conn->prepare('DELETE FROM wiki WHERE idwiki = :idwiki');
            $stmt = $query;
            $stmt->bindParam(':idwiki', $id);
            $stmt->execute();
        } catch (Exception $e) {
            echo 'Please Fix This Error Right Now' . $e->getMessage();
        }
    }


    public function EditeWiki(Wiki $wiki)
    {
        $title = $wiki->getTitle();
        $descreption = $wiki->getDescreption();
        $image = $wiki->getImage();
        $etat = $wiki->getEtat();
        $user = $wiki->getUserId();
        $category = $wiki->getCategory();

        $query = $this->conn->prepare('UPDATE wiki SET Title = :title , Descreption = :desc , image = :image, etat = :etat, iduser = :user, idcategory = :category');
        $query->bindParam(':title', $title);
        $query->bindParam(':desc', $descreption);
        $query->bindParam(':image', $image);
        $query->bindParam(':etat', $etat);
        $query->bindParam(':user', $user, PDO::PARAM_INT);
        $query->bindParam(':category', $category, PDO::PARAM_INT);
        $query->execute();

        $rowCount = $query->rowCount();
        return $rowCount > 0;
    }
}
