<?php

class Page404 extends Controller
{
    public function index(...$param)
    {
        $this->view('404', $param);
    }
}