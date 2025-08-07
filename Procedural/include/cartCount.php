<?php
require_once '../config/conn.php';

$email = $_GET['email'] ?? '';
    if (!$email) {exit;}

if ($_GET['cartCount'] == 'true') {

    // Dapatkan keranjang user
    $cartQuery = "SELECT k.id FROM keranjang as k JOIN user as u ON u.id = k.user_id WHERE u.email = '$email'";
    $cart = mysqli_fetch_assoc(mysqli_query($conn, $cartQuery));

    // Dapatkan item di dalam keranjang
    if($cart) {
    $cartId = $cart['id'];   
    $sumQuery = "SELECT SUM(jumlah) as totalItem FROM item_keranjang WHERE keranjang_id = '$cartId'
    ";
    $result = mysqli_query($conn, $sumQuery);
    $totalItem = mysqli_fetch_assoc($result)['totalItem'];
        } else {
                $totalItem = 0;
        }

    echo $totalItem;
    exit;
  }
echo '0';
?>