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
?>