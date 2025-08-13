<?php

class Highlight extends Controller {
    public function detail($id) {
        $model = $this->model('HighlightProductModel');
        $productData = $model->getById($id);
        $data = ['title' => 'RBGallery - Highlight Detail' . $productData['name'], 
                'data' => $productData];

        $this->render('template/header', $data);
        $this->render('highlight/detail', $data);
        $this->render('template/footer');
    }
}