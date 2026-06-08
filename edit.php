<?php
// Nyalakan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// WAJIB jalankan session_start() agar status login terbaca
session_start();

include 'config.php';

if (!isset($_SESSION['login'])) { 
    header("Location: login.php"); 
    exit; 
}

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM barang WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if (!$data) { 
    header("Location: beranda.php"); 
    exit; 
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96 border-t-4 border-green-400">
        <h2 class="text-2xl font-bold text-green-700 mb-6">Edit Data</h2>
        
        <form action="proses_edit.php" method="POST" class="space-y-4">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-1">Nama Item</label>
                <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-1">Keterangan</label>
                <textarea name="keterangan" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300"><?php echo $data['keterangan']; ?></textarea>
            </div>
            <div class="flex space-x-2">
                <button type="submit" name="update" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded-md transition">Update</button>
                <a href="beranda.php" class="w-full bg-gray-300 hover:bg-gray-400 text-gray-700 text-center font-bold py-2 rounded-md transition flex items-center justify-center">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>