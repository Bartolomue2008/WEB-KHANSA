<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'config.php';

if (!isset($_SESSION['login'])) { 
    header("Location: login.php"); 
    exit; 
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    // Mengubah data barang sesuai target form edit kamu
    $query = "UPDATE barang SET nama='$nama', keterangan='$keterangan' WHERE id=$id";
    if (mysqli_query($koneksi, $query)) {
        header("Location: beranda.php");
        exit;
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($koneksi);
    }
}
?>