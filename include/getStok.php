<?php
require '../config/functions.php';

$id = $_GET['Id'];
$size = $_GET['size'];

if (empty($id) || empty($size)) {
    die("Parameter tidak valid");
}
$query = "SELECT * FROM barang WHERE Kode = '$id'";
$result =  select($query)[0];
if (!$result) {
    die("Produk tidak ditemukan");
}
$dataStok = $result[$size];

?>
<span id="stokValue"><?= $dataStok ?></span>