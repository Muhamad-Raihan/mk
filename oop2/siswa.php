<?php
echo "<a href='guru.php'>Cek Data Guru</a>";
//memanggil file koneksi
include 'koneksi_class.php';
//instance objek db
$db = new databaseSiswa();
//koneksi ke MySQL via method
$db->connectMySQL();
//proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        //baca ID dari parameter ID anggota yang akan dihapus
        $id = $_GET['nis'];
        //proses hapus data anggota berdasarkan ID via method
        $db->hapusSiswa($id);
    }
    else if ($_GET['aksi'] == 'tambah') {
        echo"<br>
        <form method=POST action='?aksi=tambahSiswa'>
        <table>
        <tr><td>Nama</td><td><input type=text name='nama'></td></tr>
        <tr><td>Kelas</td><td><input type=text name='kelas'></td></tr>
        <tr><td>Alamat</td><td><input type=text name='alamat'></td></tr>
        <tr><td></td><td><input type=submit value='simpan'></td></tr>
        </table>
        </form>";
    }
    else if ($_GET['aksi'] == 'tambahSiswa') {
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $alamat = $_POST['alamat'];
        $db->tambahSiswa($nama, $kelas, $alamat);
    }
    //proses update data
    else if ($_GET['aksi'] == 'edit')
    {
        //baca ID anggota yang akan diedit
        $id = $_GET['nis'];
        //menampilkan form edit anggota pakai method bacaDataAnggota()
?>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?> ?aksi=update">
            <table>
                <tr><td>Nama Siswa</td><td>:</td><td><input type="text" name="nama" value="<?php echo $db->bacaDataSiswa('nama', $id); ?>"></td></tr>
                <tr><td>Kelas</td><td>:</td><td><input type="text" name="kelas" value="<?php echo $db->bacaDataSiswa('kelas', $id); ?>"></td></tr>
                <tr><td>Alamat</td><td>:</td><td><input type="text" name="alamat" value="<?php echo $db->bacaDataSiswa('alamat', $id); ?>"></td></tr>
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
        $kelas = $_POST['kelas'];
        $alamat = $_POST['alamat'];
        //update data via method
        $db->updateDataSiswa($id, $nama, $kelas, $alamat);
    }
}
//buat array data anggota dari method tampilAnggota()
$arrayanggota = $db->tampilSiswa();
echo "</table> <br> <a href='?aksi=tambah'>TAMBAH SISWA</a>";
echo "<table border='1' cellpadding='5'>
<tr><th>No</th>
<th>Nama Siswa</th>
<th>Kelas</th>
<th>Alamat</th>
<th>Aksi</th></tr>";
$i = 1;
foreach ($arrayanggota as $data){
    echo "<tr><td>" .$i."</td>
    <td>" .$data['nama']. "</td>
    <td>" .$data['kelas']. "</td>
    <td>" .$data['alamat']. "</td>
    <td><a href='" .$_SERVER['PHP_SELF']. "?aksi=edit&nis=" .$data['nis'] ."'>Edit</a>
    <a href='".$_SERVER['PHP_SELF']. "?aksi=hapus&nis=" . $data['nis'] . "'>Hapus</a></td></tr>";
    $i++;
}
echo "</table>";
?>