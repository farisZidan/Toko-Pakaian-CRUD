<?php
session_start();
require '../config/conn.php';

if(isset($_POST["masuk"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' ");
    
    if(mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
    if(password_verify($password, $row["password"])) {
        if($row['role'] == 'admin') {
            $_SESSION['role'] = 'admin';
            $_SESSION['login'] = true;
            header("Location: ../admin/admin.php");
            exit;
            } 
        elseif($row['role'] == 'user') {
        // Atur cookie
        $cookieOptions = [
        'expires' => isset($_POST['rememberMe']) ? time()+86400*30 : 0,
        'path' => '/',
        ];
                
        setcookie('User', $row['nama'], $cookieOptions);
        setcookie('email', $row['email'], $cookieOptions);
                
        header("Location: ../index.html");
        exit;
        }
        }
    }
    
    // Jika autentikasi gagal
    echo "<script>
    alert('Email atau kata sandi salah!');
    document.location.href = 'login.php';
    </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - RB Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-100 flex justify-center items-center h-screen">
    <div class="bg-white p-10 rounded-2xl shadow-xl max-w-[400px] w-full">
        <h2 class="text-center text-2xl font-bold mb-6 text-[#030504fe]">Login</h2>
        <form id="loginForm" method="post">
            <label for="email" class="text-sm font-medium mb-2 block text-gray-600">Email</label>
            <input type="email" id="email" name="email" required class="w-full py-3 px-4 mb-[15px] border border-gray-300 rounded-[10px] text-sm bg-gray-50 transition-all duration-300 ease-in-out focus:border-black focus:bg-white focus:outline-none" />

            <label for="password" class="text-sm font-medium mb-2 block text-gray-600">Kata Sandi</label>
            <input type="password" id="password" name="password" required class="w-full py-3 px-4 mb-[15px] border border-gray-300 rounded-[10px] text-sm bg-gray-50 transition-all duration-300 ease-in-out focus:border-black focus:bg-white focus:outline-none" />
            
            <div class="flex items-center mt-[5px] mb-[15px]">
                <input type="checkbox" id="rememberMe" name="rememberMe" class="w-auto mr-2 scale-110" />
                <label for="rememberMe" class="m-0 text-sm cursor-pointer select-none text-gray-600">Remember Me</label>
            </div>

            <button type="submit" name='masuk' class="w-full p-[15px] bg-[#030504fe] text-white text-base font-semibold border-none rounded-[10px] cursor-pointer transition-colors duration-300 mt-[10px] hover:bg-[#48312b]">Masuk</button>
        </form>
        <div class="text-center mt-5 text-sm">
            Belum punya akun? <a href="signin.php" class="text-[#030504fe] no-underline font-semibold hover:underline">Daftar di sini</a>
        </div>
    </div>
</body>
</html>