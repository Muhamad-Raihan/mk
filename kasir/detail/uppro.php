<?php
include '../koneksi/koneksi.php'; // Including the koneksi.php file
$database = new database(); // Create an instance of the database class

// Initialize variables for the product data
$produk_id = $nama_produk = $harga = $stok = "";
$message = "";

// Update product
if (isset($_POST['submit_update'])) {
    $produk_id = $_POST['produk_id'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Call the updateProduk method on the $database object
    if ($database->updateProduk($produk_id, $nama_produk, $harga, $stok)) {
        $message = "Produk berhasil diupdate";
    } else {
        $message = "Gagal mengupdate produk.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update Produk</title>
</head>
<body class="container mt-5">

    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <div class="card mb-5">
        <div class="card-header">
            <h2>Update Produk</h2>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="produk_id" class="form-label">ID Produk:</label>
                    <input type="number" class="form-control" id="produk_id" name="produk_id" value="<?= htmlspecialchars($produk_id); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk:</label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= htmlspecialchars($nama_produk); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga:</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?= htmlspecialchars($harga); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok:</label>
                    <input type="number" class="form-control" id="stok" name="stok" value="<?= htmlspecialchars($stok); ?>" required>
                </div>
                <button type="submit" name="submit_update" class="btn btn-success">Update Produk</button>
            </form>
            <a href="addpro.php" class="btn btn-secondary mt-3">Tambah Produk</a>
        </div>
    </div>

</body>
</html>
