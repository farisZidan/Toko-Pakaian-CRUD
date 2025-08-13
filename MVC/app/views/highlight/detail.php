<header class="header">
  <div class="logo"><a href="<?= PUBLIC_ ?>">RB Gallery</a></div>
  <ul class="menu">
    <li><a href="#">Login</a></li>
    <li><a href="#">Sign In</a></li>
    <li><a href="#">Tentang Kami</a></li>
  </ul>
</header>

<section class="product-detail">
  <div class="carousel">
    <div class="carousel-images">
      <img src="<?= IMG_ . $data['img'][0] ?>" alt="Batik 1" />
      <img src="<?= IMG_ . $data['img'][1] ?>" alt="Batik 2" />
      <img src="<?= IMG_ . $data['img'][2] ?>" alt="Batik 3" />
    </div>
  </div>
  <h1><?= $data['name'] ?></h1>
  <p><?= $data['description'] ?></p>
  <a href="produk.php" class="back-btn">Produk Lainnya</a>
</section>