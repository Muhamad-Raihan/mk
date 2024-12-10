<?php
include '../koneksi/koneksi.php';
$database = new database;
$koneksi = $database->kon;

// Hapus transaksi jika ada parameter 'delete'
if (isset($_GET['delete'])) {
    $penjualan_id = $_GET['delete'];
    $database->deleteTransaksi($penjualan_id);
    header("Location: transaksi.php");
    exit();
}

// Mengambil data transaksi menggunakan fungsi readTransaksi
$result = $database->readTransaksi();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Data Transaksi</title>
</head>
<body class="container mt-5">

    <h1 class="text-center mb-4">Data Transaksi</h1>

    <a href='addtran.php' class="btn btn-primary mb-3">Tambah Transaksi</a>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal Penjualan</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Produk</th>
                    <th>Jumlah Produk</th>
                    <th>Subtotal</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['tgl_penjualan']) ?></td>
                        <td><?= htmlspecialchars($row['nama_pelanggan']) ?></td>
                        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                        <td><?= htmlspecialchars($row['jumlah_produk']) ?></td>
                        <td><?= htmlspecialchars($row['subtotal']) ?></td>
                        <td><?= htmlspecialchars($row['total_harga']) ?></td>
                        <td>
                            <a href='uptran.php?id=<?= $row['penjualan_id'] ?>' class="btn btn-warning btn-sm">Edit</a>
                            <a href='transaksi.php?delete=<?= $row['penjualan_id'] ?>' class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Tidak ada data transaksi.</div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Menutup koneksi
$result->free(); // Bebaskan hasil query
$koneksi->close(); // Tutup koneksi database
?>
