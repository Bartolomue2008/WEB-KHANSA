<?php
$host = "localhost";
$user = "root"; // Sesuaikan dengan user hosting kamu jika di-online-kan
$pass = "";     // Sesuaikan dengan password hosting kamu jika di-online-kan
$db   = "2526_12db"; 

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database ke db_crud gagal: " . mysqli_connect_error());
}
?>