<?php

class DetailHighlightProduct {
    private $highlights = [
        [
            'id' => 1,
            'name' => 'Batik Flora Modern',
            'img' => ['img/Batik 3.jpg', 'img/Batik 2.jpg', 'img/Batik 1.jpg'],
            'description' => 'Batik flora modern adalah motif batik yang menampilkan keindahan bunga, daun, dan tanaman dengan sentuhan kontemporer. Desainnya lebih dinamis, berwarna cerah, dan sering dikombinasikan dengan pola geometris atau abstrak. Batik ini cocok untuk busana kasual hingga formal, mencerminkan keanggunan alam dengan gaya yang lebih segar dan modern.'
        ],
        [
            'id' => 2,
            'name' => 'Batik Fauna Modern',
            'img' => ['img/Batik 6.jpg', 'img/Batik 4.jpg', 'img/Batik 5.jpg'],
            'description' => 'Batik fauna modern menggambarkan hewan dengan sentuhan artistik inovatif, menciptakan kesan elagan dan unik dalam gaya modern.'
        ],
        [
            'id' => 3,
            'name' => 'Batik Flora Simple',
            'img' => ['img/Batik 7.jpg', 'img/Batik 8.jpg', 'img/Batik 9.jpg'],
            'description' => 'Batik Flora Simple menampilkan motif bunga dan daun dengan desain minimalis, elegan, dan modern, cocok untuk berbagai acara.'
        ],
    ]:

    public function getById($id) {
        foreach ($this->highlights as $highlight) {
            if ($highlight['id'] == $id) {
                return $highlight;
            }
        }
        return null;
    }
}