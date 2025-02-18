<?php
// Menampilkan semua error untuk debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Koneksi ke database
$conn = new mysqli("localhost", "traproje_proyek1_bsv", "Cf07mJELniTA", "traproje_proyek1_bsv");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses form jika dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Menggunakan password_hash untuk enkripsi
    $level = 'client'; // Default user level

    // Cek apakah username sudah ada di database
    $sql_check = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql_check);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $username); // Bind parameter untuk username
    $stmt->execute();
    
    // Mengambil hasil query menggunakan bind_result()
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        // Jika username sudah ada
        echo "<script>
        alert('Username sudah terdaftar, coba gunakan username lain!');
        window.location.href = 'register.php';
        </script>";
        exit();
    }

    // Mulai transaksi untuk memastikan kedua query berhasil
    $conn->begin_transaction();

    try {
        // Masukkan data ke tabel users
        $sql = "INSERT INTO users (nama, username, password, level) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ssss", $nama, $username, $password, $level);
        if (!$stmt->execute()) {
            throw new Exception("Error executing query: " . $stmt->error);
        }

        // Masukkan data ke tabel profiles dengan username
        $sql_profile = "INSERT INTO profiles (username) VALUES (?)";
        $stmt_profile = $conn->prepare($sql_profile);
        if ($stmt_profile === false) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }

        $stmt_profile->bind_param("s", $username);
        if (!$stmt_profile->execute()) {
            throw new Exception("Error executing profile query: " . $stmt_profile->error);
        }

        // Jika kedua query berhasil, commit transaksi
        $conn->commit();

        // Redirect ke halaman login setelah berhasil registrasi
        echo "<script>
        alert('Registrasi Sukses! Silakan login.');
        window.location.href = 'login.php';
        </script>";
        exit();
    } catch (Exception $e) {
        // Jika terjadi kesalahan, rollback transaksi
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style2.css"> <!-- Include file CSS -->
</head>
<body>
    <div class="container">
        <div class="image-container">
            <!-- Container for the camera image -->
        </div>
        <div class="form-container">
            <div class="login-container">
                <h1>BSV</h1>
                <form action="" method="post">
                    <input type="text" id="nama" name="nama" placeholder="NAMA" required>
                    <input type="text" name="username" placeholder="USERNAME" required>
                    <input type="password" name="password" placeholder="PASSWORD" required>
                    <button type="submit">Register</button>
                    <div class="register">
                        <a href="login.php">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
