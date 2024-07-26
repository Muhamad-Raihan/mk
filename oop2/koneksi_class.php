<?php
class database {
    //properti
    var $dbHost = "localhost";
    var $dbUser = "root";
    var $dbPass = "";
    var $dbName = "crudoop";
    var $koneksi = "";
    //method koneksi mysql
    function __construct() {
        $this->koneksi = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        if (mysqli_connect_errno()){
            echo "Koneksi database gagal : ".mysqli_connect_error();
        }
    }
    function connectMySQL(){
        $koneksi = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        if (!$koneksi) {
            die ("Koneksi gagal : ".mysqli_connect_error());
        }
    }
    //method tambah data (insert data)
    function tambahAnggota($nama, $alamat, $telepon) {
        $query = "INSERT INTO anggota (nama, alamat, telepon) VALUES ('$nama','$alamat','$telepon')";
        $hasil = mysqli_query($this->koneksi, $query)or die(mysqli_error());
        if ($hasil)
            echo "Data anggota telah disimpan";
        else 
            echo "Data anggota gagal disimpan";
    }
    //method tsmpil data
    function tampilAnggota() {
        $query = mysqli_query($this->koneksi, "SELECT * FROM anggota ORDER BY id_anggota");
        while ($row = mysqli_fetch_array($query)) $data [] = $row;
        return $data;
    }
    //method hapus data
    function hapusAnggota($id_agt){
        $query = mysqli_query($this->koneksi, "DELETE FROM anggota WHERE id_anggota='$id_agt'");
        echo "<p>Data anggota dihapus dengan ID ".$id_agt."sudah dihapus</p>";
    }
    function bacaDataAnggota($field, $id_agt) {
        $query = "SELECT * FROM anggota WHERE id_anggota='$id_agt'";
        $hasil = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_array($hasil);
        if ($field == 'nama')
            return $data['nama'];
        else if ($field == 'alamat')
            return $data ['alamat'];
        else if ($field == 'telepon')
            return $data ['telepon'];
    }
    //method untuk proses update data anggota
    function updateDataAnggota($id_anggota, $nama, $alamat, $telepon){
        $query = "UPDATE anggota SET nama='$nama', alamat='$alamat', telepon='$telepon' WHERE id_anggota='$id_anggota'";
        mysqli_query($this->koneksi, $query);
        echo "<p>Data anggota telah di update.</p>";
    }
}
class databaseBuku extends database {
    //method tambah data (insert data)
    function tambahBuku($judul, $penulis, $penerbit, $tanggal) {
        $query = "INSERT INTO buku (judul, penulis, penerbit, tanggal) VALUES ('$judul','$penulis','$penerbit', '$tanggal')";
        $hasil = mysqli_query($this->koneksi, $query)or die(mysqli_error());
        if ($hasil)
            echo "Data Buku telah disimpan <br>";
        else 
            echo "Data Buku gagal disimpan <br>";
    }
    //method tsmpil data
    function tampilBuku() {
        $query = mysqli_query($this->koneksi, "SELECT * FROM buku ORDER BY id_buku"); 
        while ($row = mysqli_fetch_array($query)) {
            $row['tanggal'] = date('d-F-Y', strtotime($row['tanggal']));
            $data[] = $row; 
        }
    return $data;
    }
    //method hapus data
    function hapusBuku($id_buku){
        $query = mysqli_query($this->koneksi, "DELETE FROM buku WHERE id_buku='$id_buku'");
        echo "<p>Data buku dengan ID ".$id_buku."sudah dihapus</p>";
    }
    function bacaDataBuku($field, $id_buku) {
        $query = "SELECT * FROM buku WHERE id_buku='$id_buku'";
        $hasil = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_array($hasil);
        if ($field == 'judul')
            return $data['judul'];
        else if ($field == 'penulis')
            return $data ['penulis'];
        else if ($field == 'penerbit')
            return $data ['penerbit'];
        else if ($field == 'tanggal')
            return $data ['tanggal'];
    }
    //method untuk proses update data anggota
    function updateDataBuku($id_buku, $judul, $penulis, $penerbit, $tanggal){
        $query = "UPDATE buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tanggal='$tanggal' WHERE id_buku='$id_buku'";
        mysqli_query($this->koneksi, $query);
        echo "<p>Data Buku telah di update.</p>";
    }
}
class databasePinjam extends database {
    //method tambah data (insert data)
    function tambahPinjam($nama, $judul, $pinjam, $balik) {
        $query = "INSERT INTO pinjam (nama, judul, pinjam, balik) VALUES ('$nama','$judul','$pinjam','$balik')";
        $hasil = mysqli_query($this->koneksi, $query)or die(mysqli_error());
        if ($hasil)
            echo "Data Peminjaman telah disimpan <br>";
        else 
            echo "Data Pengembalian gagal disimpan <br>";
    }
    //method tsmpil data
    function tampilPinjam() {
        $query = mysqli_query($this->koneksi, "SELECT * FROM pinjam ORDER BY id_buku");
        while ($row = mysqli_fetch_array($query)) {
            $row['pinjam'] = date('d-F-Y', strtotime($row['pinjam']));
            $row['balik'] = date('d-F-Y', strtotime($row['balik']));
            $data[] = $row; 
        }
        return $data;
    }
    //method hapus data
    function hapusPinjam($id_buku){
        $query = mysqli_query($this->koneksi, "DELETE FROM pinjam WHERE id_buku='$id_buku'");
        echo "<p>Data Peminjaman atas ID ".$id_buku."sudah dihapus</p>";
    }
    function bacaDataPinjam($field, $id_buku) {
        $query = "SELECT * FROM pinjam WHERE id_buku='$id_buku'";
        $hasil = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_array($hasil);
        if ($field == 'nama')
            return $data['nama'];
        else if ($field == 'judul')
            return $data ['judul'];
        else if ($field == 'pinjam')
            return $data ['pinjam'];
        else if ($field == 'balik')
            return $data ['balik']; 
    }
    //method untuk proses update data anggota
    function updateDataPinjam($id_buku, $nama, $judul, $pinjam, $balik){
        $query = "UPDATE pinjam SET nama='$nama', judul='$judul', pinjam='$pinjam', balik='$balik' WHERE id_buku='$id_buku'";
        mysqli_query($this->koneksi, $query);
        echo "<p>Data Peminjam telah di update.</p>";        
    }
    function close() {
        mysqli_close($this->koneksi);
    }
}

