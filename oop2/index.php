<?php
//memanggil file koneksi
include 'koneksi_class.php';

//instance objek db
$db = new database();

//koneksi ke MySQL via method
$db->connectMySQL();

//proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        //baca ID dari parameter ID anggota yang akan dihapus
        $id = $_GET['id_agt'];
        //proses hapus data anggota berdasarkan ID via method
        $db->hapusAnggota($id);
    }
    else if ($_GET['aksi'] == 'tambah') {
        echo"<br>
        <form method=POST action='?aksi=tambahAnggota'>
        <table>
        <tr><td>Nama</td><td><input type=text name='nama'></td></tr>
        <tr><td>Alamat</td><td><input type=text name='alamat'></td></tr>
        <tr><td>Telepon</td><td><input type=text name='telepon'></td></tr>
        <tr><td></td><td><input type=submit value='simpan'></td></tr>
        </table>
        </form>";
    }
    else if ($_GET['aksi'] == 'tambahAnggota') {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $db->tambahAnggota($nama, $alamat, $telepon);
    }

    //proses update data
    else if ($_GET['aksi'] == 'edit')
    {
        //baca ID anggota yang akan diedit
        $id = $_GET['id_agt'];
        //menampilkan form edit anggota pakai method bacaDataAnggota()
?>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?> ?aksi=update">
            <table>
                <tr><td>Nama anggota</td><td>:</td><td><input type="text" name="nama" value="<?php echo $db->bacaDataAnggota('nama', $id); ?>"></td></tr>
                <tr><td>Alamat</td><td>:</td><td><input type="text" name="alamat" value="<?php echo $db->bacaDataAnggota('alamat', $id); ?>" size="40"></td></tr>
                <tr><td>Telepon</td><td>:</td><td><input type="text" name="telepon" value="<?php echo $db->bacaDataAnggota('telepon', $id); ?>"></td></tr>
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
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        //update data via method
        $db->updateDataAnggota($id, $nama, $alamat, $telepon);
    }
}

//buat array data anggota dari method tampilAnggota()
$arrayanggota = $db->tampilAnggota();
echo "</table> <br> <a href='?aksi=tambah'>TAMBAH ANGGOTA</a>";
echo "<table border='1' cellpadding='5'>
<tr><th>No</th>
<th>Nama Anggota</th>
<th>Alamat</th>
<th>Telepon</th>
<th>Aksi</th></tr>";
$i = 1;
foreach ($arrayanggota as $data){
    echo "<tr><td>" .$i."</td>
    <td>" .$data['nama']. "</td>
    <td>" .$data['alamat']. "</td>
    <td>" .$data['telepon']. "</td>
    <td><a href='" .$_SERVER['PHP_SELF']. "?aksi=edit&id_agt=" .$data['id_anggota'] ."'>Edit</a>
    <a href='".$_SERVER['PHP_SELF']. "?aksi=hapus&id_agt=" . $data['id_anggota'] . "'>Hapus</a></td></tr>";
    $i++;
}
echo "</table>";
echo "<br> <a href='buku.php'>Cek Daftar Buku</a>";
echo "<br> <a href='pinjam.php'>Lihat Daftar Peminjaman</a>";

?>