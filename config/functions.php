<?php 
// koneksi database
$conn = mysqli_connect("localhost", "root", "", "rbgallerydatabase");


// Function Select
function select($query) {
    $barangDB = mysqli_query($GLOBALS['conn'], $query);
    $rows = [];
    while ($barang = mysqli_fetch_assoc($barangDB)) {
    $rows[] = $barang;
    }
return $rows;
}


// Function Insert
function insert($data) {
    global $conn;

    $nama = htmlspecialchars($data["Nama"]);
    $stok = htmlspecialchars($data["Stok"]);
    $harga = htmlspecialchars($data["Harga"]);
    $deskripsi = htmlspecialchars($data["Deskripsi"]);

    //upload gambar
    $gambar = upload();
    if(!$gambar) {
        return false;
    }

    $query = "INSERT INTO barang
            VALUES
            ('', '$nama', '$stok', '$gambar', '$harga', '$deskripsi')";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function upload() {
    $namaFile = htmlspecialchars($_FILES['Gambar']['name']);
    $ukuranFile = htmlspecialchars($_FILES['Gambar']['size']);
    $error = htmlspecialchars($_FILES['Gambar']['error']);
    $tmpName = htmlspecialchars($_FILES['Gambar']['tmp_name']);

    if($error === 4) {
        echo "<script>
        alert('Masukan gambar !');
        document.location.href = 'tambahProduk.php';
        </script>";
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Masukan gambar dengan format : jpg, jpeg ,png !');
        </script>";
    }

    if ($ukuranFile > 5000000) {
        echo "<script>
        alert('Ukuran gambar terlalu besar !');
        </script>";
    }
    
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

    return $namaFileBaru;
}

// Function Hapus
function hapus($kode) {
    global $conn;
    mysqli_query($conn, "DELETE FROM barang WHERE Kode = $kode");

    return mysqli_affected_rows($conn);
}

// Function Update
function update($data) {
    global $conn;
    $kode = $data["Kode"];
    $gambarLama = $data["gambarLama"];
    $gambar = $data["Gambar"];
    $nama = $data["Nama"];
    $stok = $data["Stok"];
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
                          Stok = ' $stok', 
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

// Function cetak pdf
function cetak() {
    require 'library/fpdf.php';

    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->Addpage();
    $pdf->SetFont('Times','B','12');
    $pdf->Cell(10,10,'No',1,0,'C');
    $pdf->Cell(30,10,'Kode',1,0,'C');
    $pdf->Cell(80,10,'Nama Produk',1,0,'C');
    $pdf->Cell(30,10,'Stok',1,0,'C');
    $pdf->Cell(40,10,'Harga',1,1,'C');


    $data = select("SELECT * FROM barang");
    $no = 1;
    $pdf->SetFont('Times','','11');

    
    foreach($data as $row) {
        $pdf->Cell(10,8,$no++,1,0,'C');
        $pdf->Cell(30,8,$row['Kode'],1,0);
        $pdf->Cell(80,8,$row['Nama'],1,0);
        $pdf->Cell(30,8,$row['Stok'],1,0,'C');
        $pdf->Cell(40,8,'Rp. '.number_format($row['Harga'],0,',','.'),1,1,'R');
    }

    $pdf->Output('D','Laporan_Stok_Produk_'.date('Ymd').'.pdf');
}
?>