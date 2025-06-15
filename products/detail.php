<?php
require '../config/conn.php';
$kode = $_GET['Id'];
$produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM barang WHERE Kode = '$kode'"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $produk['Nama']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
<!-- Header Section -->
<header class="bg-white py-5 text-gray-800 text-center shadow-md">
    <h1 class="text-2xl font-bold"><a href="index.html" class="text-black no-underline">RB Gallery</a></h1>
    <nav class="mt-3">
    <a href="../index.html" class="mx-5 font-semibold text-gray-800 no-underline hover:underline">Beranda</a>
    <a href="produk.php" class="mx-5 font-semibold text-gray-800 no-underline hover:underline">Produk</a>
    <a href="../user/kontak.html" class="mx-5 font-semibold text-gray-800 no-underline hover:underline">Contact</a>
    </nav>
    <!-- Cart Icon with count -->
    <div class="absolute top-5 right-5 text-xl text-gray-800 cursor-pointer flex items-center" onclick="window.location.href='cart.php'">
    <i class="fas fa-shopping-cart"></i> 
    <span id="cartCount" class="bg-red-500 text-white text-sm rounded-full px-2 ml-1 hidden">0</span>
    </div>
</header>

<!-- Product Detail Section -->
<div class="container w-4/5 mx-auto my-8 bg-white p-5 rounded-lg shadow-sm">
    <div class="product-detail flex flex-col gap-5 md:flex-row md:items-start">
    <div class="carousel w-full md:w-1/2 max-w-md">
    <div class="carousel-images">
    <img src="../img/<?= $produk['Gambar']; ?>" alt="Batik" class="w-full h-auto rounded-lg">
    </div>
    </div>

    <div class="product-info w-full md:w-3/5 flex flex-col">
    <h1 class="text-2xl font-bold text-gray-800 mb-3"><?= $produk['Nama']; ?></h1>
                
    <div class="product-meta mt-auto flex flex-col gap-4">
    <div class="rating text-red-500 text-base">⭐⭐⭐⭐☆ (50 ulasan)</div>
    <div class="product-prices">
    <span class="price-discount text-2xl font-bold">Rp<?= number_format($produk['Harga'] * 0.55, 0, ',', '.'); ?></span>
    <span class="price-original line-through text-gray-400 text-xl ml-2">Rp<?= number_format($produk['Harga'], 0, ',', '.'); ?></span>
    </div>

    <div id="stokValue" class="font-semibold">
    <strong>Stok:</strong>
    <span>Pilih ukuran</span>
    </div>
    <div id="size_options" class="flex gap-2 mb-4">
        <button class="size-button px-4 py-2 bg-gray-100 border rounded-md hover:bg-gray-300 transition-colors focus:outline-none focus:bg-gray-300" 
        data-size="Ukuran_S">S</button>
        <button class="size-button px-4 py-2 bg-gray-100 border rounded-md hover:bg-gray-300 transition-colors focus:outline-none focus:bg-gray-300" 
        data-size="Ukuran_M">M</button>
        <button class="size-button px-4 py-2 bg-gray-100 border rounded-md hover:bg-gray-300 transition-colors focus:outline-none focus:bg-gray-300" 
        data-size="Ukuran_L">L</button>
        <button class="size-button px-4 py-2 bg-gray-100 border rounded-md hover:bg-gray-300 transition-colors focus:outline-none focus:bg-gray-300" 
        data-size="Ukuran_XL">XL</button>
    </div>
        <input type="hidden" id="Id" value="<?= $produk['Kode']; ?>">
        <input type="hidden" id="email" value="<?= $_COOKIE['email']; ?>">

    <div class="description text-gray-600 text-base leading-relaxed mb-5 overflow-y-auto max-h-48 pb-5">
    <?= $produk['Deskripsi']; ?>
    </div>
                    
    <div class="button-group flex gap-3 flex-wrap mt-auto">
    <a href="../user/order-form.html" class="buy-button bg-white text-green-800 px-6 py-3 rounded-md shadow-md hover:bg-green-50 transition-colors flex items-center">Beli Sekarang
    </a>
    <button id="addToCart" class="cart-button bg-white text-green-800 px-6 py-3 rounded-md shadow-md hover:bg-green-50 transition-colors flex items-center ml-2">
    <i class="fas fa-shopping-cart mr-2"></i> Keranjang
    </button>
    <button class="order-button bg-orange-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-orange-700 transition-colors flex items-center" onclick="window.location.href='https://id.shp.ee/FgCWeAT';">
    <i class="fab fa-shopify mr-2"></i> Order
    </button>
    </div>
    </div>
    </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
const sizeButtons = document.querySelectorAll('.size-button');
const stokSize = document.getElementById('stokValue');
const id = document.getElementById('Id').value;
const email = document.getElementById('email').value;
document.getElementById('addToCart').addEventListener('click', addToCart);

sizeButtons.forEach(button => {
    button.addEventListener('click', function() {
        sizeButtons.forEach(btn => {
            btn.classList.remove('bg-gray-300');
            btn.classList.add('bg-gray-100');
        });
        this.classList.remove('bg-gray-100');
        this.classList.add('bg-gray-300');
                
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
         if (xhr.readyState === 4 && xhr.status === 200) {
             stokSize.innerHTML = '<strong>Stok:</strong> ' + xhr.responseText;
            }
        };
        const selectedSize = this.getAttribute('data-size');
        xhr.open('GET', `../include/getStok.php?size=${encodeURIComponent(selectedSize)}&Id=${encodeURIComponent(id)}`, true);
        xhr.send();
        });
});

function addToCart() {
    const activeButton = document.querySelector('.size-button.bg-gray-300');
    if (!activeButton) {
        alert('Silakan pilih ukuran terlebih dahulu');
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText === 'error') {
                alert('Gagal menambahkan produk ke keranjang. Silakan coba lagi.');
                return;
            }
            alert('Produk berhasil ditambahkan ke keranjang!');
            const cartCount = document.getElementById('cartCount');
            cartCount.textContent = parseInt(cartCount.textContent) + 1;
            cartCount.classList.remove('hidden');
        }
    };
    const selectedSize = activeButton.getAttribute('data-size');
    xhr.open('POST', '../include/addItem.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(`size=${encodeURIComponent(selectedSize)}&Id=${encodeURIComponent(id)}&email=${encodeURIComponent(email)}`);
}});
</script>
</body>
</html>