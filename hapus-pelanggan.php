<?php

session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('login dulu dong');
            document.location.href = 'login.php';
          </script>";
    exit;
}

include 'config/app.php';

// menerima id pelanggan yang dipilih pengguna
$id_pelanggan = (int)$_GET['id_pelanggan'];

if (delete_pelanggan($id_pelanggan) > 0) {
    echo "<script>
            alert('Data Pelanggan Berhasil Dihapus');
            document.location.href = 'dashboard.php';
          </script>";
} else {
    echo "<script>
            alert('Data Pelanggan Gagal Dihapus');
            document.location.href = 'dashboard.php';
          </script>";
}
