<?php

class HighlightProductModel {
    private $highlights = [
        [
            'id' => 'Flora-Modern',
            'name' => 'Batik Flora Modern',
            'img' => ['Batik 3.jpg', 'Batik 2.jpg', 'Batik 1.jpg'],
            'description' => 'Batik flora modern adalah motif batik yang menampilkan keindahan bunga, daun, dan tanaman dengan sentuhan kontemporer. Desainnya lebih dinamis, berwarna cerah, dan sering dikombinasikan dengan pola geometris atau abstrak. Batik ini cocok untuk busana kasual hingga formal, mencerminkan keanggunan alam dengan gaya yang lebih segar dan modern.'
        ],
        [
            'id' => 'Fauna-Modern',
            'name' => 'Batik Fauna Modern',
            'img' => ['Batik 6.jpg', 'Batik 4.jpg', 'Batik 5.jpg'],
            'description' => 'Batik fauna modern menggambarkan hewan dengan sentuhan artistik inovatif, menciptakan kesan elagan dan unik dalam gaya modern.'
        ],
        [
            'id' => 'Flora-Simple',
            'name' => 'Batik Flora Simple',
            'img' => ['Batik 7.jpg', 'Batik 8.jpg', 'Batik 9.jpg'],
            'description' => 'Batik Flora Simple menampilkan motif bunga dan daun dengan desain minimalis, elegan, dan modern, cocok untuk berbagai acara.'
        ],
    ];

    public function getById($id) {
        foreach ($this->highlights as $highlight) {
            if ($highlight['id'] == $id) {
                return $highlight;
            }
        }
        return null;
    }
}