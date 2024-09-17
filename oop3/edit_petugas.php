<?php
include 'koneksi.php';

$id = $_GET['id'];
$petugas = getPetugasById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $ttl = $_POST['ttl'];
    $agama = $_POST['agama'];

    // Panggil fungsi editPetugas dari koneksi.php
    if (editPetugas($id, $nama, $jk, $ttl, $agama)) {
        header('Location: petugas.php');
    } else {
        echo "Error: Gagal mengedit petugas.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Petugas</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $petugas['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jk" class="form-label">Jenis Kelamin</label>
                <input type="text" class="form-control" id="jk" name="jk" value="<?= $petugas['jk']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="ttl" class="form-label">Tanggal Lahir</label>
                <input type="text" class="form-control" id="ttl" name="ttl" value="<?= $petugas['ttl']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="agama" class="form-label">Agama</label>
                <input type="text" class="form-control" id="agama" name="agama" value="<?= $petugas['agama']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
