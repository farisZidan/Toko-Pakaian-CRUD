<header class="header">
      <div class="logo">
        <a href="../index.html" style="text-decoration: none; color: inherit"
          >RB Gallery</a
        >
      </div>
      <nav>
        <a href="../user/kontak.html">Kontak</a>
        <div class="cart-icon" onclick="window.location.href='cart.php';">
          <i class="fas fa-shopping-cart"></i>
          <span id="cartCount" class="cart-count">0</span>
        </div>
      </nav>
    </header>
    <!-- Produk Section -->    
     <section class="product-section">     
      <div class="product-grid">
        <?php foreach($data as $barangArr) : ?>
        <div class="product-card">
          <div class="product-image">
              <img src="<?=IMG_ . $barangArr["Gambar"]; ?> " width="50" onerror="this.src='<?=IMG_?>Null-Image.png'" alt="<?= $barangArr["Nama"]; ?>">
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
            <a href="detail.php?Id=<?= $barangArr['Kode'] ?>" class="product-btn">Beli Sekarang</a>
          </div>
          </div>
           <?php endforeach; ?>
        </div>
       </section>
