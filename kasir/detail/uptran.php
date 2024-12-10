<?php
include '../koneksi/koneksi.php';
$database = new database();
$koneksi = $database->kon;

$id = $_GET['id'];

// Ambil data transaksi yang akan diedit menggunakan fungsi dari class database
$transaksi = $database->getTransaksiById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pelanggan_id = $_POST['pelanggan_id'];
    $produk_id = $_POST['produk_id'];
    $jumlah_produk = $_POST['jumlah_produk'];

    // Update transaksi menggunakan fungsi dari class database
    if ($database->updateTransaksi($id, $pelanggan_id, $produk_id, $jumlah_produk)) {
        header("Location: transaksi.php");
        exit();
    } else {
        $error_message = "Gagal memperbarui transaksi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update Transaksi</title>
</head>
<body class="container mt-5">

    <h1>Update Transaksi</h1>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="pelanggan_id" class="form-label">Pelanggan:</label>
            <select name="pelanggan_id" class="form-select" required>
                <?php
                $pelanggan = $database->readPelanggan();
                while($row = mysqli_fetch_assoc($pelanggan)) {
                    echo "<option value='".$row['pelanggan_id']."' ".($row['pelanggan_id'] == $transaksi['pelanggan_id'] ? 'selected' : '').">".$row['nama_pelanggan']."</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="produk_id" class="form-label">Produk:</label>
            <select name="produk_id" class="form-select" required>
                <?php
                $produk = $database->readProduk();
                while($row = mysqli_fetch_assoc($produk)) {
                    echo "<option value='".$row['produk_id']."' ".($row['produk_id'] == $transaksi['produk_id'] ? 'selected' : '').">".$row['nama_produk']."</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah_produk" class="form-label">Jumlah Produk:</label>
            <input type="number" name="jumlah_produk" class="form-control" value="<?php echo htmlspecialchars($transaksi['jumlah_produk']); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Transaksi</button>
        <a href="transaksi.php" class="btn btn-secondary">Batal</a>
    </form>
</body>
</html>
