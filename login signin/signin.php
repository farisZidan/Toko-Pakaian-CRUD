<?php
require '../config/functions.php';

if (isset($_POST['register'])) {
  if (registrasi($_POST) > 0) {
    echo '
    <script>
        alert("Berhasil");
    </script>
    ';
    header("Location: login.php");
  } else {
    echo mysqli_error($conn);
  }
}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In - RB Gallery</title>
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
    </style>
  </head>
  <body>
    <div class="form-container">
      <h2>Sign In</h2>
      <form id="signupForm" method='post'>
        <label for="name">Nama Lengkap</label>
        <input type="text" id="name" name="nama" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password" required />
        <label for="password2">Verifikasi Kata Sandi</label>
        <input type="password" id="password2" name="password2" required />
        
        <button type="submit" name='register'>Daftar</button>
      </form>
      <div class="switch">
        Sudah punya akun? <a href="login.php">Masuk di sini</a>
      </div>
    </div>
  </body>
</html>
