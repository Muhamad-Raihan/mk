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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mobil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Daftar Mobil</h2>

        <a href="addmobil.php" class="btn btn-primary mb-3">Tambah Mobil</a>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Kode Mobil</th>
                    <th>Nama</th>
                    <th>Tarif</th>
                    <th>Status</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['kode_mobil']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['tarif']; ?></td>
                        <td><?php echo ucfirst($row['status']); ?></td>
                        <td>
                            <?php if($row['foto']) { ?>
                                <img src="<?php echo $row['foto']; ?>" alt="Foto Mobil" width="100" class="img-fluid">
                            <?php } else { ?>
                                No Photo
                            <?php } ?>
                        </td>
                        <td>
                            <a href="upmobil.php?kode_mobil=<?php echo $row['kode_mobil']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="mobil.php?delete=<?php echo $row['kode_mobil']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
