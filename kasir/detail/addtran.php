<?php
include '../koneksi/koneksi.php';
$database = new database;
$koneksi = $database->kon;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pelanggan_id = $_POST['pelanggan_id'];
    $total_harga = 0;

    // Masukkan data ke tabel penjualan
    $insert_penjualan = "INSERT INTO penjualan (pelanggan_id, tgl_penjualan, total_harga) 
                         VALUES ('$pelanggan_id', NOW(), 0)";
    mysqli_query($koneksi, $insert_penjualan);

    // Ambil id penjualan yang baru dimasukkan
    $penjualan_id = mysqli_insert_id($koneksi);

    // Proses setiap produk yang ditambahkan
    foreach ($_POST['produk_id'] as $index => $produk_id) {
        $jumlah_produk = $_POST['jumlah_produk'][$index];

        // Ambil harga produk dan stok untuk menghitung subtotal dan update stok
        $result_produk = mysqli_query($koneksi, "SELECT harga, stok FROM produk WHERE produk_id = '$produk_id'");
        $produk = mysqli_fetch_assoc($result_produk);
        $harga = $produk['harga'];
        $stok = $produk['stok'];

        // Cek apakah stok cukup untuk jumlah yang dibeli
        if ($stok >= $jumlah_produk) {
            $subtotal = $jumlah_produk * $harga;

            // Masukkan data ke tabel detailpenjualan
            $insert_detail = "INSERT INTO detailpenjualan (penjualan_id, produk_id, jumlah_produk, subtotal) 
                              VALUES ('$penjualan_id', '$produk_id', '$jumlah_produk', '$subtotal')";
            mysqli_query($koneksi, $insert_detail);

            // Tambahkan subtotal ke total_harga
            $total_harga += $subtotal;

            // Kurangi stok produk
            $stok_baru = $stok - $jumlah_produk;
            $update_stok = "UPDATE produk SET stok = '$stok_baru' WHERE produk_id = '$produk_id'";
            mysqli_query($koneksi, $update_stok);
        } else {
            echo "Stok tidak cukup untuk produk: " . $produk_id;
            exit;
        }
    }

    // Update total harga di tabel penjualan
    $update_penjualan = "UPDATE penjualan SET total_harga = '$total_harga' WHERE penjualan_id = '$penjualan_id'";
    mysqli_query($koneksi, $update_penjualan);

    header("Location: transaksi.php");
}
?>

<!-- Tambahkan Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2>Tambah Transaksi</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="pelanggan_id">Pelanggan:</label>
            <select name="pelanggan_id" class="form-control" id="pelanggan_id">
                <?php
                $pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                while($row = mysqli_fetch_assoc($pelanggan)) {
                    echo "<option value='".$row['pelanggan_id']."'>".$row['nama_pelanggan']."</option>";
                }
                ?>
            </select>
        </div>

        <div id="produk-list">
            <div class="form-group row produk-item">
                <div class="col-md-8">
                    <label for="produk_id">Produk:</label>
                    <select name="produk_id[]" class="form-control">
                        <?php
                        $produk = mysqli_query($koneksi, "SELECT * FROM produk");
                        while($row = mysqli_fetch_assoc($produk)) {
                            echo "<option value='".$row['produk_id']."'>".$row['nama_produk']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="jumlah_produk">Jumlah:</label>
                    <input type="number" name="jumlah_produk[]" class="form-control" required>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" onclick="tambahProduk()">Tambah Produk</button>
        <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
    </form>
</div>

<!-- Bootstrap JS, Popper.js, dan jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
function tambahProduk() {
    var produkList = document.getElementById('produk-list');
    var newProdukItem = document.createElement('div');
    newProdukItem.classList.add('form-group', 'row', 'produk-item');
    newProdukItem.innerHTML = `
        <div class="col-md-8">
            <label for="produk_id">Produk:</label>
            <select name="produk_id[]" class="form-control">
                <?php
                $produk = mysqli_query($koneksi, "SELECT * FROM produk");
                while($row = mysqli_fetch_assoc($produk)) {
                    echo "<option value='".$row['produk_id']."'>".$row['nama_produk']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="jumlah_produk">Jumlah:</label>
            <input type="number" name="jumlah_produk[]" class="form-control" required>
        </div>
    `;
    produkList.appendChild(newProdukItem);
}
</script>
