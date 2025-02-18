<?php
// Menampilkan semua error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Memulai sesi untuk mengambil data sesi login
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil username dari sesi
$user = $_SESSION['username'];

// Koneksi ke database
$conn = new mysqli("localhost", "traproje_proyek1_bsv", "Cf07mJELniTA", "traproje_proyek1_bsv");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data file berdasarkan username
$sql = "SELECT file_path, midtrans_link, payment_status, uploaded_at 
        FROM uploaded_files 
        WHERE user = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare statement gagal: " . $conn->error);
}

$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->bind_result($file_path, $midtrans_link, $payment_status, $uploaded_at);

// Menyimpan hasil ke dalam array
$images = [];
while ($stmt->fetch()) {
    $images[] = [
        'file_path' => $file_path,
        'midtrans_link' => $midtrans_link,
        'payment_status' => $payment_status,
        'uploaded_at' => $uploaded_at,
    ];
}

$stmt->close();

// Query untuk mendapatkan data pengguna
$query_user = "SELECT username, email, photo FROM profiles WHERE username = ?";
$stmt_user = $conn->prepare($query_user);

if (!$stmt_user) {
    die("Prepare statement gagal: " . $conn->error);
}

$stmt_user->bind_param("s", $user);
$stmt_user->execute();
$stmt_user->bind_result($db_username, $db_email, $db_photo);

// Default nilai untuk profil
$photo = 'img/user-icon.png'; // Foto default
$username = htmlspecialchars($user);
$email = '';

if ($stmt_user->fetch()) {
    $username = htmlspecialchars($db_username);
    $email = htmlspecialchars($db_email);

    // Cek apakah ada foto profil di database
    if (!empty($db_photo)) {
        $photo = 'profiles/' . htmlspecialchars($db_photo);
    }
}

$stmt_user->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Uploads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #333;
            color: white;
            font-family: Arial, sans-serif;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #555;
            padding: 10px 20px;
        }

        .logo img {
            height: 50px;
        }

        .website-title h1 {
            margin: 0;
            font-size: 2em;
            font-weight: bold;
            color: white;
        }

        .user-icon {
            position: relative;
        }

        .user-icon img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 60px;
            right: 0;
            background-color: white;
            color: black;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            z-index: 1000;
        }

        .dropdown-menu h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .dropdown-menu p {
            font-size: 14px;
            color: #777;
        }

        .dropdown-menu button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px 0;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
        }

        .dropdown-menu .profile-btn {
            background-color: #4CAF50;
            color: white;
        }

        .dropdown-menu .logout-btn {
            background-color: #ff4d4d;
            color: white;
        }

        .image-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .image-container {
            background-color: white;
            color: black;
            width: 300px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.25);
        }

        .image-container img {
            max-width: 100%;
            border-bottom: 1px solid #ddd;
        }

        .download-button {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img src="img/logo.png" alt="Logo">
        </div>
        <div class="website-title">
            <h1>BRAGA SHUTTER VIEW</h1>
        </div>
        <div class="user-icon">
            <img src="<?php echo $photo; ?>" alt="User Profile">
            <div class="dropdown-menu">
                <div class="user-info">
                    <h3><?php echo $username; ?></h3>
                    <p><?php echo $email; ?></p>
                </div>
                <button class="profile-btn" onclick="window.location.href='profile.php'">Edit Profile</button>
                <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <div class="image-row">
            <?php if (!empty($images)): ?>
                <?php foreach ($images as $row): ?>
                    <div class="image-container">
                        <h5><?php echo htmlspecialchars($row['uploaded_at']); ?></h5>
                        <img src="<?php echo htmlspecialchars($row['file_path']); ?>" alt="Uploaded File">
                        <?php if ($row['payment_status'] === 'paid'): ?>
                            <a href="<?php echo htmlspecialchars($row['file_path']); ?>" download class="download-button">Download</a>
                        <?php else: ?>
                            <a href="<?php echo htmlspecialchars($row['midtrans_link']); ?>" class="download-button">Pay Now</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No files uploaded.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        document.querySelector('.user-icon img').addEventListener('click', function () {
            const menu = document.querySelector('.dropdown-menu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.user-icon')) {
                document.querySelector('.dropdown-menu').style.display = 'none';
            }
        });
    </script>
</body>

</html>
