<?php
include '../koneksi/koneksi.php';

// Inisialisasi database
$db = new database();
$db->connectMySQL();

// Tampilkan Daftar Buku
$buku = $db->tampilBuku();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Buku</h1><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Buku</th>
                    <th>ISBN</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penerbit</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($buku) {
                    foreach ($buku as $row) { ?>
                        <tr>
                            <td><?= $row['buku_id']; ?></td>
                            <td><?= $row['isbn']; ?></td>
                            <td><?= $row['judul']; ?></td>
                            <td><?= $row['kategori']; ?></td>
                            <td><?= $row['penerbit']; ?></td>
                            <td><?= $row['stok']; ?></td>
                        </tr>
                    <?php }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data buku</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
