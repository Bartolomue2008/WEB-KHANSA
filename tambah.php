<?php
session_start();
include 'config.php';

if (!isset($_SESSION['login'])) { 
    header("Location: login.php"); 
    exit; 
}

if (isset($_POST['submit_tambah'])) {
    $nip        = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $nama       = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas      = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $wali_kelas = mysqli_real_escape_string($koneksi, $_POST['wali_kelas'] ?? '');
    $jabatan    = mysqli_real_escape_string($koneksi, $_POST['jabatan']);

    $query = "INSERT INTO prestasi (nip, nama, kelas, wali_kelas, jabatan) VALUES ('$nip', '$nama', '$kelas', '$wali_kelas', '$jabatan')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data pengurus berhasil ditambahkan!');
                window.location='beranda.php';
              </script>";
        exit;
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }
}
?>