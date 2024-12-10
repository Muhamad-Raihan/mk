<?php
include('../koneksi/koneksi.php');
$db = new database();

$result = $db->getAllTransaksi();
$pesan_result = $db->getAllPesan();

if (isset($_GET['delete'])) {
    $id_transaksi = $_GET['delete'];
    $db->deleteTransaksi($id_transaksi);
    header("Location: transaksi.php");
    exit; // Added exit to stop further script execution
}

if (isset($_GET['delete'])) {
    $id_pesan = $_GET['delete'];
    $db->deletePesan($id_pesan);
    header("Location: transaksi.php");
    exit; // Added exit to stop further script execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Daftar Transaksi</h2>
        <a href="addtran.php" class="btn btn-success mb-3">Tambah Transaksi</a>
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>Nama Mobil</th>
                    <th>Kode Mobil</th>
                    <th>Tanggal</th>
                    <th>Durasi</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['nama_pelanggan']; ?></td>
                    <td><?php echo $row['nama_mobil']; ?></td>
                    <td><?php echo $row['kode_mobil']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['durasi']; ?></td>
                    <td>Rp <?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['pembayaran']; ?></td>
                    <td>
                        <a href="uptran.php?id_transaksi=<?php echo $row['id_transaksi']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="transaksi.php?delete=<?php echo $row['id_transaksi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <h2 class="mt-5">Daftar Pesanan</h2>
        <div class="row">
            <?php while($row = mysqli_fetch_assoc($pesan_result)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan ID: <?php echo $row['id_pesan']; ?></h5>
                        <p class="card-text">
                            <strong>Nama Pemesan :</strong> <?php echo $row['nama']; ?><br>
                            <strong>Kode Mobil:</strong> <?php echo $row['kode_mobil']; ?><br>
                            <strong>Tanggal Pesan:</strong> <?php echo $row['tanggal']; ?><br>
                            <strong>Durasi (hari):</strong> <?php echo $row['durasi']; ?> hari<br>
                            <strong>Total Harga:</strong> Rp <?php echo number_format($row['total'], 0, ',', '.'); ?>
                        </p>
                        <a href="uppesan.php?id_pesan=<?php echo $row['id_pesan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="pesanan.php?delete=<?php echo $row['id_pesan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pesanan ini?');">Delete</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

    </div>

    <!-- Bootstrap JS & dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
