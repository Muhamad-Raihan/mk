<?php
include('../koneksi/koneksi.php');
$db = new database();

$result = $db->getAllSopir();

if (isset($_GET['delete'])) {
    $id_sopir = $_GET['delete'];
    $db->deleteSopir($id_sopir);
    header("Location: sopir.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sopir</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Daftar Sopir</h2>
        <a href="addsopir.php" class="btn btn-success mb-3">Tambah Sopir</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['kontak']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td>
                        <a href="upsopir.php?id_sopir=<?php echo $row['id_sopir']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="sopir.php?delete=<?php echo $row['id_sopir']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Delete</a>
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
