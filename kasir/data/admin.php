<?php
include '../koneksi/koneksi.php';
$database = new database;
$dataAdmin = $database->readAdmin();

if(isset($_GET['delete'])) {
    $usnm = $_GET['delete'];
    $database->deleteAdmin($usnm);
    header("Location: admin.php");
    exit();
}

$database->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Data Admin</h1>
    <a href="addadm.php" class="btn btn-success mb-3">Tambah Admin</a>
    
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Fitur</th>
            </tr>
        </thead>
        <tbody>
            <?php while($admin = $dataAdmin->fetch_assoc()): ?>
                <tr>
                    <td><?= $admin['usnm'] ?></td>
                    <td><?= $admin['pass'] ?></td>
                    <td>
                        <a href="uppadm.php?usnm=<?= $admin['usnm'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="admin.php?delete=<?= $admin['usnm'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
