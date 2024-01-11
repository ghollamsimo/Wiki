<?php

class Tag
{
    private $idtag;
    private $nametag;

    public function getNameTag(){
        return $this->nametag;
    }
    public function setNameTag($name){
        return $this->nametag = $name;
    }
    public function getIdTag(){
        return $this->idtag;
    }
    public function setIdTag($id){
        return $this->idtag = $id;
    }


}