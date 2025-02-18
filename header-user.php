<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSV</title>
    <style>
        /* Global Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling untuk body */
        body {
            background-color: #333;
            color: white;
            font-family: Arial, sans-serif;
        }

        /* Left sidebar */
        .left-bar {
            background-color: #e0e0e0;
            height: 100vh;
            padding-top: 30px;
        }

        .left-bar button {
            background-color: black;
            color: white;
            width: 100%;
            margin: 10px;
            padding: 10px;
            border: none;
            font-size: 20px;
            border-radius: 20px;
        }

        /* Header */
        header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #555;
        }

        /* Header Section */
        .header {
            text-align: center;
            padding: 30px 0;
            font-size: 1.8em;
            font-weight: bold;
        }

        /* Image (if needed) */
        .img {
            margin-left: 70px;
        }

        /* Admin Icon Section */
        .admin-icon {
            margin-top: 10px;
            margin-right: 25px;
        }

        .admin-icon p {
            margin: 5px;
            margin-right: 35px;
        }

        /* Content Title */
        .content-title {
            font-size: 40px;
            font-family: 'Times New Roman', Times, serif;
        }

        /* Content Description */
        .content-description {
            padding-top: 5px;
            font-size: 20px;
            line-height: 45px;
            font-family: 'Times New Roman', Times, serif;
        }

        /* Main Content */
        .main-content {
            display: flex;
            flex-direction: column;
            padding-top: 40px;
            padding-left: 50px;
            background-image: url('../img/bg-content.png');
        }

        /* Styling untuk logo dan judul website */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo img {
            height: 50px; /* Ukuran logo */
        }

        .website-title h1 {
            margin: 0;
            font-size: 2em;
            font-weight: bold;
            text-align: center;
            color: white;
            font-family: 'Times New Roman', Times, serif;
        }

        /* Ikon User */
        .user-icon {
            display: flex;
            flex-direction: column; /* Mengubah arah dari horizontal ke vertikal */
            align-items: center; /* Menyusun ikon dan nama di tengah */
        }

        .user-icon img {
            margin-top: 10px;
            border-radius: 50%;
            margin-bottom: auto; /* Memberikan sedikit ruang antara ikon dan teks */
        }

        .user-icon p {
            margin: 0;
            font-size: 1.3em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <!-- Logo Website -->
            <div class="logo">
                <img src="img/logo.png" alt="Website Logo" height="50">
            </div>
            
            <!-- Judul Website -->
            <div class="website-title">
                <h1>BRAGA SHUTTER VIEW</h1>
            </div>
            
            <!-- Ikon User Login -->
            <div class="user-icon">
                <img src="img/admin-icon.png" alt="User Icon" height="40">
                <p style="color: white;"><?php echo htmlspecialchars($user); ?></p>
            </div>
        </div>
    </header>
</body>
</html>
