<?php
include 'koneksi.php';

// Mengambil semua data peminjaman dari fungsi di koneksi.php
$pinjam = getAllPinjam();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Peminjaman</h1>
        <a href="tambah_pinjam.php" class="btn btn-success mb-3">Tambah Peminjaman</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Peminjaman</th>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Penerbit</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Nama Petugas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $pinjam->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['pinjam_id']; ?></td>
                        <td><?= $row['peminjam_nama']; ?></td>
                        <td><?= $row['judul']; ?></td>
                        <td><?= $row['penerbit']; ?></td>
                        <td><?= $row['kategori']; ?></td>
                        <td><?= $row['jumlah']; ?></td>
                        <td><?= $row['petugas_nama']; ?></td>
                        <td>
                            <a href="edit_pinjam.php?id=<?= $row['pinjam_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_pinjam.php?id=<?= $row['pinjam_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
