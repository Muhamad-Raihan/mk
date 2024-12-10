<?php
include('../koneksi/koneksi.php');
$db = new database();

// Check if id_pelanggan is provided in the URL and fetch the corresponding customer details
if (isset($_GET['id_pelanggan'])) {
    $id_pelanggan = $_GET['id_pelanggan'];
    $pelanggan = mysqli_fetch_assoc($db->getPelangganById($id_pelanggan));
}

// If the update form is submitted
if (isset($_POST['update'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $usnm = $_POST['usnm'];
    $pass = $_POST['pass'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];
    $email = $_POST['email'];

    // Update the pelanggan in the database
    $db->updatePelanggan($id_pelanggan, $usnm, $pass, $nama, $alamat, $kontak, $email);
    // Redirect to the pelanggan list page after updating
    header("Location: pelanggan.php");
    exit; // Prevent further code execution after redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pelanggan</title>
    <!-- Bootstrap CSS for improved styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Pelanggan</h2>

        <!-- Form to update pelanggan data -->
        <form method="post" action="">
            <input type="hidden" name="id_pelanggan" value="<?php echo $pelanggan['id_pelanggan']; ?>">
            
            <div class="form-group">
                <label for="usnm">Username</label>
                <input type="text" class="form-control" name="usnm" value="<?php echo $pelanggan['usnm']; ?>" required>
            </div>

            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" name="pass" value="<?php echo $pelanggan['pass']; ?>" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $pelanggan['nama']; ?>" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" value="<?php echo $pelanggan['alamat']; ?>" required>
            </div>

            <div class="form-group">
                <label for="kontak">Kontak</label>
                <input type="text" class="form-control" name="kontak" value="<?php echo $pelanggan['kontak']; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $pelanggan['email']; ?>" required>
            </div>

            <div class="form-group">
                <input type="submit" name="update" value="Update" class="btn btn-primary">
                <a href="pelanggan.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS & dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
