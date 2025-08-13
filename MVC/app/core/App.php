<?php

class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() 
    {
        $url = $this->parseURL();
        $this->controller = ucfirst($url[0] ?? $this->controller);
        $this->method = $url[1] ?? $this->method;

        $namespace = (stripos($this->controller, 'Admin') !== false) ? 'Admin/' : 'User/';
        $controllerPath = CONTROLLERS_ . $namespace . $this->controller . '.php';

        // Check if the controller file exists, then 
        if (!file_exists($controllerPath)) 
        {
            header("Location: /error/404");
            exit();
        }

        require_once $controllerPath;
        
        // Check if the controller class exists
        if (!class_exists($this->controller))
        {
            die('Class not found');
        }
        $this->controller = new $this->controller;
        unset($url[0]);

        // Check if the method exists in the controller
        if (!method_exists($this->controller, $this->method)) 
        {
            die('Method not found in controller');
        }  
        unset($url[1]); 
        
        if (!empty($url)) 
        {
            $this->params = array_values($url);
        }

        try 
        {
            call_user_func_array([$this->controller, $this->method], $this->params);
        }
        catch (ArgumentCountError $e)
        {
            header("Location: /error/400");
            exit();
        }
    }

    public function parseURL() 
    {
        if (!isset($_GET['url'])) 
        {
            return [$this->controller];
        }
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return explode('/', $url);
    }
}