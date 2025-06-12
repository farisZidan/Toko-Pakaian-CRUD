<?php
session_start();
require '../config/functions.php';

if(isset($_POST["masuk"])) {

  $email = $_POST["email"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' ");

  if (mysqli_num_rows($result) === 1 ) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {
      if($row['role'] === 'admin') {
        $_SESSION["login"] = true;
        header("Location: ../admin/admin.php");
        exit;
      }
      header("Location: ../index.html");
      exit;
     }
    } 
    echo" <script>
    alert('email atau kata sandi salah')
    </script>
    ";
}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - RB Gallery</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />
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
      input {
        width: 100%;
        padding: 12px 16px;
        margin-bottom: 20px;
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
      }
      button:hover {
        background-color: #48312b;
      }
      .switch {
        text-align: center;
        margin-top: 15px;
      }
      .switch a {
        color: #030504fe;
        text-decoration: none;
        font-weight: 600;
      }
      .switch a:hover {
        text-decoration: underline;
      }
      .modal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
      }
      .modal-content {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      }
      .modal-content button {
        margin-top: 15px;
        background-color: #030504fe;
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

        <button type="submit" name='masuk'>Masuk</button>
      </form>
      <div class="switch">
        Belum punya akun? <a href="signin.php">Daftar di sini</a>
      </div>
    </div>

    <div class="modal" id="loginSuccessModal">
      <div class="modal-content">
        <h3>Login Berhasil!</h3>
        <p>Selamat datang kembali di RB Gallery 🌟</p>
        <button onclick="closeLoginModal()">Tutup</button>
      </div>
    </div>
  </body>
</html>
