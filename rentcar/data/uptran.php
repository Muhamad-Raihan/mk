<?php
include('../koneksi/koneksi.php');
$db = new database();

// Fetch transaction details by ID
if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];
    $transaksi = mysqli_fetch_assoc($db->getTransaksiById($id_transaksi));
}

// Handle update form submission
if (isset($_POST['update'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_pesan = $_POST['id_pesan'];
    $id_sopir = $_POST['id_sopir'];
    $status = $_POST['status'];

    // Update transaction in the database
    $db->updateTransaksi($id_transaksi, $id_pelanggan, $id_pesan, $id_sopir, $status);
    header("Location: transaksi.php");
    exit; // Prevent further execution after redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Transaksi</title>
    <!-- Bootstrap CSS for improved styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Transaksi</h2>

        <!-- Form to update transaction -->
        <form method="post" action="">
            <input type="hidden" name="id_transaksi" value="<?php echo $transaksi['id_transaksi']; ?>">

            <!-- Select Pelanggan (Customer) -->
            <div class="form-group">
                <label for="id_pelanggan">Nama Pelanggan</label>
                <select class="form-control" name="id_pelanggan" required>
                    <?php
                    $pelanggan_result = $db->getAllPelanggan();
                    while ($row = mysqli_fetch_assoc($pelanggan_result)) {
                        $selected = $transaksi['id_pelanggan'] == $row['id_pelanggan'] ? 'selected' : '';
                        echo "<option value='{$row['id_pelanggan']}' $selected>{$row['nama']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Select Pesan (Order) -->
            <div class="form-group">
                <label for="id_pesan">ID Pesan</label>
                <select class="form-control" name="id_pesan" required>
                    <?php
                    $pesan_result = $db->getAllPesan();
                    while ($row = mysqli_fetch_assoc($pesan_result)) {
                        $selected = $transaksi['id_pesan'] == $row['id_pesan'] ? 'selected' : '';
                        echo "<option value='{$row['id_pesan']}' $selected>{$row['id_pesan']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Select Sopir (Driver) -->
            <div class="form-group">
                <label for="id_sopir">Nama Sopir</label>
                <select class="form-control" name="id_sopir">
                    <option value="">Tanpa Sopir</option>
                    <?php
                    $sopir_result = $db->getAllSopir();
                    while ($row = mysqli_fetch_assoc($sopir_result)) {
                        $selected = $transaksi['id_sopir'] == $row['id_sopir'] ? 'selected' : '';
                        echo "<option value='{$row['id_sopir']}' $selected>{$row['nama']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Select Status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" required>
                    <option value="diproses" <?php if ($transaksi['status'] == 'diproses') echo 'selected'; ?>>Diproses</option>
                    <option value="selesai" <?php if ($transaksi['status'] == 'selesai') echo 'selected'; ?>>Selesai</option>
                    <option value="batal" <?php if ($transaksi['status'] == 'batal') echo 'selected'; ?>>Batal</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" name="update" class="btn btn-primary">Update</button>
                <a href="transaksi.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS & dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
