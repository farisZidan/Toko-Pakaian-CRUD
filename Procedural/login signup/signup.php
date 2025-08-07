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
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: 'Poppins', sans-serif;
      }
    </style>
  </head>
  <body class="bg-slate-100 flex justify-center items-center h-screen">
    <div class="bg-white p-10 rounded-2xl shadow-xl max-w-[400px] w-full">
      <h2 class="text-center text-2xl font-bold mb-6 text-[#030504fe]">Sign Up</h2>
      <form id="signupForm" method='post'>
        <label for="name" class="text-sm font-medium mb-2 block text-gray-600">Nama Lengkap</label>
        <input type="text" id="name" name="nama" required class="w-full py-3 px-4 mb-5 border border-gray-300 rounded-[10px] text-sm bg-gray-50 transition-all duration-300 ease-in-out focus:border-black focus:bg-white focus:outline-none" />

        <label for="email" class="text-sm font-medium mb-2 block text-gray-600">Email</label>
        <input type="email" id="email" name="email" required class="w-full py-3 px-4 mb-5 border border-gray-300 rounded-[10px] text-sm bg-gray-50 transition-all duration-300 ease-in-out focus:border-black focus:bg-white focus:outline-none" />

        <label for="password" class="text-sm font-medium mb-2 block text-gray-600">Kata Sandi</label>
        <input type="password" id="password" name="password" required class="w-full py-3 px-4 mb-5 border border-gray-300 rounded-[10px] text-sm bg-gray-50 transition-all duration-300 ease-in-out focus:border-black focus:bg-white focus:outline-none" />
        <label for="password2" class="text-sm font-medium mb-2 block text-gray-600">Verifikasi Kata Sandi</label>
        <input type="password" id="password2" name="password2" required class="w-full py-3 px-4 mb-5 border border-gray-300 rounded-[10px] text-sm bg-gray-50 transition-all duration-300 ease-in-out focus:border-black focus:bg-white focus:outline-none" />
        
        <button type="submit" name='register' class="w-full p-[15px] bg-[#030504fe] text-white text-base font-semibold border-none rounded-[10px] cursor-pointer transition-colors duration-300 hover:bg-[#48312b]">Daftar</button>
      </form>
      <div class="text-center mt-4 text-sm">
        Sudah punya akun? <a href="login.php" class="text-[#030504fe] no-underline font-semibold hover:underline">Masuk di sini</a>
      </div>
    </div>
  </body>
</html>
