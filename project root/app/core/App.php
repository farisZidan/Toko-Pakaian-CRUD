<?php

class App {

    public function __construct() 
    {
        var_dump($this->parseURL());
    }

    public function parseURL() 
    {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            return $url;
        }
    }
}