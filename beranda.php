<?php
// Memulai session untuk mendeteksi status login
session_start();

// Mengambil file konfigurasi database
include 'Config.php';

// Proteksi halaman: Jika belum login atau session user kosong, tendang balik ke form login
if (!isset($_SESSION['login']) || !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

// ... kode kamu selanjutnya di bawah sini ...

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMKN 2 Baleendah - Kuliner</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
    body { background: #1b5e20; color: #f1f8e9; line-height: 1.6; scroll-behavior: smooth; }
    a { text-decoration: none; color: inherit; }
    header { background: rgba(46, 125, 50, 0.85); backdrop-filter: blur(10px); padding: 20px 60px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
    header h1 { font-size: 22px; font-weight: 600; color: #ffffff; }
    .header-right { display: flex; align-items: center; gap: 25px; }
    nav a { margin-left: 28px; font-size: 14px; color: #f1f8e9; transition: 0.3s; }
    nav a:hover { color: #ffffff; text-shadow: 0 0 8px rgba(255,255,255,0.5); }
    .profile { position: relative; }
    .profile-circle { width: 42px; height: 42px; border-radius: 50%; background: #ffffff; color: #1b5e20; display: flex; justify-content: center; align-items: center; cursor: pointer; font-size: 18px; transition: 0.3s; }
    .profile-circle:hover { background: #c8e6c9; }
    .profile-menu { position: absolute; top: 55px; right: 0; background: #ffffff; padding: 16px; border-radius: 16px; width: 220px; display: none; flex-direction: column; gap: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); border: 1px solid #e0e0e0; }
    .profile-menu.active { display: flex; }
    .profile-menu p { font-size: 13px; color: #1b5e20; word-break: break-word; }
    .logout-btn { padding: 10px 16px; border: none; border-radius: 999px; background: #d32f2f; color: white; cursor: pointer; transition: 0.3s; font-weight: 600; }
    .logout-btn:hover { background: #b71c1c; }
    .hero { min-height: 85vh; padding: 0 60px; display: flex; flex-direction: column; justify-content: center; background: linear-gradient(rgba(255, 255, 255, 0.75), rgba(27, 94, 32, 0.9)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836'); background-size: cover; background-position: center; }
    .hero h2 { font-size: 52px; font-weight: 600; margin-bottom: 12px; color: #1b5e20; }
    .hero p { max-width: 600px; font-size: 16px; color: #ffffff; margin-bottom: 36px; }
    .btn { width: fit-content; padding: 14px 32px; border-radius: 999px; background: #2e7d32; color: white; font-size: 14px; transition: 0.3s; font-weight: 600; border: none; cursor: pointer; display: inline-block; text-align: center; }
    .btn:hover { background: #43a047; transform: translateY(-2px); }
    section { padding: 80px 60px; }
    .section-title { font-size: 32px; margin-bottom: 24px; color: #ffffff; }
    .section-desc { max-width: 700px; color: #c8e6c9; margin-bottom: 48px; }
    .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 24px; }
    .card { background: rgba(46, 125, 50, 0.4); padding: 24px; border-radius: 16px; transition: 0.3s; border: 1px solid rgba(255, 255, 255, 0.1); }
    .card:hover { transform: translateY(-6px); background: rgba(46, 125, 50, 0.6); border-color: rgba(255, 255, 255, 0.3); }
    .card h3 { margin-bottom: 12px; color: #ffffff; }
    .card p { font-size: 14px; color: #e8f5e9; }
    .table-container { width: 100%; overflow-x: auto; background: rgba(46, 125, 50, 0.5); padding: 24px; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
    .custom-table { width: 100%; border-collapse: collapse; text-align: left; }
    .custom-table th { background: #ffffff; color: #1b5e20; padding: 16px; font-weight: 600; font-size: 14px; border-bottom: 2px solid rgba(255, 255, 255, 0.2); }
    .custom-table td { padding: 16px; font-size: 14px; color: #ffffff; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
    .custom-table tr:hover { background: rgba(255, 255, 255, 0.1); }
    .badge-login { background: #ffffff; color: #1b5e20; padding: 6px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; display: inline-block; margin-bottom: 20px; border: 1px solid rgba(255, 255, 255, 0.2); }
    .btn-hapus { background: #e53935; color: white; padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 600; border: none; cursor: pointer; transition: 0.2s; text-align: center; display: inline-block; }
    .btn-hapus:hover { background: #b71c1c; }
    .form-control-custom { width: 100%; padding: 12px; margin-bottom: 12px; border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.2); outline: none; background: rgba(255, 255, 255, 0.9); color: #1b5e20; transition: 0.3s; font-weight: 500; }
    .form-control-custom:focus { border-color: #ffffff; background: #ffffff; box-shadow: 0 0 10px rgba(255,255,255,0.2); }
    footer { text-align: center; padding: 32px; font-size: 13px; color: #c8e6c9; background: #123e14; border-top: 1px solid rgba(255, 255, 255, 0.05); }
    @media(max-width:768px){ header, section, .hero { padding: 20px 24px; } .hero h2 { font-size: 36px; } nav a { margin-left: 12px; font-size: 12px; } .header-right { gap: 12px; } }
  </style>
</head>
<body>

<header>
  <h1>SMKN 2 Baleendah</h1>
  <div class="header-right">
    <nav>
      <a href="#home">Home</a>
      <a href="#profil">Profil</a>
      <a href="#visi-misi">Visi & Misi</a>
      <a href="#dokumentasi">Dokumentasi</a>
      <a href="#dashboard">Dashboard</a>
      <a href="#contact">Contact</a>
    </nav>
    
    <div class="profile">
      <div class="profile-circle" onclick="toggleMenu()">👤</div>
      <div class="profile-menu" id="profile-menu">
        <p style="font-size: 13px; margin-bottom: 5px;">
          User: <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong>
        </p>
        <a href="logout.php">
          <button class="logout-btn" style="width: 100%;">Logout</button>
        </a>
      </div>
    </div>
  </div>
</header>

<div id="home" class="hero">
  <h2>KULINER</h2>
  <p>Jurusan dengan peminat yang banyak setelah TJKT dengan jumlah kelas 16 kelas. Membentuk siswa ahli di bidang tata boga dan siap bersaing di industri kreatif.</p>
  <a href="#profil" class="btn">Explore More</a>
</div>

<section id="profil">
  <h2 class="section-title">Kompetensi & Peluang Kerja</h2>
  <p class="section-desc">Kelas X mempelajari kompetensi dasar atau dasar-dasar kuliner...</p>
  <div class="grid">
    <div class="card" style="text-align:center; grid-column: span 2;">
       <img src="https://images.unsplash.com/photo-1551218808-94e220e084d2" style="width:100%; max-height:400px; object-fit:cover; border-radius:12px;">
    </div>
  </div>
</section>

<section id="visi-misi">
  <h2 class="section-title">Visi & Misi</h2>
  <div class="grid">
    <div class="card">
      <h3>Visi</h3>
      <p>Mewujudkan lulusan jurusan yang kompeten, berkarakter dan siap pakai...</p>
    </div>
    <div class="card" style="text-align:center;">
      <img src="Kajur Kuliner.jpeg" style="width:100%; max-height: 200px; object-fit: cover; border-radius:12px; margin-bottom: 10px;">
      <h3>Ida Widianingsih S.Pd</h3>
      <p>Ketua Jurusan Kuliner</p>
    </div>
    <div class="card">
      <h3>Misi</h3>
      <p>Menyelenggarakan pendidikan berbasis kompetensi dan praktik kerja...</p>
    </div>
  </div>
</section>

<section id="dokumentasi">
  <h2 class="section-title">Dokumentasi Praktek</h2>
  <p class="section-desc">Praktik dapur siswa-siswi jurusan Kuliner SMKN 2 Baleendah.</p>
  <div class="grid">
    <div class="card"><img src="Praktek Kuliner.jpeg" style="width:100%; height:180px; object-fit:cover; border-radius:12px;"></div>
    <div class="card"><img src="Praktek Kuliner 2.jpeg" style="width:100%; height:180px; object-fit:cover; border-radius:12px;"></div>
    <div class="card"><img src="Praktek Kuliner 3.jpeg" style="width:100%; height:180px; object-fit:cover; border-radius:12px;"></div>
  </div>
</section>

<section id="dashboard">
  <h2 class="section-title">Dashboard Data Pengurus</h2>
  
  <div class="badge-login">
    Login sebagai : <?= htmlspecialchars($_SESSION['user']); ?>
  </div>

  <?php
  // Mengambil data real-time dari tabel prestasi
  $result = mysqli_query($koneksi, "SELECT * FROM prestasi ORDER BY id DESC");
  ?>

  <div class="table-container">
    <table class="custom-table">
      <thead>
        <tr>
          <th>No</th>
          <th>NIS</th>
          <th>Nama Lengkap</th>
          <th>Kelas</th>
          <th>Jabatan</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $no = 1; 
        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) { 
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['nip'] ?? '-'); ?></td>
            <td><?= htmlspecialchars($row['nama'] ?? '-'); ?></td>
            <td><?= htmlspecialchars($row['kelas'] ?? '-'); ?></td>
            <td><?= htmlspecialchars($row['jabatan'] ?? '-'); ?></td>
            <td style="text-align: center;">
              <a href="hapus.php?id=<?= urlencode($row['id'] ?? ''); ?>" onclick="return confirm('Yakin hapus data ini?')">
                <button class="btn-hapus">Hapus</button>
              </a>
            </td>
          </tr>
        <?php 
            } 
        } else {
        ?>
          <tr>
            <td colspan="6" style="text-align: center;">Belum ada data pengurus.</td>
          </tr>
        <?php 
        } 
        ?>
      </tbody>
    </table>
  </div>

  <div style="margin-top:40px;" class="card">
    <h3 style="margin-bottom:15px;">Tambah Data Pengurus</h3>
    <form action="tambah.php" method="POST">
      <input type="text" name="nip" placeholder="Masukkan NIP" required class="form-control-custom">
      <input type="text" name="nama" placeholder="Nama Lengkap" required class="form-control-custom">
      <input type="text" name="kelas" placeholder="Kelas" required class="form-control-custom">
      <input type="text" name="jabatan" placeholder="Jabatan" required class="form-control-custom">
      <button class="btn" type="submit" name="submit_tambah" style="width:100%;">
        + Tambah Data
      </button>
    </form>
  </div>
</section>

<section id="contact">
  <h2 class="section-title">Hubungi Kami</h2>
  <p class="section-desc">Ikuti media sosial resmi kami atau hubungi kontak di bawah ini.</p>
  <div class="grid">
    <div class="card">
      <h3>Kontak Informasi</h3>
      <p style="margin-bottom: 12px;">📞 Telp: 0812-2132-7897</p>
      <a class="btn" href="https://www.instagram.com/smkn2be" target="_blank">Instagram Resmi</a>
    </div>
  </div>
</section>

<footer>
  © 2026 SMKN 2 Baleendah — Built by Khansa Syawalia R
</footer>

<script>
function toggleMenu(){
  document.getElementById("profile-menu").classList.toggle("active");
}
</script>

</body>
</html>