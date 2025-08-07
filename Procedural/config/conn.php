<?php
$host = "localhost";
$dbname = "rbgallerydatabase";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
if (!$conn) {
    die("Connection failed: " . $conn->errorInfo());
}
?>