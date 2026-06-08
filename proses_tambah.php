<?php
// Memulai session agar status login terbaca
session_start();
include 'Config.php';

// Pastikan yang mengakses sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form input beranda (Menggunakan NIP)
    $nip        = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $nama       = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas      = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $wali_kelas = mysqli_real_escape_string($koneksi, $_POST['wali_kelas'] ?? '');
    $jabatan    = mysqli_real_escape_string($koneksi, $_POST['jabatan']);

    // QUERY FINAL: Memasukkan data menggunakan kolom NIP sesuai database kamu
    $query = mysqli_query($koneksi, "INSERT INTO prestasi (nip, nama, kelas, wali_kelas, jabatan) VALUES ('$nip', '$nama', '$kelas', '$wali_kelas', '$jabatan')");

    if ($query) {
        echo "
        <script>
            alert('Data pengurus berhasil ditambah');
            window.location='beranda.php';
        </script>
        ";
        exit;
    } else {
        // Jika gagal, tampilkan error aslinya agar ketahuan masalahnya
        echo "Gagal menambah data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: beranda.php");
    exit;
}
?>