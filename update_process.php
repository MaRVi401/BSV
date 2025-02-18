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

// Cek apakah data dikirim melalui POST
if (isset($_POST['id'], $_POST['nama'], $_POST['username'], $_POST['password'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Enkripsi password dengan MD5
    $password_encrypted = md5($password);

    // Query untuk memperbarui data pengguna
    $sql = "UPDATE users SET nama = ?, username = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nama, $username, $password_encrypted, $id);

    if ($stmt->execute()) {
        // Setelah berhasil, redirect ke halaman kelola.php
        header("Location: kelola-foto.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat memperbarui data: " . $stmt->error;
    }
} else {
    echo "Data tidak lengkap.";
}

$conn->close();
?>
