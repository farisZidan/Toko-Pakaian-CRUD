<?php
session_start();
$login = $_SESSION['login'] && ($_SESSION["role"] == "admin");
if(!$login) {
    header("Location: ../index.html");
    exit;
}
require '../config/functions.php';

if (isset($_POST['submit'])) {
    if(insert($_POST) > 0) {
        echo "
        <script>
        alert('Data berhasil ditambahkan!');
        document.location.href = 'admin.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Data gagal ditambahkan!');
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
    <title>Tambah Produk Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .form-label {
            font-weight: 500;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm form-container">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Produk Baru</h1>
                <h1 class="h4 mb-0"><a href="admin.php" class="h4"><i class="fas fa-arrow-circle-left"></i></a></h1>
            </div>
            
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama" name="Nama" required>
                        <div class="form-text">Masukkan nama produk</div>
                    </div>

                     <div class="mb-3"> <label class="form-label">Ukuran Produk:</label> <div class="row g-2"> <div class="col-auto"> <div class="input-group">
                <span class="input-group-text">S</span>
                <input type="number" class="form-control" name="Ukuran_S" 
                       value="<?= htmlspecialchars($produk["Ukuran_S"]); ?>" style="max-width: 60px;"> 
            </div>
        </div>

        <div class="col-auto">
            <div class="input-group">
                <span class="input-group-text">M</span> <input type="number" class="form-control" name="Ukuran_M" 
                       value="<?= htmlspecialchars($produk["Ukuran_M"]); ?>" style="max-width: 60px;">
            </div>
        </div>

        <div class="col-auto">
            <div class="input-group">
                <span class="input-group-text">L</span> <input type="number" class="form-control" name="Ukuran_L" 
                       value="<?= htmlspecialchars($produk["Ukuran_L"]); ?>" style="max-width: 60px;">
            </div>
        </div>

        <div class="col-auto">
            <div class="input-group">
                <span class="input-group-text">XL</span> <input type="number" class="form-control" name="Ukuran_XL" 
                       value="<?= htmlspecialchars($produk["Ukuran_XL"]); ?>" style="max-width: 60px;">
            </div>
        </div>
    </div>
</div>
                    
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Produk</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="gambar" name="Gambar" accept="image/*">
                        </div>
                        <div class="form-text">Upload gambar produk</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="harga" name="Harga" min="0" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                        <textarea class="form-control" id="deskripsi" name="Deskripsi" rows="5"></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="admin.php" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" name="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>