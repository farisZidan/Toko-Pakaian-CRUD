<?php
// Update jumlah item di keranjang
require '../config/conn.php';
if (isset($_GET['id']) && isset($_GET['change'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $jumlah = (int)$_GET['change'];

    // Update jumlah di database
    $updateQuery = "UPDATE item_keranjang SET jumlah = '$jumlah' WHERE id = '$id'";
    if(!mysqli_query($conn, $updateQuery)) {
        http_response_code(500);
        echo "Error updating quantity";
        exit;
    }
}
?>