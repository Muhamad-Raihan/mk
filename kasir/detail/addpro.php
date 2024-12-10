<?php
include '../koneksi/koneksi.php';
$db = new Database(); // Create an instance of the Database class

// Add product
if (isset($_POST['submit_add'])) {
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    if ($db->addProduk($nama_produk, $harga, $stok)) {  // Call the method on the $db object
        $message = "Produk berhasil ditambahkan";
    } else {
        $message = "Gagal menambahkan produk.";
    }
}

// Delete product
if (isset($_POST['submit_delete'])) {
    $produk_id = $_POST['produk_id'];

    if ($db->deleteProduk($produk_id)) {  // Call the method on the $db object
        $message = "Produk berhasil dihapus";
    } else {
        $message = "Gagal menghapus produk.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah dan Hapus Produk</title>
</head>
<body class="container mt-5">

    <?php if (isset($message)): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <div class="card mb-5">
        <div class="card-header">
            <h2>Tambah Produk</h2>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk:</label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga:</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok:</label>
                    <input type="number" class="form-control" id="stok" name="stok" required>
                </div>
                <button type="submit" name="submit_add" class="btn btn-primary">Tambah Produk</button>
            </form>
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-header">
            <h2>Hapus Produk</h2>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="produk_id" class="form-label">ID Produk:</label>
                    <input type="number" class="form-control" id="produk_id" name="produk_id" required>
                </div>
                <button type="submit" name="submit_delete" class="btn btn-danger">Hapus Produk</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
