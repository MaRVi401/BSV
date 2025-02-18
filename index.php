<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Braga Shutter View</title>
    <link rel="stylesheet" href="css/style3.css"> <!-- Include file CSS -->
    <style>
        body, html {
            width: 100%;
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('img/bg-index.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .header {
            width: 100%;
            background-color: #4d4d4d;
            padding: 20px;
            position: absolute;
            top: 0;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            box-sizing: border-box;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            max-width: 80px;
            margin-right: 10px;
        }

        .logo h2 {
            font-size: 1.8rem;
            color: white;
            margin: 0;
        }

        .container {
            text-align: center;
            margin-top: 100px;
            padding: 20px;
            box-sizing: border-box;
        }

        h1 {
            font-size: 2rem;
            margin: 10px 0;
        }

        p {
            font-size: 1rem;
            margin: 5px 0;
        }

        .login-btn {
            background-color: #d1d1d1;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 20px;
            border-radius: 5px;
        }

        .login-btn:hover {
            background-color: #b3b3b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: center;
            }

            .logo h2 {
                font-size: 1.2rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .container {
                margin-top: 80px;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .logo img {
                max-width: 60px;
            }

            .logo h2 {
                font-size: 1rem;
            }

            h1 {
                font-size: 1.2rem;
            }

            .login-btn {
                padding: 8px 16px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">
            <img src="img/logo.png" alt="BSV Logo">
            <h2>BRAGA SHUTTER VIEW</h2>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="container">
        <h1>Menyimpan Kenangan, menciptakan cerita</h1>
        <p>Fotografi tidak hanya tentang menangkap momen, tetapi juga tentang menceritakan kisah.</p>
        <a href="login.php"><button class="login-btn">Login</button></a>
    </div>
</body>
</html>