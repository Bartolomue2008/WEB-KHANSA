<?php
include 'config.php';

if (isset($_POST['register'])) {
    $username       = mysqli_real_escape_string($koneksi, $_POST['username']); 
    $password       = mysqli_real_escape_string($koneksi, $_POST['password']);
    $email          = mysqli_real_escape_string($koneksi, $_POST['email'] ?? '');
    $nama_lengkap   = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap'] ?? '');
    $kelas          = mysqli_real_escape_string($koneksi, $_POST['kelas'] ?? '');
    $gender         = mysqli_real_escape_string($koneksi, $_POST['gender'] ?? '');
    $role           = mysqli_real_escape_string($koneksi, $_POST['role'] ?? 'user');
    
    $password_md5 = md5($password);

    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>alert('Username sudah terdaftar!'); window.location='register.php';</script>";
        exit;
    } else {
        $query = "INSERT INTO users (username, email, password, nama_lengkap, kelas, gender, role) 
                  VALUES ('$username', '$email', '$password_md5', '$nama_lengkap', '$kelas', '$gender', '$role')";
                  
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Registrasi Berhasil!'); window.location='login.php';</script>";
            exit;
        } else {
            echo "Gagal: " . mysqli_error($koneksi);
        }
    }
}
?>