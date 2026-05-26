<?php
include 'Config.php';
if (!isset($_SESSION['login'])) { header("Location: Login.php"); exit; }

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM barang WHERE id=$id";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: Beranda.php");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: Beranda.php");
}
?>