<?php
include '../koneksi/koneksi.php';
$database = new database;
$dataProduk = $database->readProduk();

if (isset($_GET['delete'])) {
    $produk_id = $_GET['delete'];
    $database->deleteProduk($produk_id);
    header("Location: produk.php");
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
    <title>Data Produk</title>
</head>
<body class="container mt-5">

    <h1 class="text-center mb-4">Data Produk</h1>

    <a href="addpro.php" class="btn btn-primary mb-3">Tambah Produk</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Fitur</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($produk = $dataProduk->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($produk['produk_id']) ?></td>
                    <td><?= htmlspecialchars($produk['nama_produk']) ?></td>
                    <td><?= htmlspecialchars($produk['harga']) ?></td>
                    <td><?= htmlspecialchars($produk['stok']) ?></td>
                    <td>
                        <a href="uppro.php?produk_id=<?= $produk['produk_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="produk.php?delete=<?= $produk['produk_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
