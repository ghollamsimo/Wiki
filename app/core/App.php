<?php

class App
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        // print_r($url);

        if ($url) {
            if (file_exists(__DIR__ . '/../controller/' . $url[0] . '_controller.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            } else $this->controller = 'Page404';
        }
        require_once(__DIR__ . '/../controller/' . $this->controller . '_controller.php');

        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        // print_r($this->params);

        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
