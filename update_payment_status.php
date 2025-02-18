<?php
// Koneksi ke database
$servername = "localhost";
$username = "traproje_proyek1_bsv";
$password = "Cf07mJELniTA";
$dbname = "traproje_proyek1_bsv"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data user
$sql = "SELECT id, username FROM users";  // Mengambil 'username' dari tabel 'users'
$result = $conn->query($sql);

// Variabel untuk menampilkan notifikasi sukses
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user'];  // User ID
    $payment_status = $_POST['payment_status'];  // Status pembayaran

    // Update status pembayaran berdasarkan user
    $update_sql = "UPDATE uploaded_files SET payment_status = ? WHERE user = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ss", $payment_status, $user_id);
    
    if ($stmt->execute()) {
        // Ambil nama pengguna yang berhasil diupdate
        $successMessage = "Status pembayaran untuk User '$user_id' berhasil diperbarui!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<?php include "header.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Payment Status</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Payment Status</h2>
        
        <!-- Menampilkan notifikasi sukses jika ada -->
        <?php if ($successMessage): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <select name="user" id="user" class="form-select" required>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            // Menampilkan username sebagai pilihan dalam dropdown
                            echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
                        }
                    } else {
                        echo "<option disabled>Tidak ada user tersedia</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="payment_status" class="form-label">Payment Status</label>
                <select name="payment_status" id="payment_status" class="form-select" required>
                    <option value="unpaid">Unpaid</option>
                    <option value="paid">Paid</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Status</button>
        </form>
    </div>

    <!-- Link ke Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
