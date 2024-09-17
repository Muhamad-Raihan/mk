<?php
include 'koneksi.php';

$id = $_GET['id'];

// Panggil fungsi hapusBuku dari koneksi.php
if (hapusBuku($id)) {
    header('Location: index.php');
} else {
    echo "Error: Gagal menghapus buku.";
}
?>
