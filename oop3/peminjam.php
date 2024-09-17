<?php
include 'koneksi.php';
$peminjam = getAllPeminjam();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Peminjam</h1>
        <a href="tambah_peminjam.php" class="btn btn-success mb-3">Tambah Peminjam</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Tanggal Pinjam</th>
                    <th>Lama Pinjam</th>
                    <th>Status</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $peminjam->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['peminjam_id']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['tgl_pinjam']; ?></td>
                        <td><?= $row['lama_pinjam']; ?></td>
                        <td><?= $row['status']; ?></td>
                        <td><?= $row['telp']; ?></td>
                        <td>
                            <a href="edit_peminjam.php?id=<?= $row['peminjam_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_peminjam.php?id=<?= $row['peminjam_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus peminjam ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
