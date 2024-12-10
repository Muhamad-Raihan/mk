<?php
include('../koneksi/koneksi.php');
$db = new database();

$result = $db->getAllMobil();

if (isset($_GET['delete'])) {
    $kode_mobil = $_GET['delete'];
    $db->deleteMobil($kode_mobil);
    header("Location: mobil.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mobil</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                <?php if($row['foto']) { ?>
                    <img src="../mobil/<?php echo $row['foto']; ?>" alt="Foto Mobil" class="card-img-top" width="100">
                <?php } else { ?>
                    No Photo
                <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['nama']; ?></h5>
                        <p class="card-text">
                            <strong>Kode Mobil:</strong> <?php echo $row['kode_mobil']; ?><br>
                            <strong>Tarif:</strong> <?php echo $row['tarif']; ?><br>
                            <strong>Status:</strong> <?php echo $row['status']; ?>
                        </p>
                        <a href="addpesan.php" class="btn btn-success">Pesan</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- Tambahkan Bootstrap JS dan dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
