<?php
include 'koneksi.php';

$id = $_GET['id'];

// Panggil fungsi hapusPetugas dari koneksi.php
if (hapusPetugas($id)) {
    header('Location: petugas.php');
} else {
    echo "Error: Gagal menghapus petugas.";
}
?>
