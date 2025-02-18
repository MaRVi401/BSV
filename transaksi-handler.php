<?php
include "db.php"; // Pastikan file ini berisi koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    $status = $_POST['status'];

    // Siapkan dan bind
    $stmt = $conn->prepare("INSERT INTO transaksi (id, nama, tanggal, jumlah, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $kode, $nama, $tanggal, $jumlah, $status);

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "Transaksi Berhasil Terdata!.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();

    // Redirect kembali ke halaman utama setelah menambahkan pengguna
    header("Location: add-transaksi.php"); 
    exit();
}
?>