<?php
session_start();
$_SESSION['login'] = false;
$_SESSION['role'] = '';
$_SESSION['nama'] = '';
$_SESSION = [];
session_unset();
session_destroy();
setcookie('nama', '',time()-86400 * 30, "/");
setcookie('email', '', time()-86400 * 30, "/");
header("Location: ../index.html");
exit;