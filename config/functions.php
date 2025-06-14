<?php 
// koneksi database
$conn = mysqli_connect("localhost", "root", "", "rbgallerydatabase");
// Function Select
function select($query) {
    $barang = mysqli_query($GLOBALS['conn'], $query);
    $rows = [];
    while ($data = mysqli_fetch_assoc($barang)) {
    $rows[] = $data;
    }
return $rows;
}
// Function Insert
function insert($data) {
    global $conn;

    $nama = htmlspecialchars($data["Nama"]);
    $ukuranS = htmlspecialchars($data["Ukuran_S"]);
    $ukuranM = htmlspecialchars($data["Ukuran_M"]);
    $ukuranL = htmlspecialchars($data["Ukuran_L"]);
    $ukuranXL = htmlspecialchars($data["Ukuran_XL"]);
    $harga = htmlspecialchars($data["Harga"]);
    $deskripsi = htmlspecialchars($data["Deskripsi"]);

    //upload gambar
    $gambar = upload();
    if(!$gambar) {
        
        return false;
    }

    $query = "INSERT INTO barang
            VALUES
            ('', '$nama', '$ukuranS', '$ukuranM', '$ukuranL', '$ukuranXL',
             '$gambar', '$harga', '$deskripsi')";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function upload() {
    $namaFile = htmlspecialchars($_FILES['Gambar']['name']);
    $ukuranFile = htmlspecialchars($_FILES['Gambar']['size']);
    $error = htmlspecialchars($_FILES['Gambar']['error']);
    $tmpName = htmlspecialchars($_FILES['Gambar']['tmp_name']);

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Masukan gambar dengan format : jpg, jpeg ,png !');
        document.location.href = 'tambahProduk.php';
        </script>";
        exit;
    }

    if ($ukuranFile > 5000000) {
        echo "<script>
        alert('Ukuran gambar terlalu besar !');
        document.location.href = 'tambahProduk.php';
        </script>";
        exit;
    }
    
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

    return $namaFileBaru;
}
// Function Hapus
function hapus($kode, $gambar) {
    global $conn;
    mysqli_query($conn, "DELETE FROM barang WHERE Kode = $kode");
    deleteFile($gambar);
    return mysqli_affected_rows($conn);
}
// Function Hapus Image
function deleteFile($path) {
    if (!str_starts_with($path, '../img/')) {
        error_log("delete failed: invalid path");
        echo "<script>
        alert('Path tidak valid!');
        </script>";
        return false;
    }
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if (in_array($ext, $allowedExtensions) && file_exists($path)) {
        return unlink($path);
        error_log("delete result: " . ($result ? "success" : "failed"));
        return $result;
    } else {
        error_log("delete failed: file does not exist or invalid extension");
    }
    return false;
}
// Function Update
function update($data) {
    global $conn;
    $kode = $data["Kode"];
    $gambarLama = $data["gambarLama"];
    $gambar = $data["Gambar"];
    $nama = $data["Nama"];
    $ukuranS = $data["Ukuran_S"];
    $ukuranM = $data["Ukuran_M"];
    $ukuranL = $data["Ukuran_L"];
    $ukuranXL = $data["Ukuran_XL"];
    $harga = $data["Harga"];
    $deskripsi = $data["Deskripsi"];

    if ($_FILES['Gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    
    $query = "UPDATE barang SET 
                          Gambar = '$gambar', 
                          Nama = ' $nama', 
                          Ukuran_S = '$ukuranS',
                          Ukuran_M = '$ukuranM',
                          Ukuran_L = '$ukuranL',
                          Ukuran_XL = '$ukuranXL',
                          Harga = '$harga', 
                          Deskripsi = '$deskripsi' 
                          WHERE Kode = '$kode'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}
//Function registrasi
function registrasi($data) {
    global $conn;

    $email = strtolower(stripslashes($data['email']));
    $nama = mysqli_real_escape_string($conn, $data['nama']);
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

    if(mysqli_fetch_assoc($result)) {
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