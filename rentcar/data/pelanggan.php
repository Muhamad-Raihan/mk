<?php
include('../koneksi/koneksi.php');
$db = new database();

$result = $db->getAllPelanggan();

if (isset($_GET['delete'])) {
    $id_pelanggan = $_GET['delete'];
    $db->deletePelanggan($id_pelanggan);
    header("Location: pelanggan.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Daftar Pelanggan</h2>
        <a href="addpel.php" class="btn btn-success mb-3">Tambah Pelanggan</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kontak</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['usnm']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['kontak']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="uppel.php?id_pelanggan=<?php echo $row['id_pelanggan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="pelanggan.php?delete=<?php echo $row['id_pelanggan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS & dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
