<?php
include '../koneksi/koneksi.php';

// Inisialisasi database untuk peminjam
$dbPeminjam = new databasePeminjam();
$dbPeminjam->connectMySQL();

// Proses tambah, update, hapus peminjam
if (isset($_GET['aksi'])) {
    // Tambah Peminjam
    if ($_GET['aksi'] == 'tambah') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $password = $_POST['password'];
            $telp = $_POST['telp'];
            $email = $_POST['email'];
            $alamat = $_POST['alamat'];
            $dbPeminjam->tambahPeminjam($nama, $password, $telp, $email, $alamat);
            header("Location: peminjam.php");
        } else {
            ?>
            <div class="container mt-5">
                <h2 class="text-center">Tambah Peminjam</h2>
                <form method="POST" action="?aksi=tambah">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="form-label">Telepon</label>
                        <input type="number" class="form-control" id="telp" name="telp" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="peminjam.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
            <?php
        }
    }
    // Hapus Peminjam
    else if ($_GET['aksi'] == 'hapus') {
        $peminjam_id = $_GET['id'];
        $dbPeminjam->hapusPeminjam($peminjam_id);
        header("Location: peminjam.php");
    }
    // Edit Peminjam
    else if ($_GET['aksi'] == 'edit') {
        $peminjam_id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $password = $_POST['password'];
            $telp = $_POST['telp'];
            $email = $_POST['email'];
            $alamat = $_POST['alamat'];
            $dbPeminjam->updateDataPeminjam($peminjam_id, $nama, $password, $telp, $email, $alamat);
            header("Location: peminjam.php");
        } else {
            ?>
            <div class="container mt-5">
                <h2 class="text-center">Edit Peminjam</h2>
                <form method="POST" action="?aksi=edit&id=<?= $peminjam_id; ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $dbPeminjam->bacaDataPeminjam('nama', $peminjam_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" value="<?= $dbPeminjam->bacaDataPeminjam('password', $peminjam_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="form-label">Telepon</label>
                        <input type="number" class="form-control" id="telp" name="telp" value="<?= $dbPeminjam->bacaDataPeminjam('telp', $peminjam_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $dbPeminjam->bacaDataPeminjam('email', $peminjam_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $dbPeminjam->bacaDataPeminjam('alamat', $peminjam_id); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="peminjam.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
            <?php
        }
    }
}

// Tampilkan Daftar Peminjam
$peminjam = $dbPeminjam->tampilPeminjam();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjam</title>
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Peminjam</h1>
        <a href="?aksi=tambah" class="btn btn-success mb-3">Tambah Peminjam</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Peminjam</th>
                    <th>Nama</th>
                    <th>Password</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($peminjam) {
                    foreach ($peminjam as $row) { ?>
                        <tr>
                            <td><?= $row['peminjam_id']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['password']; ?></td>
                            <td><?= $row['telp']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['alamat']; ?></td>
                            <td>
                                <a href="?aksi=edit&id=<?= $row['peminjam_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?aksi=hapus&id=<?= $row['peminjam_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus peminjam ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Tidak ada data peminjam</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
