<?php
//memanggil file koneksi
include 'koneksi_class.php';
//instance objek db
$db = new databaseGuru();
//koneksi ke MySQL via method
$db->connectMySQL();
//proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        //baca ID dari parameter ID anggota yang akan dihapus
        $id = $_GET['nip'];
        //proses hapus data anggota berdasarkan ID via method
        $db->hapusGuru($id);
    }
    else if ($_GET['aksi'] == 'tambah') {
        echo"<br>
        <form method=POST action='?aksi=tambahGuru'>
        <table>
        <tr><td>Nama</td><td><input type=text name='nama'></td></tr>
        <tr><td>Jabatan</td><td><input type=text name='jabatan'></td></tr>
        <tr><td>Bidang Studi</td><td><input type=text name='bstudi'></td></tr>
        <tr><td>Alamat</td><td><input type=text name='alamat'></td></tr>
        <tr><td></td><td><input type=submit value='simpan'></td></tr>
        </table>
        </form>";
    }
    else if ($_GET['aksi'] == 'tambahGuru') {
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];
        $bstudi = $_POST['bstudi'];
        $alamat = $_POST['alamat'];
        $db->tambahGuru($nama, $jabatan, $bstudi, $alamat);
    }
    //proses update data
    else if ($_GET['aksi'] == 'edit')
    {
        //baca ID anggota yang akan diedit
        $id = $_GET['nip'];
        //menampilkan form edit anggota pakai method bacaDataAnggota()
?>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?> ?aksi=update">
            <table>
                <tr><td>Nama Guru</td><td>:</td><td><input type="text" name="nama" value="<?php echo $db->bacaDataGuru('nama', $id); ?>"></td></tr>
                <tr><td>Jabatan</td><td>:</td><td><input type="text" name="jabatan" value="<?php echo $db->bacaDataGuru('jabatan', $id); ?>"></td></tr>
                <tr><td>Bidang Studi</td><td>:</td><td><input type="text" name="bstudi" value="<?php echo $db->bacaDataGuru('bstudi', $id); ?>"></td></tr>
                <tr><td>Alamat</td><td>:</td><td><input type="text" name="alamat" value="<?php echo $db->bacaDataGuru('alamat', $id); ?>"></td></tr>
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
        $jabatan = $_POST['jabatan'];
        $bstudi = $_POST['bstudi'];
        $alamat = $_POST['alamat'];
        //update data via method
        $db->updateDataGuru($id, $nama, $jabatan, $bstudi, $alamat);
    }
}
//buat array data anggota dari method tampilAnggota()
$arrayguru = $db->tampilGuru();
echo "</table> <br> <a href='?aksi=tambah'>TAMBAH DATA GURU</a>";
echo "<table border='1' cellpadding='5'>
<tr><th>No</th>
<th>Nama Guru</th>
<th>Jabatan</th>
<th>Bidang Studi</th>
<th>Alamat</th>
<th>Aksi</th></tr>";
$i = 1;
foreach ($arrayguru as $data){
    echo "<tr><td>" .$i."</td>
    <td>" .$data['nama']. "</td>
    <td>" .$data['jabatan']. "</td>
    <td>" .$data['bstudi']. "</td>
    <td>" .$data['alamat']. "</td>
    <td><a href='" .$_SERVER['PHP_SELF']. "?aksi=edit&nip=" .$data['nip'] ."'>Edit</a>
    <a href='".$_SERVER['PHP_SELF']. "?aksi=hapus&nip=" . $data['nip'] . "'>Hapus</a></td></tr>";
    $i++;
}
echo "</table>";
?>