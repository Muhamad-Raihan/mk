<?php
include '../koneksi/koneksi.php';

// Inisialisasi database
$db = new database();
$db->connectMySQL();

// Proses tambah, update, hapus buku
if (isset($_GET['aksi'])) {
    // Tambah Buku
    if ($_GET['aksi'] == 'tambah') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $isbn = $_POST['isbn'];
            $judul = $_POST['judul'];
            $kategori = $_POST['kategori'];
            $penerbit = $_POST['penerbit'];
            $stok = $_POST['stok'];
            $db->tambahBuku($isbn, $judul, $kategori, $penerbit, $stok);
            header("Location: buku.php");
        } else {
            ?>
            <div class="container mt-5">
                <h2 class="text-center">Tambah Buku</h2>
                <form method="POST" action="?aksi=tambah">
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" required>
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" required>
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="buku.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
            <?php
        }
    }
    // Hapus Buku
    else if ($_GET['aksi'] == 'hapus') {
        $buku_id = $_GET['id'];
        $db->hapusBuku($buku_id);
        header("Location: buku.php");
    }
    // Edit Buku
    else if ($_GET['aksi'] == 'edit') {
        $buku_id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $isbn = $_POST['isbn']; 
            $judul = $_POST['judul'];
            $kategori = $_POST['kategori'];
            $penerbit = $_POST['penerbit'];
            $stok = $_POST['stok'];
            $db->updateDataBuku($buku_id, $isbn, $judul, $kategori, $penerbit, $stok);
            header("Location: buku.php");
        } else {
            ?>
            <div class="container mt-5">
                <h2 class="text-center">Edit Buku</h2>
                <form method="POST" action="?aksi=edit&id=<?= $buku_id; ?>">
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" value="<?= $db->bacaDataBuku('isbn', $buku_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="<?= $db->bacaDataBuku('judul', $buku_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $db->bacaDataBuku('kategori', $buku_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $db->bacaDataBuku('penerbit', $buku_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="<?= $db->bacaDataBuku('stok', $buku_id); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="buku.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
            <?php
        }
    }
}

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
        <a href="?aksi=tambah" class="btn btn-success mb-3">Tambah Buku</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Buku</th>
                    <th>ISBN</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penerbit</th>
                    <th>Stok</th>
                    <th>Aksi</th>
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
                            <td>
                                <a href="?aksi=edit&id=<?= $row['buku_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?aksi=hapus&id=<?= $row['buku_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</a>
                            </td>
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
