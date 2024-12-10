<?php
include('../koneksi/koneksi.php');
$db = new database();

$result = $db->getAllAdmin();

if (isset($_GET['delete'])) {
    $id_admin = $_GET['delete'];
    $db->deleteAdmin($id_admin);
    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Daftar Admin</h2>
        <div class="text-end mb-3">
            <a href="addadm.php" class="btn btn-success">Tambah Admin</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['usnm']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['kontak']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td>
                            <a href="upadm.php?id_admin=<?php echo $row['id_admin']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="admin.php?delete=<?php echo $row['id_admin']; ?>" onclick="return confirm('Yakin ingin menghapus?');" class="btn btn-danger btn-sm">Delete</a>
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
