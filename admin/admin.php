<?php 
session_start();
$login = $_SESSION['login'] && ($_SESSION["role"] == "admin");
if(!$login) {
    header("Location: ../index.html");
    exit;
}
require '../config/functions.php';

//Pagination setup
$halamanAktif = $_GET["halaman"] ?? 1;
$isSearching = !empty($keyword);
$jumlahDataPerHalaman = $_GET['show'] ?? 5; // Default to 5 items per page

$jumlahdata = count(select("SELECT * FROM barang"));
$jumlahHalaman = ceil($jumlahdata / $jumlahDataPerHalaman);
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
$produk = select("SELECT * FROM barang ORDER BY Kode desc LIMIT $awalData, $jumlahDataPerHalaman");

//Menekan tombol cetak
if (isset($_POST['cetak'])) {
    echo cetak();
}
$counter = 1;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .product-img {
            max-width: 80px;
            height: auto;
            border-radius: 4px;
        }
        .action-buttons a {
            margin-right: 8px;
        }
        .search-box {
            max-width: 300px;
        }
        .form-label {
            font-weight: 500;
            font-size: 0.8rem;
            opacity: 0.8;
        }
        a {
            text-decoration: none;
        }
        .product-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        background-color: #f8f9fa;
        }
        .product-img.empty {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        color: #6c757d;
        font-size: 24px;
        }
    </style>
</head>
<body class="bg-light"> 
<div class="container py-5">

<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="display-5 fw-bold text-primary"><a href="../index.html"><i class="fas fa-boxes me-2"></i>Daftar Produk</a></h1>
    <a href="../include/logout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
</div>

<!-- Header nav -->
<div class="card shadow-sm">
<div class="card-header bg-white py-3">
<div class="row align-items-center">
    
    <!-- Left side - Search and Show -->
    <div class="col-md-6">
    <div class="d-flex flex-column flex-md-row align-items-md-center">
    <form class="d-flex search-box me-md-3 mb-2 mb-md-0">
        <input type="text" id="searchKeyword" class="form-control me-2" placeholder="Cari produk..." autocomplete="off">
    <input type="hidden" name="halaman" value="1">
    <input type="hidden" name="show" value="<?= $jumlahDataPerHalaman ?>">
    </form>
    
    <!-- Show per page -->
    <div id="show">
    <form method="get" class="d-flex align-items-center">
    <label for="show" class="form-label mb-0 me-2">Show:</label>
    <select name="show" id="show" onchange="this.form.submit()" class="form-select form-select-sm">
        <option value="5" <?= $jumlahDataPerHalaman == 5 ? 'selected' : '' ?>>5</option>
        <option value="10" <?= $jumlahDataPerHalaman == 10 ? 'selected' : '' ?>>10</option>
        <option value="15" <?= $jumlahDataPerHalaman == 15 ? 'selected' : '' ?>>15</option>
        <option value="20" <?= $jumlahDataPerHalaman == 20 ? 'selected' : '' ?>>20</option>
    </select>
    </div>

    <input type="hidden" name="halaman" value="1">
    </form>
    </div>
    </div>
            
    <!-- Right side - Buttons (horizontal) -->
    <div class="col-md-6 mt-3 mt-md-0 d-flex justify-content-end gap-2">
    <a href="tambahProduk.php" class="btn btn-success btn-md px-3 py-2">
    <i class="fas fa-plus me-1"></i> Tambah Produk
    </a>
    <a href="../include/print.php" class="btn btn-secondary btn-md px-3 py-2">
    <i class="fas fa-save me-1"></i> Print Laporan
    </a>
</div>
</div>
</div>

<!-- Table Data List -->
<div class="card-body p-0">
<div class="table-responsive" id="tableContainer">
<table class="table table-hover mb-0">
    <thead class="table-light">
        <tr>
        <th>No</th>
        <th width="120">Aksi</th>
        <th>Kode</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Ukuran</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($produk as $row) : ?>
        <tr>
        <td><?= $counter ?></td>
        <td class="action-buttons">
            <a href="ubah.php?Kode=<?= $row["Kode"]; ?>" class="btn btn-sm btn-warning" title="Ubah"><i class="fas fa-edit"></i></a>
            <a href="hapus.php?Kode=<?= urlencode($row["Kode"]); ?>&Gambar= <?= htmlspecialchars($row["Gambar"]); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?');" title="Hapus"><i class="fas fa-trash-alt"></i></a>
        </td>
        <td><?= htmlspecialchars($row["Kode"]); ?></td>
        <td><img src="../img/<?= htmlspecialchars($row["Gambar"])?>" alt="<?= htmlspecialchars($row["Nama"]) ?>" class="product-img" onerror="this.src='../img/Null-Image.png'"></td>
        <td><?= htmlspecialchars($row["Nama"]); ?></td>
        <td>S: <?= htmlspecialchars($row["Ukuran_S"]); ?> ||
            M: <?= htmlspecialchars($row["Ukuran_M"]); ?> <br>
            L: <?= htmlspecialchars($row["Ukuran_L"]); ?> ||
            XL: <?= htmlspecialchars($row["Ukuran_XL"]); ?></td>
        <td><?= htmlspecialchars($row["Ukuran_S"] + $row["Ukuran_M"] + $row["Ukuran_L"] + $row["Ukuran_XL"]); ?></td>
        <td>Rp <?= htmlspecialchars(number_format($row["Harga"], 0, ',', '.')); ?></td>
        <td><?= htmlspecialchars(substr($row["Deskripsi"], 0, 50) . (strlen($row["Deskripsi"]) > 50 ? '...' : '')); ?></td>
        </tr>
    <?php $counter++; endforeach; ?>
    </tbody>
</table>
</div>
</div>

</div> <!-- End of Table Container -->

<!-- Navigasi Pagination -->
<div id="paginationContainer">
<?php if ($jumlahdata > $jumlahDataPerHalaman) : ?>
<div class="d-flex my-2 mx-auto">
<nav aria-label="Page navigation" class="mx-auto">
<ul class="pagination pagination-sm mb-0">
    <?php if ($halamanAktif > 1) : ?>
        <li class="page-item">
        <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?><?= $isSearching ? '&keyword='.urlencode($keyword) : '' ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
    <?php endif; ?>
    <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <li class="page-item <?= ($halamanAktif == $i) ? 'active' : '' ?>">
        <a class="page-link" href="?halaman=<?= $i ?><?= $isSearching ? '&keyword='.urlencode($keyword) : '' ?>"><?= $i ?></a></li>    
    <?php endfor; ?>
    <?php if ($halamanAktif < $jumlahHalaman) :?>
        <li class="page-item">
        <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?><?= $isSearching ? '&keyword='.urlencode($keyword) : '' ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
    <?php endif; ?>
</ul>
</nav>
</div>
<?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

const keyword = document.getElementById('searchKeyword');
const tableData = document.getElementById('tableContainer');
const pagination = document.getElementById('paginationContainer');
const show = document.getElementById('show');

keyword.addEventListener('input', function() {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
            tableData.innerHTML = xhr.responseText;
            if(keyword.value.trim() !== '') {
                    pagination.style.display = 'none';
                    show.style.display = 'none';
                } 

                else {
                    pagination.style.display = 'block';
                    show.style.display = 'block';
                }
        }
    };
    xhr.open('GET', `../include/getKeyword.php?keyword=${encodeURIComponent(keyword.value)}`, true);
    xhr.send();
});
});
</script>
</body>
</html>