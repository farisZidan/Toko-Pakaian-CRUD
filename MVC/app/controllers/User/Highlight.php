<?php

class Highlight extends Controller {
    public function detail($id) {
        $model = $this->model('ProductHighlight');
        $data = $model->getById($id);

        $this->render('template/header', $data);
        $this->render('highlight/detail', $data);
        $this->render('template/footer');
    }
}