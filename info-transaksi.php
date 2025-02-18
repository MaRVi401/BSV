<?php
// Koneksi ke database
$host = "localhost"; 
$user = "traproje_proyek1_bsv";
$password = "Cf07mJELniTA";
$dbname = "traproje_proyek1_bsv";

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk menghitung total jumlah
$totalJumlah = 0;

// Proses Update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $tanggal = $_POST["tanggal"];
    $jumlah = $_POST["jumlah"];
    $status = $_POST["status"];

    $sqlUpdate = "UPDATE transaksi SET nama='$nama', tanggal='$tanggal', jumlah='$jumlah', status='$status' WHERE id='$id'";

    if ($conn->query($sqlUpdate) === TRUE) {
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Proses Delete
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $sqlDelete = "DELETE FROM transaksi WHERE id='$id'";

    if ($conn->query($sqlDelete) === TRUE) {
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Mendapatkan data transaksi
$sql = "SELECT id, nama, tanggal, jumlah, status FROM transaksi";
$result = $conn->query($sql);

// Variabel untuk mengisi form update
$updateData = null;
if (isset($_GET["update"])) {
    $id = $_GET["update"];
    $sqlEdit = "SELECT * FROM transaksi WHERE id='$id'";
    $editResult = $conn->query($sqlEdit);
    if ($editResult->num_rows == 1) {
        $updateData = $editResult->fetch_assoc();
    }
}
?>

<?php include "header.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link rel="icon" type="image/png" href="img/admin-icon.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Data Transaksi</h2>
    
    <!-- Form Update -->
    <?php if ($updateData): ?>
        <h4>Update Data Transaksi</h4>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $updateData['id']; ?>">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $updateData['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" name="tanggal" value="<?php echo $updateData['tanggal']; ?>" required>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" value="<?php echo $updateData['jumlah']; ?>" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <input type="text" class="form-control" name="status" value="<?php echo $updateData['status']; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">Batal</a>
        </form>
        <hr>
    <?php endif; ?>

    <!-- Tabel Data -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["nama"] . "</td>
                            <td>" . $row["tanggal"] . "</td>
                            <td>" . $row["jumlah"] . "</td>
                            <td>" . $row["status"] . "</td>
                            <td>
                                <a href='?update=" . $row["id"] . "' class='btn btn-warning btn-sm'>Update</a>
                                <a href='?delete=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Delete</a>
                            </td>
                          </tr>";
                    $totalJumlah += $row["jumlah"]; // Menambahkan nilai jumlah ke total
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada data pengguna.</td></tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">TOTAL PENDAPATAN:</th>
                <th><?php echo 'Rp.' , $totalJumlah; ?></th>
                <th colspan="2"></th>
            </tr>
        </tfoot>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
