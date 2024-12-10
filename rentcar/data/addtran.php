<?php
include('../koneksi/koneksi.php');
$db = new database();

if (isset($_POST['submit'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_pesan = $_POST['id_pesan'];
    $id_sopir = $_POST['id_sopir'];
    $status = $_POST['status'];

    $db->addTransaksi($id_pelanggan, $id_pesan, $id_sopir, $status);
    header("Location: transaksi.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Tambah Transaksi</h2>
        <form method="post" action="" class="border p-4 rounded shadow">
            <div class="mb-3">
                <label for="id_pelanggan" class="form-label">Nama Pelanggan</label>
                <select name="id_pelanggan" id="id_pelanggan" class="form-select" required>
                    <?php
                    $pelanggan_result = $db->getAllPelanggan();
                    while ($row = mysqli_fetch_assoc($pelanggan_result)) {
                        echo "<option value='{$row['id_pelanggan']}'>{$row['nama']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_pesan" class="form-label">ID Pesan</label>
                <select name="id_pesan" id="id_pesan" class="form-select" required>
                    <?php
                    $pesan_result = $db->getAllPesan();
                    while ($row = mysqli_fetch_assoc($pesan_result)) {
                        echo "<option value='{$row['id_pesan']}'>{$row['id_pesan']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_sopir" class="form-label">ID Sopir</label>
                <select name="id_sopir" id="id_sopir" class="form-select">
                    <option value="">Tanpa Sopir</option>
                    <?php
                    $sopir_result = $db->getAllSopir();
                    while ($row = mysqli_fetch_assoc($sopir_result)) {
                        echo "<option value='{$row['id_sopir']}'>{$row['id_sopir']} - {$row['nama']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="diproses">Diproses</option>
                    <option value="selesai">Selesai</option>
                    <option value="batal">Batal</option>
                </select>
            </div>

            <div class="text-center">
                <input type="submit" name="submit" value="Tambah" class="btn btn-primary">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS & dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
