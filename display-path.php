<?php
$host = "localhost";
$user = "traproje_proyek1_bsv";
$password = "Cf07mJELniTA";
$dbname = "traproje_proyek1_bsv";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses Hapus Data
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];
    $sql_delete = "DELETE FROM uploaded_files WHERE id = $id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $conn->error;
    }
    exit;
}

// Proses Update Data
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $user = $_POST['user'];
    $category = $_POST['category'];
    $file_name = $_POST['file_name'];
    $file_path = $_POST['file_path'];
    $payment_status = $_POST['payment_status'];
    $midtrans_link = $_POST['midtrans_link'];

    $sql_update = "UPDATE uploaded_files SET 
                   user = '$user', 
                   category = '$category', 
                   file_name = '$file_name', 
                   file_path = '$file_path', 
                   payment_status = '$payment_status', 
                   midtrans_link = '$midtrans_link'
                   WHERE id = $id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Data berhasil diperbarui";
    } else {
        echo "Error: " . $conn->error;
    }
    exit;
}

// Query untuk Mengambil Data
$sql = "SELECT * FROM uploaded_files";
$result = $conn->query($sql);
?>

<?php include ("header.php")?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Uploads</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .image-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 20px;
        }

        .image-container {
            position: relative;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            background-color: #ffffff;
            padding: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: inline-block; /* Membuat kotak mengikuti ukuran isi */
        }

        .image-container:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
        }

        .download-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        img {
            display: block; /* Menghilangkan whitespace bawaan inline element */
            max-width: 100%;
            height: auto; /* Menjaga proporsi gambar */
            border-radius: 10px;
        }

        h3 {
            font-size: 1.2rem;
            margin-top: 10px;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Gambar yang Diunggah untuk User: <?php echo htmlspecialchars($user); ?></h1>

        <div class="image-row">
            <?php if (!empty($images)) : ?>
                <?php foreach ($images as $row) : ?>
                    <div class="image-container">
                        <h3><?php echo htmlspecialchars($row['uploaded_at']); ?></h3>
                        <?php if ($row['payment_status'] === 'paid') : ?>
                            <!-- Jika pembayaran berhasil -->
                            <img src="<?php echo htmlspecialchars($row['file_path']); ?>" alt="Gambar" class="img-fluid" />
                            <a href="<?php echo htmlspecialchars($row['file_path']); ?>" download class="btn btn-primary download-button">Download Gambar</a>
                        <?php else : ?>
                            <!-- Jika pembayaran belum berhasil -->
                            <a href="<?php echo htmlspecialchars($row['midtrans_link']); ?>" target="_blank">
                                <img src="<?php echo htmlspecialchars($row['file_path']); ?>" alt="Gambar" class="img-fluid" />
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">Tidak ada gambar yang diunggah.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Link Bootstrap JS dan Popper.js untuk interaksi -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
