<?php
// Menampilkan semua error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Memulai sesi untuk mengambil atau menyimpan data sesi
session_start();

// Periksa apakah sesi `username` tersedia, menandakan pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak ada sesi `username`, arahkan pengguna ke halaman login
    header("Location: login.php");
    exit();
}

// Sesi `username` tersedia, pengguna diizinkan mengakses halaman
// Informasi username dapat digunakan seperti berikut:
// $username = $_SESSION['username'];
?>


<!-- Konten Dashboard -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Braga Shutter View</title>
  <link rel="icon" type="image/png" href="img/admin-icon.png" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style-admin.css"> <!-- Include file CSS -->
  <style>
    /* Ensure full-width layout on mobile */
    @media (max-width: 768px) {
      .left-bar {
        width: 100%;
        margin-bottom: 20px;
      }
      .main-content {
        width: 100%;
        margin-left: 0;
      }
      .header {
        font-size: 1.5rem;
      }
      .img img {
        width: 100px;
      }
      .admin-icon img {
        width: 30px;
      }
      .left-bar button {
        width: 100%;
        margin-bottom: 10px;
      }
      .content-title {
        font-size: 1.5rem;
      }
      .content-description {
        font-size: 1rem;
      }
    }

    /* For tablets and small devices */
    @media (max-width: 1024px) {
      .left-bar {
        width: 100%;
        margin-bottom: 20px;
      }
      .main-content {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <div>
    <header>
      <!-- Header -->
      <div class="img">
        <img src="img/logo.png" alt="Logo" style="width: 120px" />
      </div>
      <div class="header">BRAGA SHUTTER VIEW</div>
      <div class="admin-icon">
        <img src="img/admin-icon.png" alt="Admin" style="width: 40px" /><br>Admin
      </div>
  </div>
  <div class="row">
    <!-- Left Bar -->
    <div class="col-md-2 left-bar">
      <button onclick="window.location.href='info-transaksi.php'">Info Transaksi</button>
      <button onclick="window.location.href='info-user.php'">Info User</button>
      <button onclick="window.location.href='kelola-foto.php'">Kelola Foto</button>
      <button onclick="window.location.href='katalog_admin.php'">Katalog Admin</button>
      <button onclick="window.location.href='update_payment_status.php'">Set Status Payment</button>
      <button onclick="window.location.href='add-transaksi.php'">Kelola Transaksi</button>
      <button onclick="window.location.href='logout.php'">Logout</button>
    </div>

    <main class="main-content col-md-10">
      <!-- Content Section -->
      <div class="content-title">FOTO & CONTENT</div>
      <div class="content-description">
        Foto dan konten kombinasi sempurna untuk <br>menarik perhatian orang di media sosial dengan visual <br>
        yang menarik dan cerita yang kuat, keduanya bisa <br>
        menciptakan dampak besar.!
      </div>
    </main>
  </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- END CONTENT -->
</body>

</html>
