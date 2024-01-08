<?php

class login extends Controller{
    public function index(...$param)
    {
        if (isset($_POST['submitInfo'])){
            $user = new User();
        }
            $this->view('login', $param);

    }
}