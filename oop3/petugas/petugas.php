<?php
include '../koneksi/koneksi.php';

// Inisialisasi database untuk petugas
$dbPetugas = new databasePetugas();
$dbPetugas->connectMySQL();

// Proses tambah, update, hapus petugas
if (isset($_GET['aksi'])) {
    // Tambah Petugas
    if ($_GET['aksi'] == 'tambah') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $password = $_POST['password'];
            $jk = $_POST['jk'];
            $ttl = $_POST['ttl'];
            $agama = $_POST['agama'];
            $telp = $_POST['telp'];
            $email = $_POST['email'];
            $alamat = $_POST['alamat'];
            $dbPetugas->tambahPetugas($nama, $password, $jk, $ttl, $agama, $telp, $email, $alamat);
            header("Location: petugas.php");
        } else {
            ?>
            <div class="container mt-5">
                <h2 class="text-center">Tambah Petugas</h2>
                <form method="POST" action="?aksi=tambah">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" id="jk" name="jk" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ttl" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="ttl" name="ttl" required>
                    </div>
                    <div class="mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <input type="text" class="form-control" id="agama" name="agama" required>
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telp" name="telp" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="petugas.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
            <?php
        }
    }
    // Hapus Petugas
    else if ($_GET['aksi'] == 'hapus') {
        $petugas_id = $_GET['id'];
        $dbPetugas->hapusPetugas($petugas_id);
        header("Location: petugas.php");
    }
    // Edit Petugas
    else if ($_GET['aksi'] == 'edit') {
        $petugas_id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
            $jk = $_POST['jk'];
            $ttl = $_POST['ttl'];
            $agama = $_POST['agama'];
            $telp = $_POST['telp'];
            $email = $_POST['email'];
            $alamat = $_POST['alamat'];
            $dbPetugas->updateDataPetugas($petugas_id, $nama, $password, $jk, $ttl, $agama, $telp, $email, $alamat);
            header("Location: petugas.php");
        } else {
            ?>
            <div class="container mt-5">
                <h2 class="text-center">Edit Petugas</h2>
                <form method="POST" action="?aksi=edit&id=<?= $petugas_id; ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $dbPetugas->bacaDataPetugas('nama', $petugas_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?= $dbPetugas->bacaDataPetugas('password', $petugas_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" id="jk" name="jk" required>
                            <option value="Laki-laki" <?= $dbPetugas->bacaDataPetugas('jk', $petugas_id) == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?= $dbPetugas->bacaDataPetugas('jk', $petugas_id) == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ttl" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="ttl" name="ttl" value="<?= $dbPetugas->bacaDataPetugas('ttl', $petugas_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <input type="text" class="form-control" id="agama" name="agama" value="<?= $dbPetugas->bacaDataPetugas('agama', $petugas_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telp" name="telp" value="<?= $dbPetugas->bacaDataPetugas('telp', $petugas_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $dbPetugas->bacaDataPetugas('email', $petugas_id); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" required><?= $dbPetugas->bacaDataPetugas('alamat', $petugas_id); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="petugas.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
            <?php
        }
    }
}

// Tampilkan Daftar Petugas
$petugas = $dbPetugas->tampilPetugas();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Petugas</title>
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Petugas</h1>
        <a href="?aksi=tambah" class="btn btn-success mb-3">Tambah Petugas</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Petugas</th>
                    <th>Nama</th>
                    <th>Password</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Agama</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($petugas) {
                    foreach ($petugas as $row) { ?>
                        <tr>
                            <td><?= $row['petugas_id']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['password']; ?></td>
                            <td><?= $row['jk']; ?></td>
                            <td><?= $row['ttl']; ?></td>
                            <td><?= $row['agama']; ?></td>
                            <td><?= $row['telp']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['alamat']; ?></td>
                        <td>
                            <a href="?aksi=edit&id=<?= $row['petugas_id']; ?>" class="btn btn-warning btn-primary">Edit</a>
                            <a href="?aksi=hapus&id=<?= $row['petugas_id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?');">Hapus</a>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="8" class="text-center">Belum ada data petugas</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
