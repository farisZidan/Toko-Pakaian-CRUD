<?php
session_start();
require_once '../config/conn.php';

$userId = $_SESSION['user_id'] ?? 0;

// Dapatkan keranjang user
$cartQuery = "SELECT k.id FROM keranjang k WHERE k.user_id = ?";
$cartStmt = $conn->prepare($cartQuery);
$cartStmt->bind_param("i", $userId);
$cartStmt->execute();
$cart = $cartStmt->get_result()->fetch_assoc();

if($cart) {
    $cartId = $cart['id'];
    
    // Dapatkan item keranjang
    $itemsQuery = "
        SELECT 
            ki.id,
            b.nama,
            b.gambar,
            ki.ukuran,
            ki.jumlah,
            ki.harga
        FROM keranjang_item ki
        JOIN barang b ON ki.barang_id = b.id
        WHERE ki.keranjang_id = ?
    ";
    $itemsStmt = $conn->prepare($itemsQuery);
    $itemsStmt->bind_param("i", $cartId);
    $itemsStmt->execute();
    $items = $itemsStmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    if($items) {
        $subtotal = 0;
        $totalItems = 0;
        
        foreach($items as $item) {
            $subtotal += $item['harga'] * $item['jumlah'];
            $totalItems += $item['jumlah'];
        }
        
        // Render HTML langsung
        echo '<div class="cart-content">';
        echo '<div class="cart-items">';
        
        foreach($items as $item) {
            echo '
            <div class="cart-item" data-id="'.$item['id'].'">
                <img src="../images/'.$item['gambar'].'" alt="'.$item['nama'].'" class="cart-item-img">
                <div class="cart-item-details">
                    <h3 class="cart-item-title">'.$item['nama'].'</h3>
                    <p class="cart-item-price">Rp'.number_format($item['harga'], 0, ',', '.').'</p>
                    <p>Ukuran: '.$item['ukuran'].'</p>
                    <div class="cart-item-quantity">
                        <button class="quantity-btn minus" onclick="updateQuantity('.$item['id'].', -1)">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="text" class="quantity-input" value="'.$item['jumlah'].'" readonly>
                        <button class="quantity-btn plus" onclick="updateQuantity('.$item['id'].', 1)">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <button class="remove-item" onclick="removeItem('.$item['id'].')">
                    <i class="fas fa-trash"></i>
                </button>
            </div>';
        }
        
        echo '</div>';
        
        // Cart summary
        echo '<div class="cart-summary">
                <h3 class="summary-title">Ringkasan Belanja</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>Rp'.number_format($subtotal, 0, ',', '.').'</span>
                </div>
                <div class="summary-row">
                    <span>Ongkos Kirim</span>
                    <span>Rp10.000</span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span>Rp'.number_format($subtotal + 10000, 0, ',', '.').'</span>
                </div>
                <button class="checkout-btn" onclick="window.location.href=\'order-form.html\'">Lanjut ke Pembayaran</button>
                <a href="../products/produk.php" class="continue-shopping">Lanjutkan Belanja</a>
              </div>';
        
        echo '</div>';
    } else {
        // Tampilkan keranjang kosong
        echo '
        <div class="empty-cart">
            <div class="empty-cart-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <p class="empty-cart-message">Keranjang belanja Anda kosong</p>
            <a href="../products/produk.php" class="continue-shopping">Lanjutkan Belanja</a>
        </div>';
    }
} else {
    // Tampilkan keranjang kosong
    echo '
    <div class="empty-cart">
        <div class="empty-cart-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <p class="empty-cart-message">Keranjang belanja Anda kosong</p>
        <a href="../products/produk.php" class="continue-shopping">Lanjutkan Belanja</a>
    </div>';
}
?>