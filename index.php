<?php
// Memulai session untuk mengecek status login
session_start();

// Jika session login sudah ada dan tidak kosong, langsung bawa ke beranda
if (isset($_SESSION['login']) && isset($_SESSION['user'])) {
    header("Location: beranda.php");
    exit();
} else {
    // Jika belum login, otomatis lempar ke halaman login awal
    header("Location: login.php");
    exit();
}
?>