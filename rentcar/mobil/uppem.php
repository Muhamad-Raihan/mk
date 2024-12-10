<?php
include('../koneksi/koneksi.php');
$db = new database();

if (isset($_GET['id_pemilik'])) {
    $id_pemilik = $_GET['id_pemilik'];
    $result = $db->getPemilikMobilById($id_pemilik);
    $data = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_pemilik = $_POST['id_pemilik'];
    $nama = $_POST['nama'];
    $kode_mobil = $_POST['kode_mobil'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];
    $email = $_POST['email'];
    $rekening = $_POST['rekening'];

    $db->updatePemilikMobil($id_pemilik, $nama, $kode_mobil, $alamat, $kontak, $email, $rekening);
    header("Location: pemmobil.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pemilik Mobil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Update Pemilik Mobil</h2>

        <form method="post" action="">
            <input type="hidden" name="id_pemilik" value="<?php echo $data['id_pemilik']; ?>">

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $data['nama']; ?>" required>
            </div>

            <div class="form-group">
                <label for="kode_mobil">Kode Mobil</label>
                <input type="text" class="form-control" name="kode_mobil" value="<?php echo $data['kode_mobil']; ?>" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat']; ?>" required>
            </div>

            <div class="form-group">
                <label for="kontak">Kontak</label>
                <input type="text" class="form-control" name="kontak" value="<?php echo $data['kontak']; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="rekening">Rekening</label>
                <input type="text" class="form-control" name="rekening" value="<?php echo $data['rekening']; ?>" required>
            </div>

            <button type="submit" name="update" class="btn btn-success">Update Pemilik Mobil</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
