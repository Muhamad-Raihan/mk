<?php
echo "<a href='guru.php'>Cek Data Guru</a>";
//memanggil file koneksi
include 'koneksi_class.php';
//instance objek db
$db = new databaseMapel();
//koneksi ke MySQL via method
$db->connectMySQL();
//proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        //baca ID dari parameter ID anggota yang akan dihapus
        $id = $_GET['id'];
        //proses hapus data anggota berdasarkan ID via method
        $db->hapusMapel($id);
    }
    else if ($_GET['aksi'] == 'tambah') {
        echo"<br>
        <form method=POST action='?aksi=tambahMapel'>
        <table>
        <tr><td>NIP</td><td><input type=text name='nip'></td></tr>
        <tr><td>Mata pelajaran</td><td><input type=text name='mapel'></td></tr>
        <tr><td>Ruang</td><td><input type=text name='ruang'></td></tr>
        <tr><td></td><td><input type=submit value='simpan'></td></tr>
        </table>
        </form>";
    }
    else if ($_GET['aksi'] == 'tambahMapel') {
        $nip = $_POST['nip'];
        $mapel = $_POST['mapel'];
        $ruang = $_POST['ruang'];
        $db->tambahMapel($nip, $mapel, $ruang);
    }
    //proses update data
    else if ($_GET['aksi'] == 'edit')
    {
        //baca ID anggota yang akan diedit
        $id = $_GET['id'];
        //menampilkan form edit anggota pakai method bacaDataAnggota()
?>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?> ?aksi=update">
            <table>
                <tr><td>NIP</td><td>:</td><td><input type="text" name="nip" value="<?php echo $db->bacaDataMapel('nip', $id); ?>"></td></tr>
                <tr><td>Mata Pelajaran</td><td>:</td><td><input type="text" name="mapel" value="<?php echo $db->bacaDataMapel('mapel', $id); ?>"></td></tr>
                <tr><td>Ruang</td><td>:</td><td><input type="text" name="ruang" value="<?php echo $db->bacaDataMapel('ruang', $id); ?>"></td></tr>
            </table>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update data">
        </form>
<?php
    }
    else if ($_GET['aksi'] == 'update') {
        //proses update data anggota
        $id = $_POST['id'];
        $nip = $_POST['nip'];
        $mapel = $_POST['mapel'];
        $ruang = $_POST['ruang'];
        //update data via method
        $db->updateDataMapel($id, $nip, $mapel, $ruang);
    }
}
//buat array data anggota dari method tampilAnggota()
$arrayspp = $db->tampilMapel();
echo "</table> <br> <a href='?aksi=tambah'>TAMBAH Mapel</a>";
echo "<table border='1' cellpadding='5'>
<tr><th>No</th>
<th>NIP</th>
<th>Mata Pelajaran</th>
<th>Ruang</th>
<th>Aksi</th></tr>";
$i = 1;
foreach ($arrayspp as $data){
    echo "<tr><td>" .$i."</td>
    <td>" .$data['nip']. "</td>
    <td>" .$data['mapel']. "</td>
    <td>" .$data['ruang']. "</td>
    <td><a href='" .$_SERVER['PHP_SELF']. "?aksi=edit&id=" .$data['id'] ."'>Edit</a>
    <a href='".$_SERVER['PHP_SELF']. "?aksi=hapus&id=" . $data['id'] . "'>Hapus</a></td></tr>";
    $i++;
}
echo "</table>";
?>