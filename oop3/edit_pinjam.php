<?php
include 'koneksi.php';

$id = $_GET['id'];
$pinjam = getPinjamById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $peminjam_id = $_POST['peminjam_id'];
    $buku_id = $_POST['buku_id'];
    $jumlah = $_POST['jumlah'];
    $petugas_id = $_POST['petugas_id'];

    if (editPinjam($id, $peminjam_id, $buku_id, $jumlah, $petugas_id)) {
        header('Location: pinjam.php');
    } else {
        echo "Gagal mengedit peminjaman!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Peminjaman</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="peminjam_id" class="form-label">ID Peminjam</label>
                <input type="text" class="form-control" id="peminjam_id" name="peminjam_id" value="<?= $pinjam['peminjam_id']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="buku_id" class="form-label">ID Buku</label>
                <input type="text" class="form-control" id="buku_id" name="buku_id" value="<?= $pinjam['buku_id']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $pinjam['jumlah']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="petugas_id" class="form-label">ID Petugas</label>
                <input type="text" class="form-control" id="petugas_id" name="petugas_id" value="<?= $pinjam['petugas_id']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
