<?php
include '../koneksi/koneksi.php';
$database = new database;
$dataPelanggan = $database->readPelanggan();

if (isset($_GET['delete'])) {
    $pelanggan_id = $_GET['delete'];
    $database->deletePelanggan($pelanggan_id);
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
    <title>Data Pelanggan</title>
</head>
<body class="container mt-5">

    <h1 class="text-center mb-4">Data Pelanggan</h1>

    <a href="addpel.php" class="btn btn-primary mb-3">Pendaftaran Member Ramah</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Fitur</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($pelanggan = $dataPelanggan->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($pelanggan['pelanggan_id']) ?></td>
                    <td><?= htmlspecialchars($pelanggan['nama_pelanggan']) ?></td>
                    <td><?= htmlspecialchars($pelanggan['alamat']) ?></td>
                    <td><?= htmlspecialchars($pelanggan['telepon']) ?></td>
                    <td>
                        <a href="uppel.php?pelanggan_id=<?= $pelanggan['pelanggan_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="pelanggan.php?delete=<?= $pelanggan['pelanggan_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
