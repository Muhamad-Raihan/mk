<?php
include('../koneksi/koneksi.php');
$db = new database();

// Fetch admin details by ID
if (isset($_GET['id_admin'])) {
    $id_admin = $_GET['id_admin'];
    $admin = mysqli_fetch_assoc($db->getAdminById($id_admin));
}

// Handle update form submission
if (isset($_POST['update'])) {
    $id_admin = $_POST['id_admin'];
    $usnm = $_POST['usnm'];
    $pass = !empty($_POST['pass']) ? $_POST['pass'] : $admin['pass']; // Update password only if provided
    $nama = $_POST['nama'];
    $kontak = $_POST['kontak'];
    $alamat = $_POST['alamat'];

    $db->updateAdmin($id_admin, $usnm, $pass, $nama, $kontak, $alamat);
    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Admin</h2>
        <form method="post" action="" class="border p-4 rounded shadow">
            <input type="hidden" name="id_admin" value="<?php echo $admin['id_admin']; ?>">
            <div class="mb-3">
                <label for="usnm" class="form-label">Username</label>
                <input type="text" class="form-control" id="usnm" name="usnm" value="<?php echo $admin['usnm']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password (leave blank to keep current)</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $admin['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">Kontak</label>
                <input type="text" class="form-control" id="kontak" name="kontak" value="<?php echo $admin['kontak']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $admin['alamat']; ?>" required>
            </div>
            <div class="text-center">
                <input type="submit" name="update" value="Update" class="btn btn-primary">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS & dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
