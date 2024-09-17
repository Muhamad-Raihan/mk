<?php
include 'koneksi.php';

// Mengambil semua buku dari fungsi di koneksi.php
$buku = getAllBuku();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Buku</h1>
        <a href="tambah.php" class="btn btn-success mb-3">Tambah Buku</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Buku</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penerbit</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $buku->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['buku_id']; ?></td>
                        <td><?= $row['judul']; ?></td>
                        <td><?= $row['kategori']; ?></td>
                        <td><?= $row['penerbit']; ?></td>
                        <td><?= $row['stok']; ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['buku_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus.php?id=<?= $row['buku_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
