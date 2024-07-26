<?php
echo "<a href='guru.php'>Cek Data Guru</a>";
//memanggil file koneksi
include 'koneksi_class.php';
//instance objek db
$db = new databaseSpp();
//koneksi ke MySQL via method
$db->connectMySQL();
//proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        //baca ID dari parameter ID anggota yang akan dihapus
        $id = $_GET['id'];
        //proses hapus data anggota berdasarkan ID via method
        $db->hapusSpp($id);
    }
    else if ($_GET['aksi'] == 'tambah') {
        echo"<br>
        <form method=POST action='?aksi=tambahSpp'>
        <table>
        <tr><td>NIS</td><td><input type=number name='nis'></td></tr>
        <tr><td>Tanggal</td><td><input type=date name='tanggal'></td></tr>
        <tr><td>Total</td><td><input type=number name='total'></td></tr>
        <tr><td></td><td><input type=submit value='simpan'></td></tr>
        </table>
        </form>";
    }
    else if ($_GET['aksi'] == 'tambahSpp') {
        $nis = $_POST['nis'];
        $tanggal = $_POST['tanggal'];
        $total = $_POST['total'];
        $db->tambahSpp($nis, $tanggal, $total);
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
                <tr><td>NIS Siswa</td><td>:</td><td><input type="number" name="nis" value="<?php echo $db->bacaDataSpp('nis', $id); ?>"></td></tr>
                <tr><td>Tanggal Pembayaran</td><td>:</td><td><input type="date" name="tanggal" value="<?php echo $db->bacaDataSpp('tanggal', $id); ?>"></td></tr>
                <tr><td>Total Pembayaran</td><td>:</td><td><input type="number" name="total" value="<?php echo $db->bacaDataSpp('total', $id); ?>"></td></tr>
            </table>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update data">
        </form>
<?php
    }
    else if ($_GET['aksi'] == 'update') {
        //proses update data anggota
        $id = $_POST['id'];
        $nis = $_POST['nis'];
        $tanggal = $_POST['tanggal'];
        $total = $_POST['total'];
        //update data via method
        $db->updateDataSpp($id, $nis, $tanggal, $total);
    }
}
//buat array data anggota dari method tampilAnggota()
$arrayspp = $db->tampilSpp();
echo "</table> <br> <a href='?aksi=tambah'>TAMBAH Spp</a>";
echo "<table border='1' cellpadding='5'>
<tr><th>No</th>
<th>NIS Siswa</th>
<th>Tanggal Pembayaran</th>
<th>Total Pembayaran</th>
<th>Aksi</th></tr>";
$i = 1;
foreach ($arrayspp as $data){
    echo "<tr><td>" .$i."</td>
    <td>" .$data['nis']. "</td>
    <td>" .$data['tanggal']. "</td>
    <td>" .number_format($data['total']). "</td>
    <td><a href='" .$_SERVER['PHP_SELF']. "?aksi=edit&id=" .$data['id'] ."'>Edit</a>
    <a href='".$_SERVER['PHP_SELF']. "?aksi=hapus&id=" . $data['id'] . "'>Hapus</a></td></tr>";
    $i++;
}
echo "</table>";
?>