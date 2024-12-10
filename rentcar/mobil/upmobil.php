<?php
include('../koneksi/koneksi.php');
$db = new database();

if (isset($_GET['kode_mobil'])) {
    $kode_mobil = $_GET['kode_mobil'];
    $result = $db->getMobilByKode($kode_mobil);
    $data = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $kode_mobil = $_POST['kode_mobil'];
    $nama = $_POST['nama'];
    $tarif = $_POST['tarif'];
    $status = $_POST['status'];
    
    // Handling file upload for foto update
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto_name = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_path = 'uploads/' . $foto_name;
        move_uploaded_file($foto_tmp, $foto_path);
    } else {
        $foto_path = $data['foto'];
    }

    $db->updateMobil($kode_mobil, $nama, $tarif, $status, $foto_path);
    header("Location: mobil.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Mobil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Update Mobil</h2>

        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="kode_mobil" value="<?php echo $data['kode_mobil']; ?>">

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $data['nama']; ?>" required>
            </div>

            <div class="form-group">
                <label for="tarif">Tarif</label>
                <input type="number" class="form-control" name="tarif" value="<?php echo $data['tarif']; ?>" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status">
                    <option value="tersedia" <?php if($data['status'] == 'tersedia') echo 'selected'; ?>>Tersedia</option>
                    <option value="disewa" <?php if($data['status'] == 'disewa') echo 'selected'; ?>>Disewa</option>
                    <option value="perawatan" <?php if($data['status'] == 'perawatan') echo 'selected'; ?>>Perawatan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control-file" name="foto" accept="image/*">
            </div>

            <?php if($data['foto']) { ?>
                <div class="form-group">
                    <label>Foto Mobil Saat Ini</label><br>
                    <img src="<?php echo $data['foto']; ?>" alt="Foto Mobil" width="150"><br><br>
                </div>
            <?php } ?>

            <button type="submit" name="update" class="btn btn-success">Update Mobil</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
