<?php
// Koneksi ke database
$host = "localhost"; // Ganti dengan host database Anda
$user = "traproje_proyek1_bsv"; // Ganti dengan username database Anda
$password = "Cf07mJELniTA"; // Ganti dengan password database Anda
$dbname = "traproje_proyek1_bsv"; // Nama database

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data users
$sql = "SELECT nama, username, password FROM users";
$result = $conn->query($sql);
?>
