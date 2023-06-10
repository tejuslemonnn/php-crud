<?php

class App
{
    protected $controller = 'AuthController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        session_start();
        $url = $this->parseURL();

        if ($url != null && file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        if($this->controller != 'AuthController' && !isset($_SESSION['user_id'])){
            header("Location: " . BASEURL . "/AuthController/loginPage");
        }

        require_once('../app/controllers/' . $this->controller . '.php');

        $this->controller = new $this->controller;

        // method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // params
        if (!empty($url)) {
            unset($url[0]);
            $this->params = array_values($url);
        }

        // run controller & method, with send params if exist
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
