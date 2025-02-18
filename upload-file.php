<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files - BSV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling untuk body */
        body {
            background-color: #d3d3d3;
            font-family: Arial, sans-serif;
        }

        /* Header Styling */
        header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #555;
            padding: 10px 20px;
            color: white;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo img {
            height: 50px;
        }

        .website-title h1 {
            margin: 0;
            font-size: 1.8em;
            font-weight: bold;
            text-align: center;
            color: white;
            font-family: 'Times New Roman', Times, serif;
        }

        .user-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .user-icon img {
            margin-top: 5px;
            border-radius: 50%;
        }

        .user-icon p {
            margin: 0;
            font-size: 1.1em;
            font-weight: bold;
        }

        /* Upload Container Styling */
        .upload-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
            margin: 40px auto;
        }

        .upload-box {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .upload-box:hover {
            border-color: #888;
        }

        .add-files-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-files-btn:hover {
            background-color: #218838;
        }

        .form-select,
        .form-control {
            margin-bottom: 15px;
        }

        .cancel-link {
            color: #007bff;
            text-decoration: none;
        }

        .cancel-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Header -->
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
                <p>Admin</p>
            </div>
        </div>
    </header>

    <!-- Upload Files Section -->
    <div class="upload-container">
        <h3>Upload Files</h3>
        <form action="upload_handler.php" method="POST" enctype="multipart/form-data">
            <!-- Drop Files Area -->
            <div class="upload-box">
                <p>Drop your files here!<br>or click</p>
                <input type="file" class="form-control" name="files[]" multiple required>
            </div>

            <!-- Select User -->
            <div class="mb-3">
                <label for="selectUser" class="form-label">Select User</label>
                <select id="selectUserDropdown" class="form-select" name="user" required>
                    <?php
                    // Koneksi ke database
                    $servername = "localhost";
                    $username = "traproje_proyek1_bsv";
                    $password = "Cf07mJELniTA";
                    $dbname = "traproje_proyek1_bsv";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Periksa koneksi
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Query untuk mendapatkan daftar pengguna
                    $sql = "SELECT username FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['username']) . "'>" . htmlspecialchars($row['username']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No users available</option>";
                    }

                    $conn->close();
                    ?>
                </select>
            </div>


            <!-- Category -->
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select id="category" class="form-select" name="category" required>
                    <option value="private">Private</option>
                    <option value="public">Public</option>
                </select>
            </div>

            <!-- Midtrans Link -->
            <div class="mb-3">
                <label for="midtransLink" class="form-label">Midtrans Link</label>
                <input type="url" id="midtransLink" class="form-control" placeholder="Enter Midtrans link"
                    name="midtrans_link" required>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Upload files</button>
                <a href="kelola-foto.php" class="cancel-link">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>