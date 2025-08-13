<?php

class Controller {
    protected function render($view, $data = []) {
        
        if (!is_array($data)) {
            throw new InvalidArgumentException('Data must be an array');
        }

        // Extract data to variables
        extract($data);

        // Check if the view file exists
        $path = VIEWS_ . $view . '.php';
        if (!file_exists($path)) {
            throw new Exception("View file not found: " . $view . '.php');
        }

        // Include the view file
        require $path;
    } 

    protected function model($model) {

        // Check if the model file exists
        $path = MODELS_ . 'User/' . $model . '.php';
        if (!file_exists($path)) {
            throw new Exception("Model file not found: " . $model . '.php');
        }

        // Include the model
        require $path;
        return new $model;
    }

    protected function redirect($url) {
        header("Location: " . BASE_URL . $url);
        exit();
    }
}