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
            echo "meta http-equiv='refresh', content'0; url=index.php'>";
        else 
            echo "Data anggota gagal disimpan";
    }

    //method tsmpil data
    function tampilAnggota($nama, $alamat, $telepon) {
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

?>