<?php
//memanggil file koneksi
include 'koneksi.php';

//instance objek db
$db = new database();

//koneksi ke MySQL via method
$db->connectMySQL();

//proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        //baca ID dari parameter ID anggota yang akan dihapus
        $id = $_GET['id_buku'];
        //proses hapus data anggota berdasarkan ID via method
        $db->hapusBuku($id);
    }
    else if ($_GET['aksi'] == 'tambah') {
        echo"<br>
        <form method=POST action='?aksi=tambahBuku'>
        <table>
        <tr><td>Judul</td><td><input type=text name='judul'></td></tr>
        <tr><td>Penulis</td><td><input type=text name='penulis'></td></tr>
        <tr><td>Penerbit</td><td><input type=text name='penerbit'></td></tr>
        <tr><td>Tanggal</td><td><input type=date name='tanggal'></td></tr>
        <tr><td></td><td><input type=submit value='simpan'></td></tr>
        </table>
        </form>";
    }
    else if ($_GET['aksi'] == 'tambahBuku') {
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $tanggal = $_POST['tanggal'];
        $db->tambahBuku($judul, $penulis, $penerbit, $tanggal);
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
                <tr><td>Nama Buku</td><td>:</td><td><input type="text" name="judul" value="<?php echo $db->bacaDataBuku('judul', $id); ?>"></td></tr>
                <tr><td>Penulis</td><td>:</td><td><input type="text" name="penulis" value="<?php echo $db->bacaDataBuku('penulis', $id); ?>"></td></tr>
                <tr><td>Penerbit</td><td>:</td><td><input type="text" name="penerbit" value="<?php echo $db->bacaDataBuku('penerbit', $id); ?>"></td></tr>
                <tr><td>Tanggal</td><td>:</td><td><input type="date" name="tanggal" value="<?php echo $db->bacaDataBuku('tanggal', $id); ?>"></td></tr>
            </table>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update data">
        </form>
<?php
    }
    else if ($_GET['aksi'] == 'update') {
        //proses update data anggota
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $tanggal = $_POST['tanggal'];
        //update data via method
        $db->updateDataBuku($id, $judul, $penulis, $penerbit, $tanggal);
    }
}

//buat array data anggota dari method tampilAnggota()
$arraybuku = $db->tampilBuku();
echo "</table> <br> <a href='?aksi=tambah'>TAMBAH</a>";
echo "<table border='1' cellpadding='5'>
    <tr><th>No</th>
    <th>Judul</th>
    <th>Penulis</th>
    <th>Penerbit</th>
    <th>Tanggal</th>
    <th>Aksi</th></tr>";
$i = 1;
foreach ($arraybuku as $data){
    echo "<tr><td>" .$i."</td>
            <td>" .$data['judul']. "</td>
            <td>" .$data['penulis']. "</td>
            <td>" .$data['penerbit']. "</td>
            <td>" .$data['tanggal']. "</td>
            <td><a href='" .$_SERVER['PHP_SELF']. "?aksi=edit&id_buku=" .$data['id_buku'] ."'>Edit</a>
            <a href='".$_SERVER['PHP_SELF']. "?aksi=hapus&id_buku=" . $data['id_buku'] . "'>Hapus</a></td></tr>";
    $i++;
}
echo "</table>";
?>