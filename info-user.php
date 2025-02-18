<?php
// Koneksi ke database
$host = "localhost"; // Ganti dengan host database Anda
$user = "traproje_proyek1_bsv"; // Ganti dengan username database Anda
$password = "Cf07mJELniTA"; // Ganti dengan password database Anda
$dbname = "traproje_proyek1_bsv"; // Nama database

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data users
$sql = "SELECT nama, username, password FROM users";
$result = $conn->query($sql);
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

<body></body>

<div class="container mt-5">
    <h2>Info User</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data dari setiap baris
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["nama"] . "</td>
                            <td>" . $row["username"] . "</td>
                            <td>" . $row["password"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada data pengguna.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>