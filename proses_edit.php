<?php
include 'Config.php';
if (!isset($_SESSION['login'])) { header("Location: Login.php"); exit; }

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    $query = "UPDATE barang SET nama='$nama', keterangan='$keterangan' WHERE id=$id";
    if (mysqli_query($koneksi, $query)) {
        header("Location: Beranda.php");
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($koneksi);
    }
}
?>