<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $lama_pinjam = $_POST['lama_pinjam'];
    $status = $_POST['status'];
    $telp = $_POST['telp'];

    if (tambahPeminjam($nama, $tgl_pinjam, $lama_pinjam, $status, $telp)) {
        header('Location: peminjam.php');
    } else {
        echo "Error: Gagal menambah peminjam.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Peminjam</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" required>
            </div>
            <div class="mb-3">
                <label for="lama_pinjam" class="form-label">Lama Pinjam</label>
                <input type="number" class="form-control" id="lama_pinjam" name="lama_pinjam" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" required>
            </div>
            <div class="mb-3">
                <label for="telp" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telp" name="telp" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</body>
</html>
