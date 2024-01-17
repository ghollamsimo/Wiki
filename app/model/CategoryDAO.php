<?php

require 'Category.php';
class CategoryDAO
{
    private $conn;
    private $category;

    public function __construct(){
        $this->conn = new DataBaseConnection();
        $this->category = new Category();
    }

    public function ReadCategory()
    {
        try {
            $query = $this->conn->prepare('SELECT * FROM category');
            $query->execute();

            $categories = [];

            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $categoryInstance = new Category();
                $categoryInstance->setId($data["idcategory"]);
                $categoryInstance->setCategory($data['namecategory']);

                $categories[] = $categoryInstance;
            }

            return $categories;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function ReadLastCategory()
    {
        try {
            $query = $this->conn->prepare('SELECT * FROM category LIMIT 3');
            $query->execute();

            $categories = [];

            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $categoryInstance = new Category();
                $categoryInstance->setId($data["idcategory"]);
                $categoryInstance->setCategory($data['namecategory']);

                $categories[] = $categoryInstance;
            }

            return $categories;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function ReadOneCategory(Category $category){
        $id = $category->getId();
        $qury = $this->conn->prepare('SELECT category.* , wiki.* FROM category JOIN wiki ON wiki.idcategory = category.idcategory WHERE category.idcategory = :idcategory');
        $qury->bindParam(':idcategory', $id);
        $qury->execute();
           return $qury->fetchAll();
    }

    public function CreateCategory(Category $category){
        $name = $category->getNameCategory();
        $id = $category->getId();
        $query = $this->conn->prepare('INSERT INTO category(namecategory , idcategory) VALUES(:catname , :id)');
        $stmt = $query;
        $stmt->bindParam(':catname' , $name);
        $stmt->bindParam(':id' , $id);
        $stmt->execute();
    }

    public function EditCategory(Category $category) {
        try {
            $name = $category->getNameCategory();
            $id = $category->getId();

            $query = $this->conn->prepare('UPDATE category SET namecategory = :catname WHERE idcategory = :idcategory ');
            $query->bindParam(':catname', $name);
            $query->bindParam(':idcategory', $id, PDO::PARAM_INT);
            $query->execute();

            $rowCount = $query->rowCount();
            if ($rowCount > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
            return false;
        }
    }


    public function DeleteCategory(Category $category){
        try {
            $id = $category->getId();
            $query = $this->conn->prepare('DELETE FROM category WHERE idcategory = :idcategory');
            $stmt = $query;
            $stmt->bindParam(':idcategory' , $id);
            $stmt->execute();
        }catch (Exception $e){
            echo 'waaaaaaaaa Barca' . $e->getMessage();
        }
    }

}