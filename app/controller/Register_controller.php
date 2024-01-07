<?php

class Register extends Controller{
    private $UserDao;

    public function __construct(){
        $this->UserDao = new UserDAO();
    }

    public function index(...$param)
    {
        if (isset($_POST['submitInfo'])){
            $user = new User();
            $user->setName($_POST['username']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setPassword($_POST['image']);
            $this->UserDao->CreateUser($user);
        }
        $this->view('Rigester', $param);
    }
}
