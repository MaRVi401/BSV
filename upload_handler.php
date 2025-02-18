<?php
// Koneksi ke database
$host = "localhost";
$username = "traproje_proyek1_bsv";
$password = "Cf07mJELniTA";
$dbname = "traproje_proyek1_bsv";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Periksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'] ?? '';
    $category = $_POST['category'] ?? '';
    $midtransLink = $_POST['midtrans_link'] ?? ''; // Tangkap link Midtrans dari form
    $uploadDir = 'uploads/';
    $allowedTypes = ['image/jpeg', 'image/png']; // Tipe file yang diizinkan

    // Buat folder uploads jika belum ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Periksa apakah ada file yang diunggah
    if (!empty($_FILES['files']['name'][0])) {
        $uploadSuccess = true; // Flag untuk melacak keberhasilan

        foreach ($_FILES['files']['name'] as $index => $fileName) {
            $tmpFilePath = $_FILES['files']['tmp_name'][$index];
            $fileError = $_FILES['files']['error'][$index];
            $fileType = $_FILES['files']['type'][$index];

            // Validasi error file
            if ($fileError !== UPLOAD_ERR_OK) {
                $uploadSuccess = false;
                continue;
            }

            // Validasi tipe file
            if (!in_array($fileType, $allowedTypes)) {
                $uploadSuccess = false;
                continue;
            }

            // Generate nama file unik
            $uniqueFileName = uniqid() . '_' . $fileName;
            $filePath = $uploadDir . $uniqueFileName;

            // Pindahkan file ke folder uploads
            if (move_uploaded_file($tmpFilePath, $filePath)) {
                try {
                    // Simpan informasi file dan link Midtrans ke database
                    $stmt = $pdo->prepare("
                        INSERT INTO uploaded_files (user, category, file_name, file_path, midtrans_link) 
                        VALUES (:user, :category, :file_name, :file_path, :midtrans_link)
                    ");
                    $stmt->execute([
                        ':user' => $user,
                        ':category' => $category,
                        ':file_name' => $fileName,
                        ':file_path' => $filePath,
                        ':midtrans_link' => $midtransLink,
                    ]);
                } catch (PDOException $e) {
                    $uploadSuccess = false;
                }
            } else {
                $uploadSuccess = false;
            }
        }

        // Redirect berdasarkan hasil unggahan
        if ($uploadSuccess) {
            header("Location: kelola-foto.php");
            exit;
        } else {
            header("Location: upload-file.php");
            exit;
        }
    } else {
        // Tidak ada file yang diunggah
        header("Location: upload-file.php");
        exit;
    }
}
?>
