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
$sql = "SELECT id, nama, username, password FROM users"; // Pastikan mengambil 'id' juga
$result = $conn->query($sql);
?>

<?php include "header.php"; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        // Fungsi untuk konfirmasi sebelum menghapus
        function confirmDelete(username) {
            // Menampilkan popup konfirmasi
            var confirmAction = confirm("Apakah Anda yakin ingin menghapus user dengan username: " + username + "?");
            if (confirmAction) {
                // Jika user klik "OK", form delete akan disubmit
                document.getElementById("deleteForm-" + username).submit();
            }
        }
    </script>
</head>

<body>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center" style="padding: 10px;">
            <h2 style="margin: 0;">Kelola Katalog</h2>
            <a href="https://dashboard.sandbox.midtrans.com/snap_links#/" target="_blank" class="btn btn-primary">
                MIDTRANS
            </a>
        </div>

        <!-- Tabel untuk menampilkan data pengguna -->
        <table class="table">
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
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row["nama"]) . "</td>
                                <td>" . htmlspecialchars($row["username"]) . "</td>
                                <td>" . htmlspecialchars($row["password"]) . "</td>
                                <td>
                                    <!-- Tombol Update, redirect ke halaman update dengan username sebagai parameter -->
                                    <a href='upload-file.php?username=" . $row["username"] . "' class='btn btn-success'>UPDATE</a>
                                    <!-- Form untuk DELETE, dengan ID untuk form masing-masing user -->
                                    <form id='deleteForm-" . $row["username"] . "' action='delete.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='username' value='" . $row["username"] . "'>
                                        <button type='button' class='btn btn-danger' onclick='confirmDelete(\"" . $row["username"] . "\")'>DELETE</button>
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
