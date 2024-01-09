<?php

class SingleWiki extends Controller
{
    public function index(...$param){
        $this->view('singlewiki' , $param);
    }
}