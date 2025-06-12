<?php
require '../config/functions.php';
$produk = select("SELECT * FROM barang");
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ProduRB Gallery</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <!-- Font Awesome for icons -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
    <style>
      * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: "Poppins", sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            padding: 20px 50px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .header .logo {
            font-size: 24px;
            font-weight: bold;
            color: #000000;
        }
        .header nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .header nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 16px;
        }
        .header nav a:hover {
            color: #e63946;
        }

        /* Cart Icon Styles */
        .cart-icon {
            position: relative;
            width: 40px;
            height: 40px;
            background-color: #3b82f6;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }
        .cart-icon:hover {
            background-color: #2563eb;
            transform: translateY(-3px);
        }
        .cart-icon i {
            font-size: 18px;
            color: white;
        }
        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ef4444;
            color: white;
            font-size: 10px;
            font-weight: bold;
            min-width: 18px;
            height: 18px;
            border-radius: 9px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 4px;
            border: 2px solid white;
            display: none;
        }
        .cart-has-items .cart-count {
            display: flex;
        }

        /* Product Section */
        .product-section {
            padding: 40px 20px;
            max-width: 1400px;
            margin: 0 auto;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            justify-items: center;
        }
        .product-card {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            max-width: 300px;
            position: relative;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .product-image {
            position: relative;
            overflow: hidden;
            height: 200px;
        }
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }
        .discount-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #e63946;
            color: #fff;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            z-index: 2;
        }
        .product-info {
            padding: 15px;
            text-align: center;
        }
        .product-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
            height: 40px;
            overflow: hidden;
            display: webkit-box;
            webkit-line-clamp: 2;
            webkit-box-orient: vertical;
        }
        .product-prices {
            font-size: 16px;
            margin-bottom: 10px;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        .price-discount {
            color: #e63946;
            font-weight: bold;
        }
        .price-original {
            text-decoration: line-through;
            color: #aaa;
            font-size: 14px;
        }
        .product-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #030504;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
            width: 100%;
            text-align: center;
        }
        .product-btn:hover {
            background-color: #e63946;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 20px;
            }
            .product-image {
                height: 180px;
            }
        }

        @media (max-width: 480px) {
            .product-grid {
                grid-template-columns: 1fr;
            }
            .product-card {
                max-width: 100%;
            }
        }
    </style>
  </head>
  <body>
    <header class="header">
      <div class="logo">
        <a href="../index.html" style="text-decoration: none; color: inherit"
          >RB Gallery</a
        >
      </div>
      <nav>
        <a href="../user/kontak.html">Kontak</a>
        <div class="cart-icon" onclick="window.location.href='../user/cart.html';">
          <i class="fas fa-shopping-cart"></i>
          <span id="cartCount" class="cart-count">0</span>
        </div>
      </nav>
    </header>
    <!-- Produk Section -->    
     <section class="product-section">     
      <div class="product-grid">
        <?php foreach($produk as $barangArr) : ?>
        <div class="product-card">
          <div class="product-image">
              <img src="../img/<?= $barangArr["Gambar"]; ?> " width="50"/>
              <div class="discount-badge">55% OFF</div>
            </a>
          </div>
          <div class="product-info">
            <h3 class="product-title">
              <a
                href="detail.php?Nama=<?= $barangArr['Nama'] ?>"
                style="text-decoration: none; color: inherit"><?= $barangArr["Nama"]; ?></a>
            </h3>
            <div class="product-prices">
                        <span class="price-discount">Rp<?= number_format($barangArr['Harga'] * 0.55, 0, ',', '.') ?></span>
                        <span class="price-original">Rp<?= number_format($barangArr['Harga'], 0, ',', '.') ?></span>
                    </div>
            <a href="detail.php?Nama=<?= $barangArr['Nama'] ?>" class="product-btn">Beli Sekarang</a>
          </div>
          </div>
           <?php endforeach; ?>
        </div>
       </section> 
  </body>
</html>
