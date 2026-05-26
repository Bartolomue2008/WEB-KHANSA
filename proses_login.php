<?php
include 'Config.php'; // Config.php sudah otomatis menjalankan session_start() dan include koneksi

$username = $_POST['username'];
$pass     = $_POST['password'];

// Format enkripsi MD5 sesuai keinginanmu
$pass_hash = md5($pass);

$username_aman = mysqli_real_escape_string($koneksi, $username);
$data = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username_aman' AND password='$pass_hash'");

$d = mysqli_fetch_array($data);

if ($d) {
    $_SESSION['login']    = true; // Tambahkan ini agar lolos pengecekan halaman beranda
    $_SESSION['id']       = $d['id'];
    $_SESSION['username'] = $d['username'];
    $_SESSION['role']     = $d['role'];
    
    header("location:Beranda.php"); // Diarahkan ke Beranda.php sesuai file yang kamu miliki
    exit;
} else {
    echo "<script>alert('Username atau password salah!'); window.history.back();</script>";
}
?>