class databaseSiswa extends database {
    //method tambah data (insert data)
    function tambahSiswa($nama, $kelas, $alamat) {
        $query = "INSERT INTO siswa (nama, kelas, alamat) VALUES ('$nama','$kelas','$alamat')";
        $hasil = mysqli_query($this->koneksi, $query)or die(mysqli_error());
        if ($hasil)
            echo "Data Pembayaran telah disimpan";
        else 
            echo "Data Siswa gagal disimpan";
    }
    //method tsmpil data
    function tampilSiswa() {
        $query = mysqli_query($this->koneksi, "SELECT * FROM siswa ORDER BY nis");
        while ($row = mysqli_fetch_array($query)) $data [] = $row;
        return $data;
    }
    //method hapus data
    function hapusSiswa($nis){
        $query = mysqli_query($this->koneksi, "DELETE FROM siswa WHERE nis='$nis'");
        echo "<p>Data Siswa dengan NIS ".$nis."sudah dihapus</p>";
    }
    function bacaDataSiswa($field, $nis) {
        $query = "SELECT * FROM siswa WHERE nis='$nis'";
        $hasil = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_array($hasil);
        if ($field == 'nama')
            return $data['nama'];
        else if ($field == 'kelas')
            return $data ['kelas'];
        else if ($field == 'alamat')
            return $data ['alamat'];
    }
    //method untuk proses update data anggota
    function updateDataSiswa($nis, $nama, $kelas, $alamat){
        $query = "UPDATE siswa SET nama='$nama', kelas='$kelas', alamat='$alamat' WHERE nis='$nis'";
        mysqli_query($this->koneksi, $query);
        echo "<p>Data anggota telah di update.</p>";
    }
}

class databaseGuru extends database {
    //method tambah data (insert data)
    function tambahGuru($nama, $jabatan, $bstudi, $alamat) {
        $query = "INSERT INTO guru (nama, jabatan, bstudi, alamat) VALUES ('$nama','$jabatan','$bstudi' ,'$alamat')";
        $hasil = mysqli_query($this->koneksi, $query)or die(mysqli_error());
        if ($hasil)
            echo "Data Siswa telah disimpan";
        else 
            echo "Data Siswa gagal disimpan";
    }
    //method tsmpil data
    function tampilGuru() {
        $query = mysqli_query($this->koneksi, "SELECT * FROM guru ORDER BY nip");
        while ($row = mysqli_fetch_array($query)) $data [] = $row;
        return $data;
    }
    //method hapus data
    function hapusGuru($nip){
        $query = mysqli_query($this->koneksi, "DELETE FROM guru WHERE nip='$nip'");
        echo "<p>Data Siswa dengan NIP ".$nip."sudah dihapus</p>";
    }
    function bacaDataGuru($field, $nip) {
        $query = "SELECT * FROM guru WHERE nip='$nip'";
        $hasil = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_array($hasil);
        if ($field == 'nama')
            return $data['nama'];
        else if ($field == 'jabatan')
            return $data ['jabatan'];
        else if ($field == 'bstudi')
            return $data ['bstudi'];
        else if ($field == 'alamat')
            return $data ['alamat'];
    }
    //method untuk proses update data anggota
    function updateDataGuru($nip, $nama, $jabatan, $bstudi, $alamat){
        $query = "UPDATE guru SET nama='$nama', jabatan='$jabatan', bstudi='$bstudi', alamat='$alamat' WHERE nip='$nip'";
        mysqli_query($this->koneksi, $query);
        echo "<p>Data anggota telah di update.</p>";
    }
}

