<?php

class database {
    var $host = "localhost";
    var $user = "root";
    var $pass = "";
    var $db = "perpus";
    var $koneksi = "";

    function __construct() {
        $this->koneksi = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (mysqli_connect_errno()){
            echo "Koneksi database gagal : ".mysqli_connect_error();
        }
    }
    function connectMySQL(){
        $koneksi = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$koneksi) {
            die ("Koneksi gagal : ".mysqli_connect_error());
        }
    }

    // Fungsi untuk menampilkan semua buku
    function tampilBuku() {
        $query = mysqli_query($this->koneksi, "SELECT * FROM buku ORDER BY buku_id");
        while ($row = mysqli_fetch_array($query)) $data [] = $row;
        return $data;
    }

    function tambahBuku($isbn, $judul, $kategori, $penerbit, $stok) {
        $query = "INSERT INTO buku (isbn, judul, kategori, penerbit, stok) VALUES ('$isbn','$judul', '$kategori', '$penerbit', '$stok')";
        $hasil = mysqli_query($this->koneksi, $query)or die(mysqli_error());
        if ($hasil)
            echo "Data Buku telah disimpan";
        else 
            echo "Data Buku gagal disimpan";
    }

    function hapusBuku($buku_id) {
        $query = mysqli_query($this->koneksi, "DELETE FROM buku WHERE buku_id='$buku_id'");
    }

    function bacaDataBuku($field, $buku_id) {
        $query = "SELECT * FROM buku WHERE buku_id='$buku_id'";
        $hasil = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_array($hasil);
        if ($field == 'isbn')
            return $data['isbn'];
        else if ($field == 'judul')
            return $data['judul'];
        else if ($field == 'kategori')
            return $data ['kategori'];
        else if ($field == 'penerbit')
            return $data ['penerbit'];
        else if ($field == 'stok')
            return $data ['stok'];
    }

    function updateDataBuku($buku_id, $isbn, $judul, $kategori, $penerbit, $stok){
        $query = "UPDATE buku SET isbn='$isbn', judul='$judul', kategori='$kategori', penerbit='$penerbit', stok='$stok' WHERE buku_id='$buku_id'";
        mysqli_query($this->koneksi, $query);

    }
}

class databasePetugas extends database {
    function tampilPetugas() {
        $query = mysqli_query($this->koneksi, "SELECT * FROM petugas ORDER BY petugas_id");
        while ($row = mysqli_fetch_array($query)) $data [] = $row;
        return $data;
    }

    // Fungsi untuk menambah buku
    function tambahPetugas($nama, $password, $jk, $ttl, $agama, $telp, $email, $alamat) {
        $query = "INSERT INTO petugas (nama, password, jk, ttl, agama, telp, email, alamat) VALUES ('$nama', '$password', '$jk', '$ttl', '$agama', '$telp', '$email', '$alamat')";
        $hasil = mysqli_query($this->koneksi, $query)or die(mysqli_error());
        if ($hasil)
            echo "Data anggota telah disimpan";
        else 
            echo "Data anggota gagal disimpan";
    }

    // Fungsi untuk mengambil data buku berdasarkan ID
    function hapusPetugas($petugas_id) {
        $query = mysqli_query($this->koneksi, "DELETE FROM petugas WHERE petugas_id='$petugas_id'");
    }

    function bacaDataPetugas($field, $petugas_id) {
        $query = "SELECT * FROM petugas WHERE petugas_id='$petugas_id'";
        $hasil = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_array($hasil);
        if ($field == 'nama')
            return $data['nama'];
        else if ($field == 'password')
            return $data['password'];
        else if ($field == 'jk')
            return $data ['jk'];
        else if ($field == 'ttl')
            return $data ['ttl'];
        else if ($field == 'agama')
            return $data ['agama'];
        else if ($field == 'telp')
            return $data ['telp'];
        else if ($field == 'email')
            return $data ['email'];
        else if ($field == 'alamat')
            return $data ['alamat'];
    }

    function updateDataPetugas($petugas_id, $nama, $password, $jk, $ttl, $agama, $telp, $email, $alamat){
        $query = "UPDATE petugas SET nama='$nama', password='$password', jk='$jk', ttl='$ttl', agama='$agama', telp='$telp', email='$email', alamat='$alamat' WHERE petugas_id='$petugas_id'";
        mysqli_query($this->koneksi, $query);

    }
}

