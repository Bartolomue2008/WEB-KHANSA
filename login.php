<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Sistem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96 border-t-4 border-green-400">
        <h2 class="text-2xl font-bold text-center text-green-700 mb-6">Masuk ke Website</h2>
        <form action="Proses_login.php" method="POST" class="space-y-4">
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-1">Username</label>
                <input type="text" name="username" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300">
            </div>
            <button type="submit" name="login" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded-md transition duration-200">Login</button>
        </form>
        <p class="text-sm text-center text-gray-600 mt-4">Belum punya akun? <a href="Registrasi.php" class="text-green-600 hover:underline">Daftar sekarang</a></p>
    </div>
</body>
</html>