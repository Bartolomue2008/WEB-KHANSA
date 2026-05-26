<?php
include 'Config.php';
if (!isset($_SESSION['login'])) { header("Location: Login.php"); exit; }

if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    $query = "INSERT INTO barang (nama, keterangan) VALUES ('$nama', '$keterangan')";
    if (mysqli_query($koneksi, $query)) {
        header("Location: Beranda.php");
    } else {
        echo "Gagal tambah data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96 border-t-4 border-green-400">
        <h2 class="text-2xl font-bold text-green-700 mb-6">Tambah Data Baru</h2>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-1">Nama Item</label>
                <input type="text" name="nama" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-1">Keterangan</label>
                <textarea name="keterangan" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300"></textarea>
            </div>
            <div class="flex space-x-2">
                <button type="submit" name="tambah" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded-md transition">Simpan</button>
                <a href="Beranda.php" class="w-full bg-gray-300 hover:bg-gray-400 text-gray-700 text-center font-bold py-2 rounded-md transition flex items-center justify-center">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>