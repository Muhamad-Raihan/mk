<?php
include('../koneksi/koneksi.php');
$db = new database();

// Fetch transaction details by ID
if (isset($_GET['id_pesan'])) {
    $id_pesan = $_GET['id_pesan'];
    $pesan = mysqli_fetch_assoc($db->getPesanById($id_pesan));
}

// Handle update form submission
if (isset($_POST['update'])) {
    $id_pesan = $_POST['id_pesan'];
    $nama = $_POST['nama'];
    $kode_mobil = $_POST['kode_mobil'];
    $tanggal = $_POST['tanggal'];
    $durasi = $_POST['durasi'];
    $pembayaran = $_POST['pembayaran'];

    // Fetch tarif from the database based on kode_mobil
    $mobil_result = $db->getMobilByKode($kode_mobil); // Get mysqli_result object
    $mobil = mysqli_fetch_assoc($mobil_result); // Fetch data row as array
    $tarif = $mobil['tarif']; // Access tarif from array

    // Calculate total with additional 20%
    $total = $durasi * $tarif * 1.2;

    $db->updatePesan($nama, $id_pesan, $kode_mobil, $tanggal, $durasi, round($total), $pembayaran);
    header("Location: transaksi.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pemesanan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Function to calculate total
        function calculateTotal() {
            const durasi = parseFloat(document.querySelector("input[name='durasi']").value) || 0;
            const tarif = parseFloat(document.querySelector("select[name='kode_mobil']").selectedOptions[0].getAttribute("data-tarif")) || 0;
            const total = durasi * tarif * 1.2; // Calculate total with 20% additional charge
            document.querySelector("input[name='total']").value = Math.round(total); // Round off to remove decimals
        }

        // Event listener for changes in durasi or kode_mobil
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector("input[name='durasi']").addEventListener("input", calculateTotal);
            document.querySelector("select[name='kode_mobil']").addEventListener("change", calculateTotal);
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Update Pesanan</h2>

        <form method="post" action="">
            <!-- Hidden ID for the transaction -->
            <input type="hidden" name="id_pesan" value="<?php echo $pesan['id_pesan']; ?>">

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $pesan['nama']; ?>" required>
            </div>

            <!-- Kode Mobil -->
            <div class="form-group">
                <label for="kode_mobil">Kode Mobil</label>
                <select name="kode_mobil" class="form-control" required>
                    <?php
                    $mobil_result = $db->getAllMobil();
                    while ($row = mysqli_fetch_assoc($mobil_result)) {
                        $selected = $pesan['kode_mobil'] == $row['kode_mobil'] ? 'selected' : '';
                        echo "<option value='{$row['kode_mobil']}' data-tarif='{$row['tarif']}' $selected>{$row['kode_mobil']} - {$row['nama']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Tanggal -->
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?php echo $pesan['tanggal']; ?>" required>
            </div>

            <!-- Durasi -->
            <div class="form-group">
                <label for="durasi">Durasi</label>
                <input type="number" name="durasi" class="form-control" value="<?php echo $pesan['durasi']; ?>" required>
            </div>

            <!-- Total -->
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" name="total" class="form-control" value="<?php echo $pesan['total']; ?>" required readonly>
            </div>

            <!-- Pembayaran -->
            <div class="form-group">
                <label for="pembayaran">Pembayaran</label>
                <select name="pembayaran" class="form-control" required>
                    <option value="cash" <?php if ($pesan['pembayaran'] == 'cash') echo 'selected'; ?>>Cash</option>
                    <option value="kredit" <?php if ($pesan['pembayaran'] == 'kredit') echo 'selected'; ?>>Kredit</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="update" class="btn btn-primary btn-block">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
