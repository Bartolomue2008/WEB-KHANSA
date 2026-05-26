<?php
session_start();

if(!isset($_SESSION['user'])){
  header("Location: proses_login.php");
  exit();
}
?>

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
    .success{
        background: rgba(34, 197, 94, 0.15);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #bbf7d0;
        padding: 10px;
        border-radius: 12px;
        font-size: 12px;
        margin-bottom: 15px;
        text-align: center;
    }
     
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body{
      background: #0b1a24;
      color: #e2e8f0;
      line-height: 1.6;
      scroll-behavior: smooth;
    }

    a{
      text-decoration: none;
      color: inherit;
    }

    header{
      background: rgba(11, 38, 46, 0.6);
      backdrop-filter: blur(10px);
      padding: 20px 60px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 100;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    header h1{
      font-size: 22px;
      font-weight: 600;
      color: #7dd3fc;
    }

    .header-right{
      display: flex;
      align-items: center;
      gap: 25px;
    }

    nav a{
      margin-left: 28px;
      font-size: 14px;
      color: #bae6fd;
      transition: 0.3s;
    }

    nav a:hover{
      color: white;
    }

    .profile{
      position: relative;
    }

    .profile-circle{
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: #0284c7;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      font-size: 18px;
      transition: 0.3s;
    }

    .profile-circle:hover{
      background: #0369a1;
    }

    .profile-menu{
      position: absolute;
      top: 55px;
      right: 0;
      background: #0f2d3a;
      padding: 16px;
      border-radius: 16px;
      width: 220px;
      display: none;
      flex-direction: column;
      gap: 12px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.5);
      border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .profile-menu.active{
      display: flex;
    }

    .profile-menu p{
      font-size: 13px;
      color: #bae6fd;
      word-break: break-word;
    }

    .logout-btn{
      padding: 10px 16px;
      border: none;
      border-radius: 999px;
      background: #ef4444;
      color: white;
      cursor: pointer;
      transition: 0.3s;
      font-weight: 600;
    }

    .logout-btn:hover{
      background: #dc2626;
    }

    .hero{
      min-height: 85vh;
      padding: 0 60px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: linear-gradient(rgba(11, 26, 36, 0.8), rgba(11, 26, 36, 0.95)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836');
      background-size: cover;
      background-position: center;
    }

    .hero h2{
      font-size: 52px;
      font-weight: 600;
      margin-bottom: 12px;
      color: #f1f5f9;
    }

    .hero p{
      max-width: 600px;
      font-size: 16px;
      color: #94a3b8;
      margin-bottom: 36px;
    }

    .btn{
      width: fit-content;
      padding: 14px 32px;
      border-radius: 999px;
      background: #0284c7;
      color: white;
      font-size: 14px;
      transition: 0.3s;
      font-weight: 600;
    }

    .btn:hover{
      background: #0369a1;
      transform: translateY(-2px);
    }

    section{
      padding: 80px 60px;
    }

    .section-title{
      font-size: 32px;
      margin-bottom: 24px;
      color: #38bdf8;
    }

    .section-desc{
      max-width: 700px;
      color: #94a3b8;
      margin-bottom: 48px;
    }

    .grid{
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 24px;
    }

    .card{
      background: rgba(15, 45, 58, 0.4);
      padding: 24px;
      border-radius: 16px;
      transition: 0.3s;
      border: 1px solid rgba(255, 255, 255, 0.03);
    }

    .card:hover{
      transform: translateY(-6px);
      background: rgba(15, 45, 58, 0.7);
      border-color: rgba(56, 189, 248, 0.2);
    }

    .card h3{
      margin-bottom: 12px;
      color: #f1f5f9;
    }

    .card p{
      font-size: 14px;
      color: #94a3b8;
    }

    .table-container {
      width: 100%;
      overflow-x: auto;
      background: rgba(15, 45, 58, 0.3);
      padding: 24px;
      border-radius: 16px;
      border: 1px solid rgba(255, 255, 255, 0.05);
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    .custom-table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    .custom-table th {
      background: rgba(56, 189, 248, 0.1);
      color: #38bdf8;
      padding: 16px;
      font-weight: 600;
      font-size: 14px;
      border-bottom: 2px solid rgba(56, 189, 248, 0.2);
    }

    .custom-table td {
      padding: 16px;
      font-size: 14px;
      color: #e2e8f0;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .custom-table tr:hover {
      background: rgba(255, 255, 255, 0.02);
    }

    .badge-login {
      background: #991b1b;
      color: #fee2e2;
      padding: 6px 14px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 600;
      display: inline-block;
      margin-bottom: 20px;
      border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .btn-hapus {
      background: #dc2626;
      color: white;
      padding: 6px 14px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      transition: 0.2s;
    }

    .btn-hapus:hover {
      background: #b91c1c;
    }

    .form-control-custom {
      width: 100%;
      padding: 12px;
      margin-bottom: 12px;
      border-radius: 10px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      outline: none;
      background: #091e27;
      color: #fff;
      transition: 0.3s;
    }

    .form-control-custom:focus {
      border-color: #38bdf8;
    }

    footer{
      text-align: center;
      padding: 32px;
      font-size: 13px;
      color: #64748b;
      background: rgba(11, 26, 36, 0.5);
      border-top: 1px solid rgba(255, 255, 255, 0.03);
    }

    @media(max-width:768px){
      header,
      section,
      .hero{
        padding: 20px 24px;
      }

      .hero h2{
        font-size: 36px;
      }

      nav a{
        margin-left: 12px;
        font-size: 12px;
      }

      .header-right{
        gap: 12px;
      }
    }
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
    </nav>
    
    <div class="profile">
      <div class="profile-circle" onclick="toggleMenu()">
        👤
      </div>

      <div class="profile-menu" id="profile-menu">
        <p style="font-size: 13px; margin-bottom: 5px;">
          User: <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong>
        </p>

        <a href="logout.php">
          <button class="logout-btn" style="width: 100%;">
            Logout
          </button>
        </a>
      </div>
    </div>
  </div>
</header>

<div id="home" class="hero">
  <h2>KULINER</h2>
  <p>
    Jurusan dengan peminat yang banyak setelah TJKT dengan jumlah kelas 16 kelas.
    Membentuk siswa ahli di bidang tata boga dan siap bersaing di industri kreatif.
  </p>
  <a href="#profil" class="btn">
    Explore More
  </a>
</div>

<section id="profil">
  <h2 class="section-title">Kompetensi & Peluang Kerja</h2>
  <p class="section-desc">
    Kelas X mempelajari kompetensi dasar atau dasar-dasar kuliner. Kelas XI mempelajari materi inti, yaitu pengolahan dan penyajian makanan. Siswa akan mempelajari makanan Indonesia dan makanan kontinental. Selain itu, pada materi pengolahan kue dan roti, siswa diajarkan cara membuat kue tradisional Indonesia serta pastry. Siswa juga akan diajarkan cara melayani tamu. Pada kompetensi lainnya, siswa akan mempelajari barista dan menghias makanan. Para siswa diharapkan mampu bersikap mandiri serta mengembangkan kemampuan diri. Lulusan jurusan kuliner dapat melanjutkan ke berbagai aspek, baik pendidikan maupun dunia kerja.
  </p>
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
      <p>
        Mewujudkan lulusan jurusan yang kompeten, berkarakter dan siap pakai, serta mampu melanjutkan pendidikan ke jenjang lebih tinggi maupun langsung terjun ke dunia kerja dan industri.
      </p>
    </div>

    <div class="card" style="text-align:center;">
      <img src="Kajur Kuliner.jpeg" style="width:100%; max-height: 200px; object-fit: cover; border-radius:12px; margin-bottom: 10px;">
      <h3>Ida Widianingsih S.Pd</h3>
      <p>Ketua Jurusan Kuliner</p>
    </div>

    <div class="card">
      <h3>Misi</h3>
      <p>
        Menyelenggarakan pendidikan berbasis kompetensi dan praktik kerja sesuai kebutuhan dunia usaha dan industri, Membekali peserta didik dengan pengetahuan, keterampilan, dan sikap profesional. Dan Menumbuhkan etos kerja, disiplin, dan tanggung jawab pada peserta didik.
      </p>
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
  include "koneksi.php";
  // Memastikan variabel $conn tersedia dari file koneksi.php sebelum menjalankan query
  $result = (isset($conn) && $conn) ? $conn->query("SELECT * FROM prestasi ORDER BY id DESC") : false;
  ?>

  <div class="table-container">
    <table class="custom-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Lengkap</th>
          <th>NIS</th>
          <th>Kelas</th>
          <th>Jabatan OSIS</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        // 1. SOLUSI: Pastikan inisialisasi variabel $no berada tepat di sini sebelum loop dimulai
        $no = 1; 
        
        if ($result && $result->num_rows > 0) {
            // 2. SOLUSI: Menjamin deklarasi $row di dalam kurung perulangan while secara eksplisit
            while($row = $result->fetch_assoc()) { 
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row["nama"] ?? "khansa"); ?></td>
            <td><?= htmlspecialchars($row["nip"] ?? "202020"); ?></td>
            <td><?= htmlspecialchars($row["wali kelas"] ?? "XI KULINER 4"); ?></td>
            <td><?= htmlspecialchars($row["jabatan"] ?? "kajur"); ?></td>
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
            <td colspan="6" style="text-align: center;">Belum ada data pengurus atau terjadi masalah database.</td>
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
      <input type="text" name="nama" placeholder="Nama Lengkap" required class="form-control-custom">
      <input type="text" name="nis" placeholder="NIS" class="form-control-custom">
      <input type="text" name="kelas" placeholder="Kelas" class="form-control-custom">
      <input type="text" name="jabatan" placeholder="Jabatan OSIS" class="form-control-custom">
      <button class="btn" type="submit" style="width:100%;">
        + Tambah Data
      </button>
    </form>
  </div>
</section>

<section id="contact">
  <h2 class="section-title">Hubungi Kami</h2>
  <p class="section-desc">
    Ikuti media sosial resmi kami atau hubungi kontak di bawah ini untuk informasi lebih lanjut mengenai Jurusan Kuliner.
  </p>
  <div class="grid">
    <div class="card">
      <h3>Kontak Informasi</h3>
      <p style="margin-bottom: 8px;">📞 Telp: 0812-2132-7897</p>
      <a class="btn" href="https://www.instagram.com/smkn2be?igsh=em1zcWJjamZoamNw" target="_blank" style="display: inline-block; margin-top: 10px;">
        Instagram SMKN 2 Baleendah
      </a>
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