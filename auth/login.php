<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "proyek1");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses login jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST) && isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Enkripsi dengan MD5

        // Cek apakah username dan password cocok
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Jika cocok, ambil data user
            $row = $result->fetch_assoc();
            $user_level = $row['level'];

            // Redirect berdasarkan level user
            if ($user_level == 'administrator') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: client_dashboard.php");
            }
            exit();
        } else {
            // Jika username atau password salah
            echo "Maaf data yang Anda masukkan salah, silahkan coba kembali!";
        }
    } 
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSV Login</title>
    <link rel="stylesheet" href="../css/style2.css"> <!-- Include file CSS -->
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
