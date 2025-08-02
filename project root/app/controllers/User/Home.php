<?php

class Home extends Controller {
    public function index() 
    {
        $data = [
            'title' => 'RBGallery - Home'
        ];
        $this->render('template/header', $data);
        $this->render('home/index');
        $this->render('template/footer');
    }
}