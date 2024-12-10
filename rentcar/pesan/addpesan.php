<?php
include('../koneksi/koneksi.php');
$db = new database();

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kode_mobil = $_POST['kode_mobil'];
    $tanggal = $_POST['tanggal'];
    $durasi = $_POST['durasi'];
    $pembayaran = $_POST['pembayaran'];

    $mobil_result = $db->getMobilByKode($kode_mobil); // Get mysqli_result object
    $mobil = mysqli_fetch_assoc($mobil_result); // Fetch data row as array
    $tarif = $mobil['tarif']; // Access tarif from array

    // Calculate total with an additional 20%
    $total = $durasi * $tarif * 1.2;

    $db->addPesan($nama, $kode_mobil, $tanggal, $durasi, round($total), $pembayaran); // Add transaction
    header("Location: sukses.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
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
        <h2 class="mb-4 text-center">Tambah Transaksi</h2>

        <form method="post" action="">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <!-- Kode Mobil -->
            <div class="form-group">
                <label for="kode_mobil">Kode Mobil</label>
                <select name="kode_mobil" class="form-control" required>
                    <?php
                    $mobil_result = $db->getAllMobil();
                    while ($row = mysqli_fetch_assoc($mobil_result)) {
                        echo "<option value='{$row['kode_mobil']}' data-tarif='{$row['tarif']}'>{$row['kode_mobil']} - {$row['nama']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Tanggal -->
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <!-- Durasi -->
            <div class="form-group">
                <label for="durasi">Durasi</label>
                <input type="number" name="durasi" class="form-control" required>
            </div>

            <!-- Total -->
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" name="total" class="form-control" readonly required>
            </div>

            <!-- Pembayaran -->
            <div class="form-group">
                <label for="pembayaran">Pembayaran</label>
                <select name="pembayaran" class="form-control" required>
                    <option value="cash">Cash</option>
                    <option value="kredit">Kredit</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="submit" class="btn btn-success btn-block">Tambah Transaksi</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
