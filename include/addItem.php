<?php
include '../config/conn.php';

if (!isset($_POST['email']) || !isset($_POST['Id']) || !isset($_POST['size'])) {
    die("error: missing parameters");
}

$useremail = $_POST['email'];
$itemId = $_POST['Id'];
$size = '';
$userID = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM user WHERE email = '$useremail'"))['id'];

switch ($_POST['size']) {
    case 'Ukuran_S':
        $size = 'S';
        break;
    case 'Ukuran_M':
        $size = 'M';
        break;
    case 'Ukuran_L':
        $size = 'L';
        break;
    case 'Ukuran_XL':
        $size = 'XL';
        break;
    default:
        die("error: invalid size");
}

// ---- Cek dan Buat Keranjang ----
$cartQuery = "SELECT id FROM keranjang WHERE user_id = '$userID'";
$cartResult = mysqli_query($conn, $cartQuery);

if (!$cartResult) {
    die("error: cart query failed " . mysqli_error($conn));
}

$cartId = 0;

if (mysqli_num_rows($cartResult) == 0) {
    // Buat keranjang baru jika belum ada
    $insertCartQuery = "INSERT INTO keranjang (user_id) VALUES ('$userID')";
    $insertCartResult = mysqli_query($conn, $insertCartQuery);

    if (!$insertCartResult) {
        die("error: insert cart failed " . mysqli_error($conn));
    }
    $cartId = mysqli_insert_id($conn); // Dapatkan ID yang baru dibuat
} else {
    //ambil ID keranjang
    $cart = mysqli_fetch_assoc($cartResult);
    $cartId = $cart['id'];
}

// ---- Cek dan Tambahkan Item ke Keranjang ----
$checkItem = "SELECT id, jumlah FROM item_keranjang 
              WHERE keranjang_id = '$cartId' AND barang_id = '$itemId' AND ukuran = '$size'";
$itemResult = mysqli_query($conn, $checkItem);

if (!$itemResult) {
    die("error: check item query failed " . mysqli_error($conn));
}

if (mysqli_num_rows($itemResult) > 0) {
    // Update quantity jika item sudah ada
    $item = mysqli_fetch_assoc($itemResult);
    $newQuantity = $item['jumlah'] + 1;
    $updateItemQuery = "UPDATE item_keranjang SET jumlah = '$newQuantity' WHERE id = '{$item['id']}'";
    $updateItemResult = mysqli_query($conn, $updateItemQuery);

    if (!$updateItemResult) {
        die("error: update item failed " . mysqli_error($conn));
    }
    echo "quantity_updated";
} else {
    // Tambahkan item baru jika belum ada
    // Ambil harga dari tabel barang (asumsi ada kolom harga di tabel 'barang')
    $hargaQuery = "SELECT Harga FROM barang WHERE Kode = '$itemId'";
    $hargaResult = mysqli_query($conn, $hargaQuery);

    if (!$hargaResult) {
        die("error: price query failed " . mysqli_error($conn));
    }

    if (mysqli_num_rows($hargaResult) == 0) {
        die("error: product not found or no price");
    }

    $hargaRow = mysqli_fetch_assoc($hargaResult);
    $harga = $hargaRow['Harga'];

    $insertItemQuery = "INSERT INTO item_keranjang 
                        (keranjang_id, barang_id, ukuran, jumlah, harga) 
                        VALUES ('$cartId', '$itemId', '$size', 1, '$harga')";
    $insertItemResult = mysqli_query($conn, $insertItemQuery);

    if (!$insertItemResult) {
        die("error: insert item failed " . mysqli_error($conn));
    }
    echo "item_added";
}

mysqli_close($conn);
?>