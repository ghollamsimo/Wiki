<?php

class WikiTag
{
    private $idTag;
    private $idWiki;
    private $nametag;

    public function getIdTag()
    {
        return $this->idTag;
    }

    public function setIdTag($idTag)
    {
        $this->idTag = $idTag;
    }

    public function getIdWiki()
    {
        return $this->idWiki;
    }

    public function setIdWiki($idWiki)
    {
        $this->idWiki = $idWiki;
    }
    public function getNametag()
    {
        return $this->nametag;
    }

    public function setNametag($name)
    {
        $this->nametag = $name;
    }
}
