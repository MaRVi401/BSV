<?php
// Memulai sesi
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "traproje_proyek1_bsv", "Cf07mJELniTA", "traproje_proyek1_bsv");

// Cek apakah koneksi berhasil
if ($conn->connect_error) {
    error_log("Koneksi gagal: " . $conn->connect_error);
    die("Terjadi kesalahan saat mencoba terhubung ke database.");
}

// Proses login jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Mengambil data dari form dan mensanitasi input
        $username = $conn->real_escape_string($_POST['username']);
        $password = $_POST['password'];

        // Menyiapkan query untuk menghindari SQL Injection
        $sql = "SELECT id, username, password, level FROM users WHERE username=?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($db_id, $db_username, $db_password, $db_level);

            // Memeriksa apakah ada hasil
            if ($stmt->fetch()) {
                // Verifikasi password yang telah di-hash
                if (password_verify($password, $db_password)) {
                    // Menyimpan username ke session
                    $_SESSION['username'] = $db_username;

                    // Redirect berdasarkan level user
                    if ($db_level == 'administrator') {
                        header("Location: admin_dashboard.php");
                    } else {
                        header("Location: client_dashboard.php");
                    }
                    exit();
                } else {
                    // Jika password salah
                    echo "<script>
                        alert('Data yang anda masukan salah!');
                        window.location.href = 'login.php';
                    </script>";
                }
            } else {
                // Jika username tidak ditemukan
                echo "<script>
                    alert('Data yang anda masukan salah!');
                    window.location.href = 'login.php';
                </script>";
            }

            // Menutup prepared statement
            $stmt->close();
        } else {
            error_log("Gagal menyiapkan statement: " . $conn->error);
            die("Terjadi kesalahan saat memproses data.");
        }
    } else {
        echo "<script>
            alert('Username atau Password belum diisi!');
            window.location.href = 'login.php';
        </script>";
    }
}

// Menutup koneksi ke database
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSV Login</title>
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
                <form action="login.php" method="post">
                    <input type="text" name="username" placeholder="USERNAME" required>
                    <input type="password" name="password" placeholder="PASSWORD" required>
                    <button type="submit">Login</button>
                    <div class="register">
                        <a href="register.php">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
