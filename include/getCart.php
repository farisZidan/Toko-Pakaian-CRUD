<?php
require_once '../config/conn.php';

$email = $_GET['email'];
if (!$email) {
    echo "div.empty-cart {
        display: block;
        text-align: center;
        margin-top: 50px;
    }";
    exit;
}

// Dapatkan keranjang user
$cartQuery = "SELECT k.id FROM keranjang as k JOIN user as u ON u.id = k.user_id WHERE u.email = '$email'";
$cart = mysqli_fetch_assoc(mysqli_query($conn, $cartQuery));

// Jika ada keranjang, ambil item di dalamnya
if($cart) {
    $cartId = $cart['id'];   
    $itemsQuery = "SELECT b.Kode, b.Nama, b.Gambar, ik.ukuran, ik.jumlah, ik.harga FROM item_keranjang AS ik JOIN barang AS b ON ik.barang_id = b.Kode WHERE ik.keranjang_id = '$cartId' ORDER BY b.Nama ASC;
    ";
    $result = mysqli_query($conn, $itemsQuery);
    $items = [];
    while ($data = mysqli_fetch_assoc($result)) {
    $items[] = $data;
    }
} else { 
    echo mysqli_error($conn);
}
// Menambah jumlah harga dan total harga
// $jumlahHarga = 0;
$totalHarga = 0;
?>

<?php foreach($items as $item) : ?>
    <div class="cart-item" data-id="<?= htmlspecialchars($item['Kode']);?>">
    <img src="../img/<?= htmlspecialchars($item['Gambar']);?>" alt="<?= $item['Nama'];?>" class="cart-item-img" onerror="this.src='../img/Null-Image.png'">
        <div class="cart-item-details">
            <h3 class="cart-item-title"><?= htmlspecialchars($item['Nama']);?></h3>
            <p class="cart-item-price">Rp<?=number_format( htmlspecialchars($item['harga']), 0, ',', '.');?></p>
            <p>Ukuran: <?= $item['ukuran'];?></p>
            <div class="cart-item-quantity">
            <button class="quantity-btn minus" onclick="updateQuantity(<?= htmlspecialchars($item['jumlah']);?>, -1)">
            <i class="fas fa-minus"></i>
            </button>
            <input type="text" class="quantity-input" value="<?= $item['jumlah'];?>" readonly>
            <button class="quantity-btn plus" onclick="updateQuantity('<?= htmlspecialchars($item['jumlah']);?>', 1)">
            <i class="fas fa-plus"></i>
            </button>
            </div>
        </div>
    <button class="remove-item" onclick="removeItem('<?= htmlspecialchars($item['Kode']);?>')">
        <i class="fas fa-trash"></i>
    </button>
    </div>
    <div class="summary-row">
        <span>Subtotal</span>
        <span id="subtotal">Rp<?=number_format( htmlspecialchars($item['harga']) * htmlspecialchars($item['jumlah']), 0, ',', '.');?></span>
    </div>
    <?php
    $totalHarga += htmlspecialchars($item['harga']) * htmlspecialchars($item['jumlah']);
    ?>
<?php endforeach; ?>

    <div class="summary-row">
    <span>Ongkos Kirim</span>
    <span id="shipping">Rp10.000</span>
    </div>
    <div class="summary-row summary-total">
    <span>Total</span>
    <span id="total">Rp<?= number_format($totalHarga, 0, ',', '.'); ?></span>
    </div>
    <button class="checkout-btn" onclick="window.location.href='order-form.html'">Lanjut ke Pembayaran</button>
    <a href="../products/produk.php" class="continue-shopping">Lanjutkan Belanja</a>
    </div>