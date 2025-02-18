<?php
// Koneksi ke database
$host = "localhost";
$user = "traproje_proyek1_bsv";
$password = "Cf07mJELniTA";
$dbname = "traproje_proyek1_bsv";

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah username diterima melalui POST
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    // Memulai transaksi
    $conn->begin_transaction();

    try {
        // Query untuk menghapus data pada tabel profiles berdasarkan username
        $sqlProfiles = "DELETE FROM profiles WHERE username = ?";
        $stmtProfiles = $conn->prepare($sqlProfiles);
        $stmtProfiles->bind_param("s", $username); // Menggunakan "s" untuk tipe string
        $stmtProfiles->execute();

        // Query untuk menghapus data pada tabel users berdasarkan username
        $sqlUsers = "DELETE FROM users WHERE username = ?";
        $stmtUsers = $conn->prepare($sqlUsers);
        $stmtUsers->bind_param("s", $username); // Menggunakan "s" untuk tipe string
        $stmtUsers->execute();

        // Query untuk menghapus data pada tabel uploaded_files berdasarkan username
        $sqlUploadedFiles = "DELETE FROM uploaded_files WHERE user = ?";
        $stmtUploadedFiles = $conn->prepare($sqlUploadedFiles);
        $stmtUploadedFiles->bind_param("s", $username); // Menggunakan "s" untuk tipe string
        $stmtUploadedFiles->execute();

        // Jika semua operasi berhasil, commit transaksi
        $conn->commit();

        // Setelah berhasil, redirect kembali ke halaman kelola-foto.php
        header("Location: kelola-foto.php");
        exit();
    } catch (Exception $e) {
        // Jika terjadi kesalahan, rollback transaksi
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Username tidak ditemukan.";
}

$conn->close();
?>
