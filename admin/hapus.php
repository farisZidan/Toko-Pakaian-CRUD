<?php
session_start();
$login = $_SESSION['login'] && ($_SESSION["role"] == "admin");
if(!$login) {
    header("Location: ../index.html");
    exit;
}
require '../config/functions.php';

$kode = $_GET['Kode'];
$gambar = $_GET['Gambar'];

if(hapus($kode, $gambar) > 0) {
    echo "
        <script>
        alert('Data berhasil dihapus !');
        document.location.href = 'admin.php';
        </script>
        ";
} else {
    echo "
        <script>
        alert('Data gagal dihapus !');
        // document.location.href = 'admin.php';
        </script>
        ";
}
?>