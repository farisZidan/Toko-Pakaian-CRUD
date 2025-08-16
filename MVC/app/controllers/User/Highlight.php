<?php

class Highlight extends Controller {
    public function detail($id) {
        $model = $this->model('HighlightProductModel');
        $productData = $model->getById($id);
        $data = ['data' => $productData];

        $this->render('template/header', ['title' => 'RBGallery - ' . $productData['name']]);
        $this->render('highlight/detail', $data);
        $this->render('template/footer');
    }
}