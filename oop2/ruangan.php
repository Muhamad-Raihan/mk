<?php
//memanggil file koneksi
include 'koneksi_class.php';
//instance objek db
$db = new databaseRuang();
//koneksi ke MySQL via method
$db->connectMySQL();
//proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        //baca ID dari parameter ID anggota yang akan dihapus
        $id = $_GET['kode'];
        //proses hapus data anggota berdasarkan ID via method
        $db->hapusRuang($id);
    }
    else if ($_GET['aksi'] == 'tambah') {
        echo"<br>
        <form method=POST action='?aksi=tambahRuang'>
        <table>
        <tr><td>Nama</td><td><input type=text name='nama'></td></tr>
        <tr><td>Nomor</td><td><input type=number name='nomor'></td></tr>
        <tr><td></td><td><input type=submit value='simpan'></td></tr>
        </table>
        </form>";
    }
    else if ($_GET['aksi'] == 'tambahRuang') {
        $nama = $_POST['nama'];
        $nomor = $_POST['nomor'];
        $db->tambahRuang($nama, $nomor);
    }
    //proses update data
    else if ($_GET['aksi'] == 'edit')
    {
        //baca ID anggota yang akan diedit
        $id = $_GET['kode'];
        //menampilkan form edit anggota pakai method bacaDataAnggota()
?>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?> ?aksi=update">
            <table>
                <tr><td>Nama Ruangan</td><td>:</td><td><input type="text" name="nama" value="<?php echo $db->bacaDataRuang('nama', $id); ?>"></td></tr>
                <tr><td>Nomor</td><td>:</td><td><input type="number" name="nomor" value="<?php echo $db->bacaDataRuang('nomor', $id); ?>"></td></tr>
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
        $nomor = $_POST['nomor'];
        //update data via method
        $db->updateDataGuru($id, $nama, $nomr);
    }
}
//buat array data anggota dari method tampilAnggota()
$arrayruang = $db->tampilRUang();
echo "</table> <br> <a href='?aksi=tambah'>TAMBAH DATA Ruangan</a>";
echo "<table border='1' cellpadding='5'>
<tr><th>No</th>
<th>Nama Ruangan</th>
<th>Nomor</th>
<th>Aksi</th></tr>";
$i = 1;
foreach ($arrayruang as $data){
    echo "<tr><td>" .$i."</td>
    <td>" .$data['nama']. "</td>
    <td>" .$data['nomor']. "</td>
    <td><a href='" .$_SERVER['PHP_SELF']. "?aksi=edit&kode=" .$data['kode'] ."'>Edit</a>
    <a href='".$_SERVER['PHP_SELF']. "?aksi=hapus&kode=" . $data['kode'] . "'>Hapus</a></td></tr>";
    $i++;
}
echo "</table>";
?>