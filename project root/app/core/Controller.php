<?php

class Controller {
    protected function render($view, $data = []) {
        
        if (!is_array($data)) {
            throw new InvalidArgumentException('Data must be an array');
        }

        // Extract data to variables
        extract($data);

        // Check if the view file exists
        $path = VIEWS_PATH . $view . '.php';
        if (!file_exists($path)) {
            throw new Exception("View file not found: " . VIEWS_PATH . $view . '.php');
        }

        // Include the view file
        require $path;
    } 

    protected function redirect($url) {
        header("Location: " . BASE_URL . $url);
        exit();
    }
}