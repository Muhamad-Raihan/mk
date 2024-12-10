<?php
include '../koneksi/koneksi.php';

// Inisialisasi database untuk pinjam
$dbPinjam = new databasePinjam();
$dbPinjam->connectMySQL();

// Proses tambah, update, hapus data pinjam
if (isset($_GET['aksi'])) {
    // Tambah Pinjam
    if ($_GET['aksi'] == 'tambah') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $buku_id = $_POST['buku_id'];
            $peminjam_id = $_POST['peminjam_id'];
            $jumlah = $_POST['jumlah'];
            $tgl_pinjam = $_POST['tgl_pinjam'];
            $tgl_kembali = $_POST['tgl_kembali'];
            $petugas_id = $_POST['petugas_id'];
            $dbPinjam->tambahPinjam($buku_id, $peminjam_id, $jumlah, $tgl_pinjam, $tgl_kembali, $petugas_id);
            header("Location: pinjam.php");
        } else {
            ?>
            <div class="container mt-5">
                <h2 class="text-center">Tambah Data Peminjaman</h2>
                <form method="POST" action="?aksi=tambah">
                    <div class="mb-3">
                        <label for="buku_id" class="form-label">ID Buku</label>
                        <input type="text" class="form-control" id="buku_id" name="buku_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="peminjam_id" class="form-label">Kode Member</label>
                        <input type="text" class="form-control" id="peminjam_id" name="peminjam_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_kembali" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required>
                    </div>
                    <div class="mb-3">
                        <label for="petugas_id" class="form-label">ID Petugas</label>
                        <input type="text" class="form-control" id="petugas_id" name="petugas_id" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="pinjam.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
            <?php
        }
    }
    // Hapus Pinjam
    else if ($_GET['aksi'] == 'hapus') {
        $pinjam_id = $_GET['id'];
        $dbPinjam->hapusPinjam($pinjam_id);
        header("Location: pinjam.php");
    }
    // Edit Pinjam
    else if ($_GET['aksi'] == 'edit') {
        $pinjam_id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $buku_id = $_POST['buku_id'];
            $peminjam_id = $_POST['peminjam_id'];
            $jumlah = $_POST['jumlah'];
            $tgl_pinjam = $_POST['tgl_pinjam'];
            $tgl_kembali = $_POST['tgl_kembali'];
            $petugas_id = $_POST['petugas_id'];
            $dbPinjam->updateDataPinjam($pinjam_id, $buku_id, $peminjam_id, $jumlah, $tgl_pinjam, $tgl_kembali, $petugas_id);
            header("Location: pinjam.php");
        } else {
            ?>
            <div class="container mt-5">
                <h2 class="text-center">Edit Data Peminjaman</h2>
                <form method="POST" action="?aksi=edit&id=<?= $pinjam_id; ?>">
                    <div class="mb-3">
                        <label for="buku_id" class="form-label">ID Buku</label>
                        <input type="text" class="form-control" id="buku_id" name="buku_id" value="<?= $dbPinjam->bacaDataPinjam('buku_id', $pinjam_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="peminjam_id" class="form-label">Kode Member</label>
                        <input type="text" class="form-control" id="peminjam_id" name="peminjam_id" value="<?= $dbPinjam->bacaDataPinjam('peminjam_id', $pinjam_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $dbPinjam->bacaDataPinjam('jumlah', $pinjam_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="<?= $dbPetugas->bacaDataPetugas('tgl_pinjam', $petugas_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_kembali" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" value="<?= $dbPetugas->bacaDataPetugas('tgl_kembali', $petugas_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="petugas_id" class="form-label">ID Petugas</label>
                        <input type="text" class="form-control" id="petugas_id" name="petugas_id" value="<?= $dbPinjam->bacaDataPinjam('petugas_id', $pinjam_id); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="pinjam.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
            <?php
        }
    }
}

// Tampilkan Daftar Peminjaman
$pinjam = $dbPinjam->tampilPinjam();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman</title>
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Peminjaman</h1>
        <a href="?aksi=tambah" class="btn btn-success mb-3">Tambah Peminjaman</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Peminjaman</th>
                    <th>ID Buku</th>
                    <th>ID Peminjam</th>
                    <th>Jumlah</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>ID Petugas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($pinjam) {
                    foreach ($pinjam as $row) { ?>
                        <tr>
                            <td><?= $row['pinjam_id']; ?></td>
                            <td><?= $row['buku_id']; ?></td>
                            <td><?= $row['peminjam_id']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                            <td><?= $row['tgl_pinjam']; ?></td>
                            <td><?= $row['tgl_kembali']; ?></td>
                            <td><?= $row['petugas_id']; ?></td>
                            <td>
                                <a href="?aksi=edit&id=<?= $row['pinjam_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?aksi=hapus&id=<?= $row['pinjam_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data peminjaman</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
