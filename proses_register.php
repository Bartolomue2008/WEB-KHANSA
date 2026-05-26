<?php
include 'Config.php';

if (isset($_POST['register'])) {
    // Jika di form menggunakan input name="username", tangkap dengan $_POST['username']
    $username       = mysqli_real_escape_string($koneksi, $_POST['username']); 
    $password       = mysqli_real_escape_string($koneksi, $_POST['password']);
    $email          = mysqli_real_escape_string($koneksi, $_POST['email']);
    $nama_lengkap   = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $kelas          = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $gender         = mysqli_real_escape_string($koneksi, $_POST['gender']);
    $role           = mysqli_real_escape_string($koneksi, $_POST['role']);
    
    // Ubah enkripsi di sini menjadi MD5 agar sama dengan proses login
    $password_md5 = md5($password);

    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>alert('Username sudah terdaftar!'); window.location='Registrasi.php';</script>";
    } else {
        // Query insert menggunakan variabel $password_md5
        $query = "INSERT INTO users (username, email, password, nama_lengkap, kelas, gender, role) 
                  VALUES ('$username', '$email', '$password_md5', '$nama_lengkap', '$kelas', '$gender', '$role')";
                  
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='Login.php';</script>";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}
?>