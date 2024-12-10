<?php
include('../koneksi/koneksi.php');
$db = new database();

// Check if id_sopir is provided in the URL and fetch the corresponding driver details
if (isset($_GET['id_sopir'])) {
    $id_sopir = $_GET['id_sopir'];
    $sopir = mysqli_fetch_assoc($db->getSopirById($id_sopir));
}

// If the update form is submitted
if (isset($_POST['update'])) {
    $id_sopir = $_POST['id_sopir'];
    $nama = $_POST['nama'];
    $kontak = $_POST['kontak'];
    $alamat = $_POST['alamat'];

    // Update the driver in the database
    $db->updateSopir($id_sopir, $nama, $kontak, $alamat);
    // Redirect to the sopir list page after updating
    header("Location: sopir.php");
    exit; // Prevent further code execution after redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Sopir</title>
    <!-- Bootstrap CSS for improved styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Sopir</h2>

        <!-- Form to update driver data -->
        <form method="post" action="">
            <input type="hidden" name="id_sopir" value="<?php echo $sopir['id_sopir']; ?>">
            
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $sopir['nama']; ?>" required>
            </div>

            <div class="form-group">
                <label for="kontak">Kontak</label>
                <input type="text" class="form-control" name="kontak" value="<?php echo $sopir['kontak']; ?>" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" value="<?php echo $sopir['alamat']; ?>" required>
            </div>

            <div class="form-group">
                <input type="submit" name="update" value="Update" class="btn btn-primary">
                <a href="sopir.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS & dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
