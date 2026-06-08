<?php
session_start();
include 'Config.php';
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    if (mysqli_query($koneksi, "DELETE FROM prestasi WHERE id='$id'")) {
        header("Location: beranda.php");
        exit;
    }
}
?>