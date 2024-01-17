<?php

require 'WikiTag.php';
class WikiTagDAO
{
    private $conn;
    private $WikiTag;
    public function __construct()
    {
        $this->conn = new DataBaseConnection();
        $this->WikiTag = new WikiTag();
    }

    public function CreateWikiTag(WikiTag $wikitag)
    {
        try {
            $idtag = $wikitag->getIdTag();
            $idwiki = $wikitag->getIdWiki();
            //echo 'wikiiiiiiiiiiiiiii'.$idwiki;
            //echo 'taaaaaaaaaaag'.$idtag;
            //die();
            $query = $this->conn->prepare('INSERT INTO wiki_tag (idwiki, idtag) VALUES (:idwiki, :idtag)');
            $query->bindParam(':idwiki', $idwiki);
            $query->bindParam(':idtag', $idtag);
            $query->execute();
        } catch (Exception $e) {
            echo 'You Need To Fix This Error' . $e->getMessage();
        }
    }

    public function ReadTag()
    {
        try {
            $query = $this->conn->prepare('SELECT tag.nametag FROM wiki_tag JOIN wiki ON wiki.idwiki = wiki_tag.idwiki JOIN tag ON tag.idtag = wiki_tag.idtag
');
            $query->execute();

            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }catch (Exception $e){
            echo 'Can You Fix This Error Right Now'.$e->getMessage();
            return false;
        }
    }

    public function EditWikiTag( $wikitag){
       // $idtag = $wikitag->getIdTag();
       // $idwiki = $wikitag->getIdWiki();

        $query = $this->conn->prepare('DELETE FROM wiki_tag WHERE idwiki = :idwiki');

        $query->bindParam(':idwiki', $wikitag);
        $query->execute();

        $rowCount = $query->rowCount();
        return $rowCount > 0;
    }

    public function InsertWikiTag($idtag, $wikitag){
        $query2 = $this->conn->prepare('INSERT INTO  wiki_tag (idtag ,idwiki ) values (:idtag,:idwiki)');
        $query2->bindParam(':idtag', $idtag);
        $query2->bindParam(':idwiki', $wikitag);
        $query2->execute();
        $rowCount = $query2->rowCount();
        return $rowCount > 0;
    }

}