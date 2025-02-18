<?php
// // Koneksi ke database
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "proyek1";

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Periksa koneksi
// if ($conn->connect_error) {
//     die("Koneksi gagal: " . $conn->connect_error);
// }

// // Mendapatkan data notifikasi dari Midtrans
// $payload = file_get_contents('php://input');
// $data = json_decode($payload, true);

// // Cek apakah data valid dan pembayaran berhasil
// if (isset($data['transaction_status']) && $data['transaction_status'] == 'success') {
//     // Mendapatkan ID file dari data notifikasi
//     $fileId = $data['order_id'];  // Asumsikan order_id adalah ID file di database

//     // Query untuk memperbarui status pembayaran menjadi 'paid'
//     $sqlUpdate = "UPDATE uploaded_files SET payment_status = 'paid' WHERE id = ?";
//     $stmt = $conn->prepare($sqlUpdate);
//     $stmt->bind_param("i", $fileId);  // Bind ID file dari notifikasi
//     $stmt->execute();

//     if ($stmt->affected_rows > 0) {
//         echo "Status pembayaran berhasil diperbarui menjadi 'paid'.";
//     } else {
//         echo "Terjadi kesalahan dalam memperbarui status pembayaran.";
//     }

//     $stmt->close();
// } else {
//     echo "Pembayaran gagal atau tidak valid.";
// }

// $conn->close();
?>
