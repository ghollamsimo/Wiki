<?php

class Home extends Controller{
    public function index(...$param)
    {

            $this->view('home', $param);

    }
}