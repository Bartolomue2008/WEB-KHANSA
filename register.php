<?php
session_start();
include 'config.php';

$pesan = "";

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $konfirmasi_password = mysqli_real_escape_string($koneksi, $_POST['konfirmasi_password']);

    if (empty($username) || empty($password) || empty($konfirmasi_password)) {
        $pesan = "<div style='color: #d32f2f; background: #ffebee; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-size: 14px;'>Semua data wajib diisi!</div>";
    } else {
        // Cek apakah username sudah pernah terdaftar atau belum
        $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
        
        if (mysqli_num_rows($cek_user) > 0) {
            $pesan = "<div style='color: #d32f2f; background: #ffebee; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-size: 14px;'>Username sudah digunakan!</div>";
        } else {
            if ($password !== $konfirmasi_password) {
                $pesan = "<div style='color: #d32f2f; background: #ffebee; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-size: 14px;'>Konfirmasi password tidak cocok!</div>";
            } else {
                // Enkripsi password ke MD5 agar sinkron dengan proses_login.php
                $password_fix = md5($password);
                
                // Masukkan data user baru ke database
                $query = mysqli_query($koneksi, "INSERT INTO users (username, password) VALUES ('$username', '$password_fix')");
                
                if ($query) {
                    // JALAN KELUAR: Setelah sukses, langsung oper ke login.php, tidak langsung masuk ke web
                    echo "<script>
                            alert('Akun berhasil didaftarkan! Silakan login menggunakan akun baru Anda.');
                            window.location='login.php';
                          </script>";
                    exit;
                } else {
                    $pesan = "<div style='color: #d32f2f; background: #ffebee; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-size: 14px;'>Gagal mendaftar: " . mysqli_error($koneksi) . "</div>";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - SMKN 2 Baleendah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #1b5e20; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .register-card { background: rgba(255, 255, 255, 0.95); padding: 40px; border-radius: 20px; width: 100%; max-width: 400px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border-top: 5px solid #2e7d32; text-align: center; }
        h2 { color: #1b5e20; font-size: 24px; margin-bottom: 8px; font-weight: 600; }
        p { color: #666; font-size: 14px; margin-bottom: 24px; }
        .form-group { text-align: left; margin-bottom: 18px; }
        label { display: block; font-size: 13px; color: #1b5e20; font-weight: 600; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #ccc; outline: none; font-size: 14px; transition: 0.3s; }
        .form-control:focus { border-color: #2e7d32; box-shadow: 0 0 8px rgba(46,125,50,0.2); }
        .btn { width: 100%; padding: 14px; border: none; border-radius: 999px; background: #2e7d32; color: white; font-size: 14px; font-weight: 600; cursor: pointer; transition: 0.3s; margin-top: 10px; }
        .btn:hover { background: #1b5e20; transform: translateY(-2px); }
        .login-link { margin-top: 20px; font-size: 13px; color: #555; }
        .login-link a { color: #2e7d32; text-decoration: none; font-weight: 600; }
        .login-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="register-card">
    <h2>Daftar Akun</h2>
    <p>Buat akun baru untuk Sistem Kuliner</p>
    
    <?php echo $pesan; ?>
    
    <form action="" method="POST">
        <div class="form-group">
            <label>Username Baru</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan username baru" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="konfirmasi_password" class="form-control" placeholder="Ulangi password" required>
        </div>
        <button type="submit" name="register" class="btn">Daftar Akun Baru</button>
    </form>
    
    <div class="login-link">
        Sudah punya akun? <a href="login.php">Login di sini</a>
    </div>
</div>

</body>
</html>