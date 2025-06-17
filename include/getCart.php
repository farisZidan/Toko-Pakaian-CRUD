<?php
require_once '../config/conn.php';
$email = $_GET['email'];

if (!$email) {
    exit;}

// Dapatkan keranjang user
$cartQuery = "SELECT k.id FROM keranjang as k JOIN user as u ON u.id = k.user_id WHERE u.email = '$email'";
$cart = mysqli_fetch_assoc(mysqli_query($conn, $cartQuery));

// Jika ada keranjang, ambil item di dalamnya
if($cart) {
    $cartId = $cart['id'];   
    $itemsQuery = "SELECT b.Nama, b.Gambar, ik.id, ik.barang_id, ik.ukuran, ik.jumlah, ik.harga FROM item_keranjang AS ik JOIN barang AS b ON ik.barang_id = b.Kode WHERE ik.keranjang_id = '$cartId' ORDER BY b.Nama ASC;
    ";
    $result = mysqli_query($conn, $itemsQuery);
    $items = [];
    while ($data = mysqli_fetch_assoc($result)) {
    $items[] = $data;
    }
} else { 
    echo mysqli_error($conn);
}
// Jumlah item di keranjang
$jumlahItem = 0;
// Inisialisasi total harga
$totalHarga = 0;
// Inisialisasi ongkir
$ongkir = 10000;

if (empty($items)) {
    echo '<div id="emptyCart" class="empty-cart">Keranjang Anda kosong</div>';
    exit;
}
foreach($items as $index => $item) : ?>
    <div class="cart-item" data-id="<?= htmlspecialchars($item['id']);?>">
    <img src="../img/<?= htmlspecialchars($item['Gambar']);?>" alt="<?= $item['Nama'];?>" class="cart-item-img" onerror="this.src='../img/Null-Image.png'">
        <div class="cart-item-details">
            <h3 class="cart-item-title"><?= htmlspecialchars($item['Nama']);?></h3>
            <p class="cart-item-price">Rp<?=number_format( htmlspecialchars($item['harga']), 0, ',', '.');?></p>
            <p>Ukuran: <?= $item['ukuran'];?></p>

            <div class="cart-item-quantity">
            <button class="quantity-btn plus" data-change="-1">
            <i class="fas fa-minus"></i>
            </button>
            <input type="text" class="quantity-input" value="<?= $item['jumlah'];?>" readonly>
            <button class="quantity-btn plus" data-change="1">
            <i class="fas fa-plus"></i>
            </button>
            <input type="hidden" id="id_keranjang" value="<?= htmlspecialchars($item['id']);?>">
            </div>
        </div>
    <button id="remove-item" class="remove-item" value="<?= htmlspecialchars($item['id']); ?>">
        <i class="fas fa-trash"></i>
    </button>
    </div>
    <div class="summary-row">
        <span>Subtotal</span>
        <span id="subtotal">Rp<?=number_format( htmlspecialchars($item['harga']) * htmlspecialchars($item['jumlah']), 0, ',', '.');?></span>
    </div>
    <?php
    $totalHarga += htmlspecialchars($item['harga']) * htmlspecialchars($item['jumlah']);
    $jumlahItem += htmlspecialchars($item['jumlah']);
    ?>
<?php endforeach; ?>
    <div class="summary-row">
    <span>Ongkos Kirim</span>
    <span id="shipping">Rp<?= number_format($ongkir, 0, ',', '.'); ?></span>
    </div>
    <div class="summary-row summary-total">
    <span>Total</span>
    <span id="total">Rp<?= number_format($totalHarga + $ongkir, 0, ',', '.'); ?></span>
    </div>
    <button class="checkout-btn" onclick="window.location.href='../user/order-form.html'">Lanjut ke Pembayaran</button>
    <div class="nav-links">
    <a href="../products/produk.php" class="continue-shopping" onclick="goBack()">Lanjutkan Belanja</a>
    </div>