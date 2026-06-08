<?php
session_start();
include 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $pass     = $_POST['password'];

    $username_aman = mysqli_real_escape_string($koneksi, $username);
    $pass_hash = md5($pass);

    $data = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username_aman' AND password='$pass_hash'");

    if (mysqli_num_rows($data) > 0) {
        $d = mysqli_fetch_array($data);
        
        $_SESSION['login'] = true;
        $_SESSION['user']  = $d['username']; 
        
        header("Location: beranda.php");
        exit;
    } else {
        echo "<script>alert('Username atau password salah!'); window.location='login.php';</script>";
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>