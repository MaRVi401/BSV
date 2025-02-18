<?php
session_start(); // Mulai sesi

// Hapus semua data sesi
session_unset(); 

// Hancurkan sesi
session_destroy(); 

// Gunakan JavaScript untuk menampilkan alert dan melakukan redirect
echo "<script>
        alert('Anda telah logout dari halaman ini');
        window.location.href = 'login.php';
      </script>";
exit();
?>
