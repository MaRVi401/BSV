<?php
session_start(); // Memulai sesi

// Pastikan session sudah menyimpan data login
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect jika belum login
    exit;
}
$username = $_SESSION['username']; // Ambil username dari session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Braga Shutter View - Profil</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #000;
        }
        .container {
            margin: 20px auto;
            background-color: #ccc;
            color: #000;
            width: 90%;
            max-width: 600px;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            margin-bottom: 20px;
            font-size: 1.5rem;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #aaa;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group button {
            background-color: #00695c;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .form-group button:hover {
            background-color: #004d40;
        }
        .profile-image {
            margin: 20px auto;
            border-radius: 50%;
            width: 100px;
            height: 100px;
            background-color: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .profile-image img {
            width: 100%;
            height: auto;
        }

        /* Media Queries */
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }
            .container h2 {
                font-size: 1.2rem;
            }
            .form-group button {
                padding: 8px 16px;
                font-size: 1rem;
            }
        }

        @media (max-width: 400px) {
            .container {
                padding: 10px;
            }
            .container h2 {
                font-size: 1rem;
            }
            .form-group input[type="text"],
            .form-group input[type="email"],
            .form-group input[type="file"] {
                padding: 8px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Profil</h2>
        <div class="profile-image">
            <img src="img/user-icon.png" alt="User Profile">
        </div>
        <form action="profile_handler.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo isset($row['email']) ? htmlspecialchars($row['email']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="photo">Change Photo</label>
                <input type="file" id="photo" name="photo">
            </div>
            <div class="form-group">
                <button type="submit">Update Profile</button>
            </div>
        </form>
    </div>
</body>
</html>