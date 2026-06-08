<?php
$host = "localhost";
$user = "2526_12";
$pass = "12345678";
$db   = "2526_12db"; // Nama database server kamu

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>