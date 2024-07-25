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
        else {
            echo "Koneksi database berhasil <br>";
        }
    }

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
        while ($row = mysqli_fetch_array($query)) $data [] = $row;
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

?>