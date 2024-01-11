<?php

require 'Tag.php';
class TagDAO
{
    private $conn;
    private $tag;

    public function __construct()
    {
        $this->conn = new DataBaseConnection();
        $this->tag = new Tag();
    }

    public function ReadTag(){
        try {
            $query = $this->conn->prepare('SELECT * FROM tag');
            $query->execute();
            $stmt = $query->fetchAll(PDO::FETCH_ASSOC);

            $tags = [];

            foreach ($stmt as $data) {
                $tag = new Tag();
                $tag->setIdTag($data['idtag']);
                $tag->setNameTag($data['nametag']);

                $tags [] = $tag;
            }

            return $tags;
        } catch (Exception $e) {
            echo 'Wa safi wa siiiiir' . $e->getMessage();
            return [];
        }
    }

    public function CreateTag(Tag $tag){
        try {
            $name = $tag->getNameTag();
            $query = $this->conn->prepare('INSERT INTO tag (nametag)VALUES (:nametag)');
            $stmt = $query;
            $stmt->bindParam(':nametag' , $name);
            $stmt->execute();
        }catch(Exception $e){
            echo 'La maghadich nsak hta tensak lmout' . $e->getMessage();
        }
    }

    public function EditTag(Tag $tag) {
        try {
            $name = $tag->getNameTag();
            $id = $tag->getIdTag();

            $query = $this->conn->prepare('UPDATE tag SET nametag = :nametag WHERE idtag = :idtag');
            $query->bindParam(':nametag', $name);
            $query->bindParam(':idtag', $id, PDO::PARAM_INT); // Use PDO::PARAM_INT for integer types
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

    public function DeleteTag(Tag $tag){
        try {
            $id = $tag->getIdTag();
            $query = $this->conn->prepare('DELETE FROM tag WHERE idtag = :idtag');
            $stmt = $query;
            $stmt->bindParam(':idtag' , $id);
            $stmt->execute();
        }catch(Exception $e){
            echo 'Whene Your day Get lonly' . $e->getMessage();
        }
    }
}