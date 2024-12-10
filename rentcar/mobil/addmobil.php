<?php
include('../koneksi/koneksi.php');
$db = new database();

if (isset($_POST['submit'])) {
    $kode_mobil = $_POST['kode_mobil'];
    $nama = $_POST['nama'];
    $tarif = $_POST['tarif'];
    $status = $_POST['status'];
    
    // Handling file upload for foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto_name = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_path = 'uploads/' . $foto_name;
        move_uploaded_file($foto_tmp, $foto_path);
    } else {
        $foto_path = null;
    }

    $db->addMobil($kode_mobil, $nama, $tarif, $status, $foto_path);
    header("Location: mobil.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mobil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Tambah Mobil</h2>

        <!-- Form to add a car -->
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="kode_mobil">Kode Mobil</label>
                <input type="text" class="form-control" name="kode_mobil" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" required>
            </div>

            <div class="form-group">
                <label for="tarif">Tarif</label>
                <input type="number" class="form-control" name="tarif" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status">
                    <option value="tersedia">Tersedia</option>
                    <option value="disewa">Disewa</option>
                    <option value="perawatan">Perawatan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control-file" name="foto" accept="image/*">
            </div>

            <button type="submit" name="submit" class="btn btn-primary btn-block">Tambah</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
