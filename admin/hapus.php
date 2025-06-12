<?php
session_start();
if(!isset($_SESSION["login"])) {
    header("Location: ../index.html");
    exit;
}
require '../config/functions.php';

$kode = $_GET['Kode'];

if(hapus($kode) > 0 ) {
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
        document.location.href = 'admin.php';
        </script>
        ";
}
?>