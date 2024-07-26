<?php
//memanggil file koneksi
include 'koneksi_class.php';
//instance objek db
$db = new databasePinjam();
//koneksi ke MySQL via method
$db->connectMySQL();
echo "<br> <a href='buku.php'>Cek Daftar Buku</a>";
echo "<br> <a href='index.php'>Lihat Daftar Pustakawan</a><br>";
//proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        //baca ID dari parameter ID anggota yang akan dihapus
        $id = $_GET['id_buku'];
        //proses hapus data anggota berdasarkan ID via method
        $db->hapusPinjam($id);
    }
    else if ($_GET['aksi'] == 'tambah') {
        echo"<br>
        <form method=POST action='?aksi=tambahPinjam'>
        <table>
        <tr><td>Nama Peminjam</td><td><input type=text name='nama'></td></tr>
        <tr><td>Judul Buku</td><td><input type=text name='judul'></td></tr>
        <tr><td>Tanggal Peminjaman</td><td><input type=date name='pinjam'></td></tr>
        <tr><td>Tanggal Pengembalian</td><td><input type=date name='balik'></td></tr>
        <tr><td></td><td><input type=submit value='simpan'></td></tr>
        </table>
        </form>";
    }
    else if ($_GET['aksi'] == 'tambahPinjam') {
        $nama = $_POST['nama'];
        $judul = $_POST['judul'];
        $pinjam = $_POST['pinjam'];
        $balik = $_POST['balik'];
        $db->tambahPinjam($nama, $judul, $pinjam, $balik);
    }
    //proses update data
    else if ($_GET['aksi'] == 'edit')
    {
        //baca ID anggota yang akan diedit
        $id = $_GET['id_buku'];
        //menampilkan form edit anggota pakai method bacaDataAnggota()
?>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?> ?aksi=update">
            <table>
                <tr><td>Nama Peminjam</td><td>:</td><td><input type="text" name="nama" value="<?php echo $db->bacaDataPinjam('nama', $id); ?>"></td></tr>
                <tr><td>Judul Buku</td><td>:</td><td><input type="text" name="judul" value="<?php echo $db->bacaDataPinjam('judul', $id); ?>"></td></tr>
                <tr><td>Tanggal Pinjam</td><td>:</td><td><input type="date" name="pinjam" value="<?php echo $db->bacaDataPinjam('pinjam', $id); ?>"></td></tr>
                <tr><td>Tanggal</td><td>:</td><td><input type="date" name="balik" value="<?php echo $db->bacaDataPinjam('balik', $id); ?>"></td></tr>
            </table>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update data">
        </form>
<?php
    }
    else if ($_GET['aksi'] == 'update') {
        //proses update data anggota
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $judul = $_POST['judul'];
        $pinjam = $_POST['pinjam'];
        $balik = $_POST['balik'];
        //update data via method
        $db->updateDataPinjam($id, $nama, $judul, $pinjam, $balik);
    }
}
//buat array data anggota dari method tampilAnggota()
$arraybuku = $db->tampilPinjam();
echo "</table> <br> <a href='?aksi=tambah'>TAMBAH NAMA PEMINJAM</a>";
echo "<table border='1' cellpadding='5'>
    <tr><th>No</th>
    <th>Nama Peminjam</th>
    <th>Judul Buku</th>
    <th>Tanggal Peminjaman</th>
    <th>Tanggal Pengembalian</th>
    <th>Aksi</th></tr>";
$i = 1;
foreach ($arraybuku as $data){
    echo "<tr><td>" .$i."</td>
            <td>" .$data['nama']. "</td>
            <td>" .$data['judul']. "</td>
            <td>" .$data['pinjam']. "</td>
            <td>" .$data['balik']. "</td>
            <td><a href='" .$_SERVER['PHP_SELF']. "?aksi=edit&id_buku=" .$data['id_buku'] ."'>Edit</a>
            <a href='".$_SERVER['PHP_SELF']. "?aksi=hapus&id_buku=" . $data['id_buku'] . "'>Hapus</a></td></tr>";
    $i++;
}
echo "</table>";
?>