<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();
setcookie('nama', $row['nama'], time()-600, "/");
setcookie('email', $row['email'], time()-600, "/");
header("Location: ../index.html");
exit;
?>