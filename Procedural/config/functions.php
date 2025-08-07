<?php 
include 'conn.php';
// Function Select
function select($query) {
    global $conn;
    $stmt = $conn->query($query);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

// Function Insert
function insert($data) {
    global $conn;

    $gambar = upload() ?? null;
    $productData = [
        'nama' => $data["Nama"],
        'ukuranS' => $data["Ukuran_S"],
        'ukuranM' => $data["Ukuran_M"],
        'ukuranL' => $data["Ukuran_L"],
        'ukuranXL' => $data["Ukuran_XL"],
        'harga' => $data["Harga"],
        'deskripsi' => $data["Deskripsi"],
        'gambar' => $gambar
    ];

    try {
        $stmt = $conn->prepare("INSERT INTO barang (Nama, Ukuran_S, Ukuran_M, Ukuran_L, Ukuran_XL, Harga, Deskripsi, Gambar) VALUES (:nama, :ukuranS, :ukuranM, :ukuranL, :ukuranXL, :harga, :deskripsi, :gambar)");
        $stmt->execute($productData);
        return $stmt->rowCount(); // Mengembalikan jumlah baris yang terpengaruh
    } catch (PDOException $e) {
        echo "<script>
        alert('Gagal menambah barang: " . addslashes($e->getMessage()) . "');
        document.location.href = 'tambahProduk.php';
        </script>";
        return false;
    }
}

function upload() {
    // 1. Jika tidak ada file diupload, berhenti tanpa pesan
    if (!isset($_FILES['Gambar']) || $_FILES['Gambar']['error'] === UPLOAD_ERR_NO_FILE) {
        return false; // Berhenti tanpa pesan
    }

    // Persiapan data file
    $namaFile = $_FILES['Gambar']['name'];
    $ukuranFile = $_FILES['Gambar']['size'];
    $error = $_FILES['Gambar']['error'];
    $tmpName = $_FILES['Gambar']['tmp_name'];

    // 2. Cek jika ada error upload selain "no file"
    if ($error !== UPLOAD_ERR_OK) {
        echo "<script>
        alert('Terjadi kesalahan saat mengupload file');
        document.location.href = 'tambahProduk.php';
        </script>";
        return false;
    }

    // Validasi ekstensi file
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    // 3. Jika ekstensi tidak valid
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Masukan gambar dengan format: jpg, jpeg, png!');
        window.history.back();
        </script>";
        return false;
    }

    // 4. Jika ukuran file terlalu besar (5MB)
    if ($ukuranFile > 5000000) {
        echo "<script>
        alert('Ukuran gambar terlalu besar! Maksimal 5MB');
        document.location.href = 'tambahProduk.php';
        </script>";
        return false;
    }

    // Generate nama file baru
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    $tujuan = '../img/' . $namaFileBaru;

    // Cek apakah file benar-benar file upload
    if (!is_uploaded_file($tmpName)) {
        return false;
    }

    // Pindahkan file ke folder tujuan
    if (move_uploaded_file($tmpName, $tujuan)) {
        return $namaFileBaru; // 5. Keadaan berhasil normal
    } else {
        echo "<script>
        alert('Gagal menyimpan gambar');
        document.location.href = 'tambahProduk.php';
        </script>";
        return false;
    }
}

// Function Hapus
function hapus($kode, $gambar) {
    global $conn;
    $stmt = $conn->query("DELETE FROM barang WHERE Kode = $kode");
    deleteFile($gambar);
    return $stmt->rowCount();
}

// Function Hapus Image
function deleteFile($path) {
    $result = unlink("../img/$path");
    error_log("Delete result: " . ($result ? "success" : "failed") . " - $path");
    return $result;
}

// Function Update
function update($data) {
    global $conn;

    $gambarLama = $data['gambarLama'];
    if (!isset($_FILES['Gambar']) || $_FILES['Gambar']['error'] === UPLOAD_ERR_NO_FILE) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    
    $productData = [
        'kode' => $data["Kode"],
        'gambar' => $gambar,
        'nama' => $data["Nama"],
        'ukuranS' => $data["Ukuran_S"],
        'ukuranM' => $data["Ukuran_M"],
        'ukuranL' => $data["Ukuran_L"],
        'ukuranXL' => $data["Ukuran_XL"],
        'harga' => $data["Harga"],
        'deskripsi' => $data["Deskripsi"]
    ];
     
    $query = "UPDATE barang SET 
                          Gambar = :gambar, 
                          Nama = :nama, 
                          Ukuran_S = :ukuranS,
                          Ukuran_M = :ukuranM,
                          Ukuran_L = :ukuranL,
                          Ukuran_XL = :ukuranXL,
                          Harga = :harga, 
                          Deskripsi = :deskripsi
                          WHERE Kode = :kode";
    $stmt = $conn->prepare($query);
    $stmt->execute($productData);

    return ($stmt->rowCount() > 0);

}
//Function registrasi
function registrasi($data) {
    global $conn;

    $email = strtolower(stripslashes($data['email']));
    $nama = mysqli_real_escape_string($conn, $data['nama']);
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    $stmt = $conn->prepare("SELECT email FROM user WHERE email = :email");
    $stmt->execute([':email' = $email]);
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        echo "<script>
        alert('email sudah terdaftar');    
        </script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>
        alert('Kata sandi tidak sesuai')
        </script>
        ";
        return false;
    }
    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user (nama, email, password) VALUES('$nama', '$email', '$password')");

    return mysqli_affected_rows($conn);
}
?>