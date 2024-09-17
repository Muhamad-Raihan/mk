<?php
include 'koneksi.php';

$id = $_GET['id'];
$buku = getBukuById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $penerbit = $_POST['penerbit'];
    $stok = $_POST['stok'];

    // Panggil fungsi editBuku dari koneksi.php
    if (editBuku($id, $judul, $kategori, $penerbit, $stok)) {
        header('Location: index.php');
    } else {
        echo "Error: Gagal mengedit buku.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Buku</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?= $buku['judul']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $buku['kategori']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $buku['penerbit']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?= $buku['stok']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
