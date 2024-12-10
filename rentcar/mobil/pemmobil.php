<?php
include('../koneksi/koneksi.php');
$db = new database();

$result = $db->getAllPemilikMobil();

if (isset($_GET['delete'])) {
    $id_pemilik = $_GET['delete'];
    $db->deletePemilikMobil($id_pemilik);
    header("Location: pemmobil.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pemilik Mobil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Daftar Pemilik Mobil</h2>

        <a href="addpem.php" class="btn btn-primary mb-3">Tambah Pemilik Mobil</a>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>Kode Mobil</th>
                    <th>Alamat</th>
                    <th>Kontak</th>
                    <th>Email</th>
                    <th>Rekening</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['kode_mobil']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['kontak']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['rekening']; ?></td>
                        <td>
                            <a href="uppem.php?id_pemilik=<?php echo $row['id_pemilik']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="pemmobil.php?delete=<?php echo $row['id_pemilik']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Delete</a>
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
