<?php
include('../koneksi/koneksi.php');
$db = new database();

if (isset($_POST['submit'])) {
    $usnm = $_POST['usnm'];
    $pass = $_POST['pass'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];
    $email = $_POST['email'];

    $db->addPelanggan($usnm, $pass, $nama, $alamat, $kontak, $email);
    header("Location: pelanggan.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Tambah Pelanggan</h2>
        <form method="post" action="" class="border p-4 rounded shadow">
            <div class="mb-3">
                <label for="usnm" class="form-label">Username</label>
                <input type="text" class="form-control" id="usnm" name="usnm" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">Kontak</label>
                <input type="text" class="form-control" id="kontak" name="kontak" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="text-center">
                <input type="submit" name="submit" value="Tambah" class="btn btn-primary">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS & dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
