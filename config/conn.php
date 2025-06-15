<?php
$conn = mysqli_connect("localhost", "root", "", "rbgallerydatabase");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>