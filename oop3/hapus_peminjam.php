<?php
include 'koneksi.php';

$id = $_GET['id'];

if (hapusPeminjam($id)) {
    header('Location: peminjam.php');
} else {
    echo "Error: Gagal menghapus peminjam.";
}
?>
