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

// Query untuk mengambil data pengguna
$sql = "SELECT id, nama, username, password FROM users"; // Pastikan mengambil 'id' juga
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2>Kelola Pengguna</h2>

        <!-- Tabel untuk menampilkan data pengguna -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Cek apakah ada data pengguna
                if ($result->num_rows > 0) {
                    // Menampilkan setiap baris data pengguna
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row["nama"]) . "</td>
                            <td>" . htmlspecialchars($row["username"]) . "</td>
                            <td>" . htmlspecialchars($row["password"]) . "</td>
                            <td>
                                <!-- Tombol Update, redirect ke halaman update dengan ID sebagai parameter -->
                                <a href='update.php?id=" . $row["id"] . "' class='btn btn-success'>UPDATE</a>
                                <!-- Form untuk DELETE, akan mengirim ID data melalui POST -->
                                <form action='delete.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                    <button type='submit' class='btn btn-danger'>DELETE</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data pengguna ditemukan.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
