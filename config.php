<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_crud"; // Nama database sesuai dump users.sql kamu

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database ke db_crud gagal: " . mysqli_connect_error());
}
?>