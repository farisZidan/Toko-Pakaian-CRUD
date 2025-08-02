  <body>
    <header class="header">
      <div class="logo">RB Gallery</div>
      <ul class="menu">
        <li><a href="login signup/login.php">Login</a></li>
        <li><a href="login signup/signup.php">Sign Up</a></li>
        <li><a href="#about">Tentang Kami</a></li>
      </ul>
    </header>

    <section class="hero">
      <div class="hero-text">
        <h1>Pakaian Batik terbaik untuk anda</h1>
        <p>Batik dengan kelembutan yang sangat halus</p>
        <a href="products/produk.php">Belanja Sekarang</a>
      </div>
    </section>

    <section class="section about-us">
      <h2 id="about">Tentang Kami</h2>
      <p>
        Kami adalah produsen batik yang mengutamakan kualitas, keindahan motif,
        dan kenyamanan. RB Gallery hadir untuk memenuhi kebutuhan Anda akan
        batik yang elegan dan tradisional, cocok untuk berbagai acara formal
        maupun santai, dengan desain yang khas dan bahan berkualitas tinggi.
      </p>
    </section>

    <section class="section store-details">
      <h2>Tentang Toko RB Gallery</h2>
      <p>
        RB Gallery adalah penyedia batik premium dengan sentuhan khas yang kaya
        akan nilai seni dan budaya. Kami menawarkan berbagai pilihan batik
        dengan motif unik dan bahan terbaik, memastikan kenyamanan Anda dalam
        setiap aktivitas. Dengan komitmen pada kepuasan pelanggan, kami juga
        menyediakan layanan pelanggan yang profesional dan proses pembelian yang
        mudah dan aman.
      </p>
    </section>

    <section class="products-section">
      <h2>Produk Terbaru Kami</h2>
      <div class="products-grid">
        <div class="product-card">
          <img src="<?= ASSETS_PATH ?>img/Batik 8.jpg" alt="Produk 1" />
          <h3>Batik Flora modern</h3>
          <p>Corak yang simple dan elegan.</p>
          <a href="<?= PUBLIC_PATH ?>Flora Modern">Lihat Detail</a>
        </div>
        <div class="product-card">
          <img src="<?= ASSETS_PATH ?>img/Batik 4.jpg" alt="Produk 2" />
          <h3>Batik Fauna modern</h3>
          <p>Motif Fauna yang elegan dan mewah.</p>
          <a href="<?= PUBLIC_PATH ?>Fauna Modern">Lihat Detail</a>
        </div>
        <div class="product-card">
          <img src="<?= ASSETS_PATH ?>img/Batik 9.jpg" alt="Produk 3" />
          <h3>Batik Flora simple</h3>
          <p>Motif dan Warna simple</p>
          <a href="<?= PUBLIC_PATH ?>Flora Simple">Lihat Detail</a>
        </div>
      </div>
    </section>