class databasePeminjam extends database {
    function tampilPeminjam() {
        $query = mysqli_query($this->koneksi, "SELECT * FROM peminjam ORDER BY peminjam_id");
        while ($row = mysqli_fetch_array($query)) $data [] = $row;
        return $data;
    }

    // Fungsi untuk menambah buku
    function tambahPeminjam($nama, $password, $telp, $email, $alamat,) {
        $query = "INSERT INTO peminjam (nama, password, telp, email, alamat) VALUES ('$nama', '$password', '$telp', '$email', '$alamat')";
        $hasil = mysqli_query($this->koneksi, $query)or die(mysqli_error());
        if ($hasil)
            echo "Data anggota telah disimpan";
        else 
            echo "Data anggota gagal disimpan";
    }

    // Fungsi untuk mengambil data buku berdasarkan ID
    function hapusPeminjam($peminjam_id) {
        $query = mysqli_query($this->koneksi, "DELETE FROM peminjam WHERE peminjam_id='$peminjam_id'");
    }

    function bacaDataPeminjam($field, $peminjam_id) {
        $query = "SELECT * FROM peminjam WHERE peminjam_id='$peminjam_id'";
        $hasil = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_array($hasil);
        if ($field == 'nama')
            return $data['nama'];
        else if ($field == 'password')
            return $data ['password'];
        else if ($field == 'telp')
            return $data ['telp'];
        else if ($field == 'email')
            return $data ['email'];
        else if ($field == 'alamat')
            return $data ['alamat'];
    }

    function updateDataPeminjam($peminjam_id, $nama, $password, $telp, $email, $alamat,){
        $query = "UPDATE peminjam SET nama='$nama', password='$password', telp='$telp', email='$email', alamat='$alamat' WHERE peminjam_id='$peminjam_id'";
        mysqli_query($this->koneksi, $query);
    }
}

class databasePinjam extends database {
    function tampilPinjam() {
        $query = mysqli_query($this->koneksi, "SELECT * FROM pinjam ORDER BY pinjam_id");
        while ($row = mysqli_fetch_array($query)) $data [] = $row;
        return $data;
    }
    

    // Fungsi untuk menambah data peminjaman
    function tambahPinjam($buku_id, $peminjam_id, $jumlah, $tgl_pinjam, $tgl_kembali, $petugas_id) {
        $query = "INSERT INTO pinjam (buku_id, peminjam_id, jumlah, tgl_pinjam, tgl_kembali, petugas_id) VALUES ('$buku_id', '$peminjam_id', '$jumlah', '$tgl_pinjam', '$tgl_kembali', '$petugas_id')";
        $hasil = mysqli_query($this->koneksi, $query)or die(mysqli_error());
        if ($hasil)
            echo "Data anggota telah disimpan";
        else 
            echo "Data anggota gagal disimpan";
    }

    // Fungsi untuk menghapus data peminjaman
    function hapusPinjam($pinjam_id) {
        $query = mysqli_query($this->koneksi, "DELETE FROM pinjam WHERE pinjam_id='$pinjam_id'");
    }


    // Fungsi untuk membaca data peminjaman berdasarkan field tertentu
    function bacaDataPinjam($field, $pinjam_id) {
        $query = "SELECT * FROM pinjam WHERE pinjam_id='$pinjam_id'";
        $hasil = mysqli_query($this->koneksi, $query);
        $data = mysqli_fetch_array($hasil);
        if ($field == 'buku_id')
            return $data['buku_id'];
        else if ($field == 'peminjam_id')
            return $data ['peminjam_id'];
        else if ($field == 'jumlah')
            return $data ['jumlah'];
            else if ($field == 'tgl_pinjam')
            return $data ['tgl_pinjam'];
            else if ($field == 'tgl_kembali')
            return $data ['tgl_kembali'];
        else if ($field == 'petugas_id')
            return $data ['petugas_id'];
    }

    // Fungsi untuk memperbarui data peminjaman
    function updateDataPinjam($pinjam_id, $buku_id, $peminjam_id, $jumlah, $tgl_pinjam, $tgl_kembali, $petugas_id) {
        $query = "UPDATE pinjam SET buku_id='$buku_id', peminjam_id='$peminjam_id', jumlah='$jumlah', tgl_pinjam='$tgl_pinjam', tgl_kembali='$tgl_kembali', petugas_id='$petugas_id' WHERE pinjam_id='$pinjam_id'";
        mysqli_query($this->koneksi, $query);
    }
}
?>