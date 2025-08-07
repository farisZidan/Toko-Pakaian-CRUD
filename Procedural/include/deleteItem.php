<?php
require_once '../config/conn.php';
if (isset($_GET['id'])) {
    echo "sukses";
    mysqli_query($conn, "DELETE FROM item_keranjang WHERE id = '" . mysqli_real_escape_string($conn, $_GET['id']) . "'");
    if (mysqli_affected_rows($conn) > 0) {
        // Jika berhasil, tampilkan keranjang yang diperbarui
        echo "<script>
        console.log(sukses);</script>";
    } else {
        http_response_code(500);
        echo "Error deleting item";
    }
}
?>