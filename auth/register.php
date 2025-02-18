<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "proyek1");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses form jika dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Enkripsi dengan MD5
    $level = 'client'; // Default user level

    // Masukkan data ke database
    $sql = "INSERT INTO users (nama, username, password, level) VALUES ('$nama', '$username', '$password', '$level')";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman login setelah berhasil registrasi
        echo "<script>
        alert('Register Sukses!');
        window.location.href = 'login.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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