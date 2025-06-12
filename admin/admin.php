<?php 
session_start();
if(!isset($_SESSION["login"])) {
    header("Location: ../index.html");
    exit;
}

require '../config/functions.php';

//Pagination setup
$halamanAktif = $_GET["halaman"] ?? 1;
$keyword = $_GET['keyword'] ?? '';
$isSearching = !empty($keyword);
$jumlahDataPerHalaman = 5;

//Menekan tombol cari
if ($isSearching) {
    $jumlahdata = count(select("SELECT * FROM barang WHERE
                Nama LIKE '%$keyword%' OR
                Harga LIKE '%$keyword%'"));
    $jumlahHalaman = ceil($jumlahdata / $jumlahDataPerHalaman);
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
    $produk = select("SELECT * FROM barang WHERE
                Nama LIKE '%$keyword%' OR
                Harga LIKE '%$keyword%' ORDER BY Kode desc LIMIT $awalData, $jumlahDataPerHalaman");
} else {
    $jumlahdata = count(select("SELECT * FROM barang"));
    $jumlahHalaman = ceil($jumlahdata / $jumlahDataPerHalaman);
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
    $produk = select("SELECT * FROM barang ORDER BY Kode desc LIMIT $awalData, $jumlahDataPerHalaman");
    
}

//Menekan tombol cetak
if (isset($_POST['cetak'])) {
    echo cetak();
}
$counter = $awalData + 1;
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
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5 fw-bold text-primary">
                <i class="fas fa-boxes me-2"></i>Daftar Produk
            </h1>
            <a href="../include/logout.php" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                 <form method="get" class="d-flex search-box">
                     <input type="text" class="form-control me-2" placeholder="Cari produk..." name="keyword" autocomplete="off">
                     <input type="hidden" name="halaman" value="1">
                     <button type="submit" class="btn btn-primary" name="cari">
                      <i class="fas fa-search"></i>
                     </button>
                 </form>
                 <form action="post">
                    <input type="number" name="jumlahDataPerHalaman" id="jumlahDataPerhalaman">
                 </form>
                
                <div class="d-flex align-items-center">
                    <form method="post" class="me-2">
                    <button type="submit" name="cetak" class="btn btn-secondary text-white">
                     <i class="bi bi-printer me-1"></i> Cetak Laporan
                    </button>
                    </form>
        
                    <a href="tambahProduk.php" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i> Tambah Produk
                    </a>
                </div>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th width="120">Aksi</th>
                                <th>Kode</th>
                                <th>Gambar</th>
                                <th>Nama</th>
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
                                    <a href="ubah.php?Kode=<?= $row["Kode"]; ?>" class="btn btn-sm btn-warning" title="Ubah">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="hapus.php?Kode=<?= $row["Kode"]; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?');" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($row["Kode"]); ?></td>
                                <td>
                                    <img src="../img/<?= htmlspecialchars($row["Gambar"]); ?>" alt="<?= htmlspecialchars($row["Nama"]); ?>" class="product-img">
                                </td>
                                <td><?= htmlspecialchars($row["Nama"]); ?></td>
                                <td><?= htmlspecialchars($row["Stok"]); ?></td>
                                <td>Rp <?= htmlspecialchars(number_format($row["Harga"], 0, ',', '.')); ?></td>
                                <td><?= htmlspecialchars(substr($row["Deskripsi"], 0, 50) . (strlen($row["Deskripsi"]) > 50 ? '...' : '')); ?></td>
                            </tr>
                            <?php $counter++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
             <!-- Navigasi Pagination -->
              <div class="my-3 mx-auto">
                 <nav aria-label="Page navigation" class="mx-auto">
                    <ul class="pagination pagination-sm mb-0">
                      <?php if ($halamanAktif > 1) : ?>
                        <li class="page-item">
                             <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?><?= $isSearching ? '&keyword='.urlencode($keyword) : '' ?>" aria-label="Previous">
                             <span aria-hidden="true">&laquo;</span>
                             </a>
                        </li>
                      <?php endif; ?>
                      <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                            <li class="page-item <?= ($halamanAktif == $i) ? 'active' : '' ?>">
                            <a class="page-link" href="?halaman=<?= $i ?><?= $isSearching ? '&keyword='.urlencode($keyword) : '' ?>"><?= $i ?></a>
                            </li>    
                      <?php endfor; ?>
                      <?php if ($halamanAktif < $jumlahHalaman) :?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?><?= $isSearching ? '&keyword='.urlencode($keyword) : '' ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                      <?php endif; ?>
                    </ul>
                 </nav>
             </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>