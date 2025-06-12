<?php
session_start();
if(!isset($_SESSION["login"])) {
    header("Location: ../index.html");
    exit;
}
require '../config/functions.php';

$kode = $_GET['Kode'];
$produk = select("SELECT * FROM barang WHERE Kode = $kode")[0];

if (!$produk) {
    die("Produk tidak ditemukan");
}

if (isset($_POST['submit'])) {
    if(update($_POST) > 0) {
        echo "
        <script>
        alert('Data berhasil diubah!');
        document.location.href = 'admin.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Data gagal diubah!');
        document.location.href = 'admin.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .product-img {
            max-width: 100px;
            height: auto;
            border-radius: 4px;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm form-container">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0"><i class="fas fa-edit me-2"></i>Ubah Data Barang</h1>
            </div>
            
            <div class="card-body">
                <!-- Current Data Display -->
                <div class="mb-4 p-3 border rounded bg-white">
                    <h5 class="mb-3 text-muted">Data Saat Ini</h5>
                    <div class="row">
                        <div class="col-md-2 fw-bold">Kode:</div>
                        <div class="col-md-10"><?= htmlspecialchars($produk["Kode"]); ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2 fw-bold">Gambar:</div>
                        <div class="col-md-10">
                            <img src="../img/<?= htmlspecialchars($produk["Gambar"]); ?>" alt="<?= htmlspecialchars($produk["Nama"]); ?>" class="product-img">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2 fw-bold">Nama:</div>
                        <div class="col-md-10"><?= htmlspecialchars($produk["Nama"]); ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2 fw-bold">Stok:</div>
                        <div class="col-md-10"><?= htmlspecialchars($produk["Stok"]); ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2 fw-bold">Harga:</div>
                        <div class="col-md-10">Rp <?= number_format($produk["Harga"], 0, ',', '.'); ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2 fw-bold">Deskripsi:</div>
                        <div class="col-md-10"><?= htmlspecialchars($produk["Deskripsi"]); ?></div>
                    </div>
                </div>

                <!-- Edit Form -->
                <form method="POST" enctype="multipart/form-data">
                    <h5 class="mb-3 text-muted">Form Perubahan</h5>
                    <input type="hidden" name='gambarLama' value="<?= $produk["Gambar"]; ?>">
                    <input type="hidden" name='Kode' value="<?= $produk["Kode"]; ?>">
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Baru</label>
                        <input type="file" accept="image/*" class="form-control" id="gambar" name="Gambar">
                    </div>
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama" name="Nama" 
                               value="<?= htmlspecialchars($produk["Nama"]); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="Stok" 
                               value="<?= htmlspecialchars($produk["Stok"]); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="harga" name="Harga" 
                                   value="<?= htmlspecialchars($produk["Harga"]); ?>">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="Deskripsi" 
                                  rows="3"><?= htmlspecialchars($produk["Deskripsi"]); ?></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="admin.php" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>