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
            $query = $this->conn->prepare('SELECT * FROM category ');
            $query->execute();

            $categories = [];

            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $categoryInstance = new Category();
                $categoryInstance->setCategory($data['namecategory']);

                $categories[] = $categoryInstance;
            }

            return $categories;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
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

    public function EditCategory(Category $category){
        try {
            $name = $category->getNameCategory();
            $id = $category->getId();

            $query = $this->conn->prepare('UPDATE category SET namecategory = :catname WHERE idcategory = :idcategory');
            $query->bindParam(':catname', $name);
            $query->bindParam(':idcategory', $id);
            echo 'Category ID: ' . $id;
            $query->execute();
        } catch (Exception $e) {
            echo 'Yabent nass Ana Fa9ir wedrahmi me3doda' . $e->getMessage();
        }
    }

    public function DeleteCategory(Category $category){
        try {
        }catch (Exception $e){
            echo 'waaaaaaaaa Barca' . $e->getMessage();
        }
    }

}