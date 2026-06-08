<?php
session_start();
include 'Config.php';

// Proteksi halaman: Jika belum login, kembalikan ke login.php
if (!isset($_SESSION['login'])) { 
    header("Location: login.php"); 
    exit; 
}

if (isset($_POST['submit_tambah'])) {
    // 1. Ambil data murni menggunakan NIP dari form input beranda
    $nip        = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $nama       = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas      = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $wali_kelas = mysqli_real_escape_string($koneksi, $_POST['wali_kelas']);
    $jabatan    = mysqli_real_escape_string($koneksi, $_POST['jabatan']);

    // 2. SOLUSI PASTI: Memasukkan ke kolom database murni menggunakan (nip, nama, kelas, wali_kelas, jabatan)
    // Kata 'nis' di baris ini sudah dihapus total agar tidak memicu error database lagi
    $query = "INSERT INTO prestasi (nip, nama, kelas, wali_kelas, jabatan) VALUES ('$nip', '$nama', '$kelas', '$wali_kelas', '$jabatan')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data pengurus berhasil ditambahkan!');
                window.location='beranda.php';
              </script>";
        exit;
    } else {
        echo "Gagal menambah data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: beranda.php");
    exit;
}
?>