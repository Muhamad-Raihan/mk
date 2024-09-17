<?php
include 'koneksi.php';
$petugas = getAllPetugas();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Petugas</h1>
        <a href="tambah_petugas.php" class="btn btn-success mb-3">Tambah Petugas</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Agama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $petugas->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['petugas_id']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['jk']; ?></td>
                        <td><?= $row['ttl']; ?></td>
                        <td><?= $row['agama']; ?></td>
                        <td>
                            <a href="edit_petugas.php?id=<?= $row['petugas_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_petugas.php?id=<?= $row['petugas_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus petugas ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
