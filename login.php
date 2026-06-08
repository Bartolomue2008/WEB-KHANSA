<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMKN 2 Baleendah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #1b5e20; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .login-card { background: rgba(255, 255, 255, 0.95); padding: 40px; border-radius: 20px; width: 100%; max-width: 400px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border-top: 5px solid #2e7d32; text-align: center; }
        h2 { color: #1b5e20; font-size: 24px; font-weight: 600; margin-bottom: 8px; }
        p { color: #666; font-size: 14px; margin-bottom: 24px; }
        .form-group { text-align: left; margin-bottom: 20px; }
        label { display: block; font-size: 13px; font-weight: 600; color: #333; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #ccc; outline: none; font-size: 14px; transition: 0.3s; }
        .form-control:focus { border-color: #2e7d32; box-shadow: 0 0 8px rgba(46,125,50,0.2); }
        .btn { width: 100%; padding: 14px; border: none; border-radius: 999px; background: #2e7d32; color: white; font-size: 14px; font-weight: 600; cursor: pointer; transition: 0.3s; margin-top: 10px; }
        .btn:hover { background: #1b5e20; transform: translateY(-2px); }
        .register-link { margin-top: 20px; font-size: 13px; color: #555; }
        .register-link a { color: #2e7d32; text-decoration: none; font-weight: 600; }
        .register-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="login-card">
    <h2>SMKN 2 Baleendah</h2>
    <p>Masuk ke Sistem Data Pengurus Kuliner</p>
    
    <form action="proses_login.php" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn">Masuk Sistem</button>
    </form>
    
    <div class="register-link">
        Belum memiliki akun? <a href="register.php">Daftar Akun Baru</a>
    </div>
</div>

</body>
</html>