class databaseRuang extends database {
    //method tambah data (insert data)
    function tambahRuang($nama, $nomor) {
        $query = "INSERT INTO ruang (nama, nomor) VALUES ('$nama','$nomor')";
        $hasil = mysqli_query($this->koneksi, $query)or die(mysqli_error());
    }
    //method tsmpil data
    function tampilRUang() {
        $query = mysqli_query($this->koneksi, "SELECT * FROM ruang ORDER BY nama");
        while ($row = mysqli_fetch_array($query)) $data [] = $row;
        return $data;
    }
    //method hapus data
    function hapusRuang($kode){
        $query = mysqli_query($this->koneksi, "DELETE FROM ruang WHERE kode='$kode'");
        echo "<p>Data Ruangan sudah dihapus</p>";
    }
    function bacaDataRuang($field, $kode) {
        $query = "SELECT * FROM ruang WHERE kode='$kode'";
        $hasil = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_array($hasil);
        if ($field == 'nama')
            return $data['nama'];
        else if ($field == 'nomor')
            return $data ['nomor'];
    }
    //method untuk proses update data anggota
    function updateDataGuru($kode, $nama, $nomor){
        $query = "UPDATE ruang SET nama='$nama', nomor='$nomor' WHERE kode='$kode'";
        mysqli_query($this->koneksi, $query);
        echo "<p>Data Ruangan telah di update.</p>";
    }
}

class databaseSpp extends database {
    //method tambah data (insert data)
    function tambahSpp($nis, $tanggal, $total) {
        $query = "INSERT INTO spp (nis, tanggal, total) VALUES ('$nis','$tanggal','$total')";
        $hasil = mysqli_query($this->koneksi, $query)or die(mysqli_error());
        if ($hasil)
            echo "Data Pembayaran telah disimpan";
        else 
            echo "Data Pembayaran gagal disimpan";
    }
    //method tsmpil data
    function tampilSpp() {
        $query = mysqli_query($this->koneksi, "SELECT * FROM spp ORDER BY id");
        while ($row = mysqli_fetch_array($query)) {
            $row['tanggal'] = date('d-F-Y', strtotime($row['tanggal']));
            $data[] = $row; 
        }
        return $data;
        return $data;
    }
    //method hapus data
    function hapusSpp($id){
        $query = mysqli_query($this->koneksi, "DELETE FROM spp WHERE id='$id'");
        echo "<p>Data Pembayaran sudah dihapus</p>";
    }
    function bacaDataSpp($field, $id) {
        $query = "SELECT * FROM spp WHERE id='$id'";
        $hasil = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_array($hasil);
        if ($field == 'nis')
            return $data['nis'];
        else if ($field == 'tanggal')
            return $data ['tanggal'];
        else if ($field == 'total')
            return $data ['total'];
    }
    //method untuk proses update data anggota
    function updateDataSpp($id, $nis, $tanggal, $total){
        $query = "UPDATE spp SET nis='$nis', tanggal='$tanggal', total='$total' WHERE id='$id'";
        mysqli_query($this->koneksi, $query);
        echo "<p>Data pembayaran telah di update.</p>";
    }
}

class databaseMapel extends database {
    //method tambah data (insert data)
    function tambahMapel($nip, $mapel, $ruang) {
        $query = "INSERT INTO mapel (nip, mapel, ruang) VALUES ('$nip','$mapel','$ruang')";
        $hasil = mysqli_query($this->koneksi, $query)or die(mysqli_error());
        if ($hasil)
            echo "Data Roster telah disimpan";
        else 
            echo "Data Roster gagal disimpan";
    }
    //method tsmpil data
    function tampilMapel() {
        $query = mysqli_query($this->koneksi, "SELECT * FROM mapel ORDER BY id");
        while ($row = mysqli_fetch_array($query)) $data [] = $row;
        return $data;
    }
    //method hapus data
    function hapusMapel($id){
        $query = mysqli_query($this->koneksi, "DELETE FROM mapel WHERE id='$id'");
        echo "<p>Data Roster sudah dihapus</p>";
    }
    function bacaDataMapel($field, $id) {
        $query = "SELECT * FROM mapel WHERE id='$id'";
        $hasil = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_array($hasil);
        if ($field == 'nip')
            return $data['nip'];
        else if ($field == 'mapel')
            return $data ['mapel'];
        else if ($field == 'ruang')
            return $data ['ruang'];
    }
    //method untuk proses update data anggota
    function updateDataMapel($id, $nip, $mapel, $ruang){
        $query = "UPDATE mapel SET nip='$nip', mapel='$mapel', ruang='$ruang' WHERE id='$id'";
        mysqli_query($this->koneksi, $query);
        echo "<p>Data Roster telah di update.</p>";
    }
}
?>