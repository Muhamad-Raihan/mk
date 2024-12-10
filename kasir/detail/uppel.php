<?php
include '../koneksi/koneksi.php';

$database = new database;

if (isset($_GET['pelanggan_id'])) {
    $pelanggan_id = $_GET['pelanggan_id'];
    $pelanggan = $database->getPelangganById($pelanggan_id)->fetch_assoc();
}

if (isset($_POST['update'])) {
    $pelanggan_id = $_POST['pelanggan_id'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    $database->updatePelanggan($pelanggan_id, $nama_pelanggan, $alamat, $telepon);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update Pelanggan</title>
</head>
<body class="container mt-5">

<h1 class="text-center mb-4">Update Data Pelanggan</h1>

<form method="POST" action="uppel.php">
    <input type="hidden" name="pelanggan_id" value="<?= htmlspecialchars($pelanggan['pelanggan_id']) ?>">

    <div class="mb-3">
        <label for="nama_pelanggan" class="form-label">Nama Pelanggan:</label>
        <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" value="<?= htmlspecialchars($pelanggan['nama_pelanggan']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat:</label>
        <input type="text" id="alamat" name="alamat" class="form-control" value="<?= htmlspecialchars($pelanggan['alamat']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="telepon" class="form-label">Telepon:</label>
        <input type="text" id="telepon" name="telepon" class="form-control" value="<?= htmlspecialchars($pelanggan['telepon']) ?>" required>
    </div>

    <button type="submit" name="update" class="btn btn-primary">Update</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
