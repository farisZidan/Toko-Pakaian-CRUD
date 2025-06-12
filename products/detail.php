<?php
require '../config/functions.php';
$nama_produk = $_GET['Nama'];
$produk = select("SELECT * FROM barang WHERE Nama = '$nama_produk'")[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $produk['nama'] ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Global Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }

        /* Header Styling */
        .header {
            background-color: white;
            padding: 20px 0;
            color: #333;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header nav a {
            color: #333;
            text-decoration: none;
            margin: 0 20px;
            font-weight: 600;
        }
        .header nav a:hover {
            text-decoration: underline;
        }

        /* Cart Styling */
        .cart {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 20px;
            color: #333;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .cart-count {
            background-color: red;
            color: white;
            font-size: 14px;
            border-radius: 50%;
            padding: 5px 10px;
            margin-left: 5px;
        }

        /* Carousel Styling */
        .carousel {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 8px;
            width: 100%;
        max-width: 100%; /* Gambar mengambil lebar penuh */
        margin: 0 auto;
        }
        .carousel-images img {
            width: 100%;
            height: auto; /* Pastikan gambar tidak melebihi kontainer */
            border-radius: 8px;
        }

        /* Product Detail Section */
        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .product-detail {
            flex-wrap: wrap; /* Agar elemen bisa menyesuaikan jika layar lebih kecil */
            align-items: flex-start; /* Agar elemen tidak saling bertumpukan */
            display: flex;
        flex-direction: column; /* Ubah ke column agar elemen berurutan vertikal */
        gap: 20px;
        }
        .product-info {
            width: 100%; /* Memastikan bagian ini menggunakan 100% di layar kecil */
            max-width: 600px; /* Membatasi lebar untuk tampilan yang lebih besar */
        display: flex;
        flex-direction: column;
        height: 100%; /* Gunakan tinggi penuh */
        }
        .product-info h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
            margin-bottom: 10px;
        }
        .product-meta {
        margin-top: auto; /* Push konten ke bawah */
        display: flex;
        flex-direction: column;
        gap: 15px;
        }
        .product-info .rating {
            color: #e63946;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .product-info .price-discount {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .product-info .price-original {
            text-decoration: line-through;
            color: #aaa;
            font-size: 20px;
            margin-left: 10px;
        }
        .product-info .description {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            margin-bottom: 20px;
            flex-grow: 1; /* Deskripsi mengambil sisa ruang */
        overflow-y: auto; /* Scroll jika konten terlalu panjang */
        max-height: 200px; /* Batas maksimal tinggi deskripsi */
        padding-bottom: 20px; /* Jarak dari tombol */
        }
        .button-group {
        margin-top: auto; /* Tombol tetap di bawah */
        display: flex;
        gap: 10px;
        flex-wrap: wrap; /* Jika layar kecil, tombol bisa ke bawah */
        }
        .buy-button, .cart-button, .order-button {
            color: #fff;
            font-size: 18px;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .buy-button:hover, .cart-button:hover, .order-button:hover {
            background-color: #e63946;
        }
        .cart-button, .order-button {
            margin-left: 10px;
        }
        .cart-button i, .order-button i {
            margin-right: 10px;
        }

        /* Specific button styles */
        .cart-button {
            background-color: #fff;
            color: #2d6a4f;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .order-button {
            background-color: #FF5722; 
            color: #fff;
        }
        .buy-button {
            background-color: #fff;
            color: #2d6a4f;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 768px) {
            .product-info {
                width: 60%; /* Menjaga lebar tetap proporsional di layar lebih besar */
                padding-left: 20px;
            }
            .product-detail {
            flex-direction: row; /* Desktop kembali ke layout horizontal */
            align-items: flex-start;
        }
        
        .carousel {
            width: 50%;
            max-width: 400px;
        }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <h1><a href="index.html" style="color: rgb(4, 4, 4); text-decoration: none;">RB Gallery</a></h1>
        <nav>
            <a href="../index.html">Beranda</a>
            <a href="produk.php">Produk</a>
            <a href="../user/kontak.html">Contact</a>
        </nav>
        <!-- Cart Icon with count -->
        <div class="cart" id="cartLink" onclick="window.location.href='../user/cart.html';">
            <i class="fas fa-shopping-cart"></i> 
            <span id="cartCount" class="cart-count">0</span>
        </div>
    </header>

    <!-- Product Detail Section -->
    <div class="container">
        <div class="product-detail">
            <div class="carousel">
                <div class="carousel-images">
                    <img src="../img/<?= $produk['Gambar'] ?>" alt="Batik">
                </div>
            </div>

            <div class="product-info">
    <h1><?= $produk['Nama'] ?></h1>
    
    <div class="product-meta">
        <div class="rating">⭐⭐⭐⭐☆ (50 ulasan)</div>
        <div class="product-prices">
            <span class="price-discount">Rp<?= number_format($produk['Harga'] * 0.55, 0, ',', '.') ?></span>
            <span class="price-original">Rp<?= number_format($produk['Harga'], 0, ',', '.') ?></span>
        </div>
        
        <div class="description">
            <?= $produk['Deskripsi'] ?>
        </div>
        
        <div class="button-group">
            <a href="../user/order-form.html" class="buy-button">Beli Sekarang</a>
            <button class="cart-button" onclick="addToCart()">
                <i class="fas fa-shopping-cart"></i> Keranjang
            </button>
            <button class="order-button" onclick="window.location.href='https://id.shp.ee/FgCWeAT';">
                <i class="fab fa-shopify"></i> Order Shopee
            </button>
        </div>
    </div>
</div>
</body>
</html>
