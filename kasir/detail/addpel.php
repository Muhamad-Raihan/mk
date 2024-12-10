<?php
include '../koneksi/koneksi.php';

$database = new database;

if (isset($_POST['submit'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    $database->createPelanggan($nama_pelanggan, $alamat, $telepon);
    header("Location: pelanggan.php");
    exit();
}

$database->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Data Pelanggan</h1>

    <form method="POST" action="addpel.php">
        <div class="form-group">
            <label for="nama_pelanggan">Nama Pelanggan:</label>
            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>

        <div class="form-group">
            <label for="telepon">Telepon:</label>
            <input type="text" class="form-control" id="telepon" name="telepon" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary btn-block">Tambah</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
