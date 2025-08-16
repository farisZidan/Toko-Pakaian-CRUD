<?php

class Products extends Controller
{
    public function index()
    {
        $model = $this->model('ProductsModel');
        $data = $model->getAllProducts();
        if (!$data) {
            $data = [];
        }
        $this->render('products/header', ['title' => 'RBGallery - Products Collection']);
        $this->render('products/index', ['data' => $data]);
        $this->render('template/footer');
    }

    public function detail($id)
    {
        $data['product'] = $this->model('ProductsModel')->getProductById($id);
        if ($data['product']) {
            $this->view('user/products/detail', $data);
        } else {
            $this->view('errors/404');
        }
    }
}