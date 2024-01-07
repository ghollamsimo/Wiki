<?php

class Controller
{
    protected function view($view, $data = [])
    {
        require_once (__DIR__ . '/../view/' . $view . '_view.php');
    }

}

