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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #030504fe;
        }
        label {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
            color: #4b5563;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            margin-bottom: 15px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            background-color: #f9fafb;
            transition: all 0.3s ease;
        }
        input:focus {
            border-color: #030504fe;
            background-color: #fff;
            outline: none;
        }
        button {
            width: 100%;
            padding: 15px;
            background-color: #030504fe;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        button:hover {
            background-color: #48312b;
        }
        .switch {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        .switch a {
            color: #030504fe;
            text-decoration: none;
            font-weight: 600;
        }
        .switch a:hover {
            text-decoration: underline;
        }
        .remember-me {
            display: flex;
            align-items: center;
            margin: 5px 0 15px 0;
        }
        .remember-me input[type="checkbox"] {
            width: auto;
            margin-right: 8px;
            transform: scale(1.1);
        }
        .remember-me label {
            margin: 0;
            font-size: 14px;
            cursor: pointer;
            user-select: none;
            color: #4b5563;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <form id="loginForm" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required />

            <label for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" required />
            
            <div class="remember-me">
                <input type="checkbox" id="rememberMe" name="rememberMe" />
                <label for="rememberMe">Remember Me</label>
            </div>

            <button type="submit" name='masuk'>Masuk</button>
        </form>
        <div class="switch">
            Belum punya akun? <a href="signin.php">Daftar di sini</a>
        </div>
    </div>
</body>
</html>