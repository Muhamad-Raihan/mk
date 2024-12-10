<?php

class database {
    var $host = "localhost";
    var $user = "root";
    var $pass = "";
    var $db = "rental_mobil";
    var $kon;

    function __construct() {
        $this->kon = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (mysqli_connect_errno()){
            echo "koneksi gagal : ".mysqli_connect_error();
        }
    }

     // ADMIN CRUD OPERATIONS
     function getAllAdmin() {
        $query = "SELECT * FROM admin";
        return mysqli_query($this->kon, $query);
    }
    function getAdminById($id_admin) {
        $query = "SELECT * FROM admin WHERE id_admin = $id_admin";
        return mysqli_query($this->kon, $query);
    }
    function addAdmin($usnm, $pass, $nama, $kontak, $alamat) {
        $query = "INSERT INTO admin (usnm, pass, nama, kontak, alamat) VALUES ('$usnm', '$pass', '$nama', '$kontak', '$alamat')";
        return mysqli_query($this->kon, $query);
    }
    function updateAdmin($id_admin, $usnm, $pass, $nama, $kontak, $alamat) {
        $query = "UPDATE admin SET usnm = '$usnm', pass = '$pass', nama = '$nama', kontak = '$kontak', alamat = '$alamat' WHERE id_admin = $id_admin";
        return mysqli_query($this->kon, $query);
    }
    function deleteAdmin($id_admin) {
        $query = "DELETE FROM admin WHERE id_admin = $id_admin";
        return mysqli_query($this->kon, $query);
    }

    // mobil
    function getAllMobil() {
        $query = "SELECT * FROM mobil";
        return mysqli_query($this->kon, $query);
    }
    function getMobilByKode($kode_mobil) {
        $query = "SELECT * FROM mobil WHERE kode_mobil='$kode_mobil'";
        return mysqli_query($this->kon, $query);
    }
    function addMobil($kode_mobil, $nama, $tarif, $status, $foto) {
        $query = "INSERT INTO mobil (kode_mobil, nama, tarif, status, foto) VALUES ('$kode_mobil', '$nama', '$tarif', '$status', '$foto')";
        return mysqli_query($this->kon, $query);
    }
    function updateMobil($kode_mobil, $nama, $tarif, $status, $foto) {
        $query = "UPDATE mobil SET nama='$nama', tarif='$tarif', status='$status', foto='$foto' WHERE kode_mobil='$kode_mobil'";
        return mysqli_query($this->kon, $query);
    }
    function deleteMobil($kode_mobil) {
        $query = "DELETE FROM mobil WHERE kode_mobil='$kode_mobil'";
        return mysqli_query($this->kon, $query);
    }

    // Methods for Pemilik Mobil CRUD operations
    function getAllPemilikMobil() {
        $query = "SELECT * FROM pemilik_mobil";
        return mysqli_query($this->kon, $query);
    }
    function getPemilikMobilById($id_pemilik) {
        $query = "SELECT * FROM pemilik_mobil WHERE id_pemilik='$id_pemilik'";
        return mysqli_query($this->kon, $query);
    }
    function addPemilikMobil($nama, $kode_mobil, $alamat, $kontak, $email, $rekening) {
        $query = "INSERT INTO pemilik_mobil (nama, kode_mobil, alamat, kontak, email, rekening) VALUES ('$nama', '$kode_mobil', '$alamat', '$kontak', '$email', '$rekening')";
        return mysqli_query($this->kon, $query);
    }
    function updatePemilikMobil($id_pemilik, $nama, $kode_mobil, $alamat, $kontak, $email, $rekening) {
        $query = "UPDATE pemilik_mobil SET nama='$nama', kode_mobil='$kode_mobil', alamat='$alamat', kontak='$kontak', email='$email', rekening='$rekening' WHERE id_pemilik='$id_pemilik'";
        return mysqli_query($this->kon, $query);
    }
    function deletePemilikMobil($id_pemilik) {
        $query = "DELETE FROM pemilik_mobil WHERE id_pemilik='$id_pemilik'";
        return mysqli_query($this->kon, $query);
    }

     // Methods for Pelanggan CRUD operations
     function getAllPelanggan() {
        $query = "SELECT * FROM pelanggan";
        return mysqli_query($this->kon, $query);
    }
    function getPelangganById($id_pelanggan) {
        $query = "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
        return mysqli_query($this->kon, $query);
    }
    function addPelanggan($usnm, $pass, $nama, $alamat, $kontak, $email) {
        $query = "INSERT INTO pelanggan (usnm, pass, nama, alamat, kontak, email) VALUES ('$usnm', '$pass', '$nama', '$alamat', '$kontak', '$email')";
        return mysqli_query($this->kon, $query);
    }
    function updatePelanggan($id_pelanggan, $usnm, $pass, $nama, $alamat, $kontak, $email) {
        $query = "UPDATE pelanggan SET usnm='$usnm', pass='$pass', nama='$nama', alamat='$alamat', kontak='$kontak', email='$email' WHERE id_pelanggan='$id_pelanggan'";
        return mysqli_query($this->kon, $query);
    }
    function deletePelanggan($id_pelanggan) {
        $query = "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
        return mysqli_query($this->kon, $query);
    }

    // Methods for Sopir CRUD operations
    function getAllSopir() {
        $query = "SELECT * FROM sopir";
        return mysqli_query($this->kon, $query);
    }
    function getSopirById($id_sopir) {
        $query = "SELECT * FROM sopir WHERE id_sopir='$id_sopir'";
        return mysqli_query($this->kon, $query);
    }
    function addSopir($nama, $kontak, $alamat) {
        $query = "INSERT INTO sopir (nama, kontak, alamat) VALUES ('$nama', '$kontak', '$alamat')";
        return mysqli_query($this->kon, $query);
    }
    function updateSopir($id_sopir, $nama, $kontak, $alamat) {
        $query = "UPDATE sopir SET nama='$nama', kontak='$kontak', alamat='$alamat' WHERE id_sopir='$id_sopir'";
        return mysqli_query($this->kon, $query);
    }
    function deleteSopir($id_sopir) {
        $query = "DELETE FROM sopir WHERE id_sopir='$id_sopir'";
        return mysqli_query($this->kon, $query);
    }

    // Methods for Transaksi CRUD operations
    function getAllTransaksi() {
        $result = $this->kon->query("CALL transaksi()");
        while ($this->kon->next_result()) {
            $this->kon->use_result();
        }
        return $result;
    }    
    function getTransaksiById($id_transaksi) {
        $query = "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'";
        return mysqli_query($this->kon, $query);
    }
    function addTransaksi($id_pelanggan, $id_pesan, $id_sopir, $status) {
        $query = "INSERT INTO transaksi (id_pelanggan, id_pesan, id_sopir, status) 
                  VALUES ('$id_pelanggan', '$id_pesan', '$id_sopir', '$status')";
        return mysqli_query($this->kon, $query);
    }
    function updateTransaksi($id_transaksi, $id_pelanggan, $id_pesan, $id_sopir, $status) {
        $query = "UPDATE transaksi SET id_pelanggan='$id_pelanggan', id_pesan='$id_pesan', id_sopir='$id_sopir', status='$status' WHERE id_transaksi='$id_transaksi'";
        return mysqli_query($this->kon, $query);
    }
    function deleteTransaksi($id_transaksi) {
        $query = "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'";
        $result = mysqli_query($this->kon, $query);
        // Pastikan hasil query sebelumnya sudah dibersihkan jika ada
        return $result;
    }

    // Methods for Pesan CRUD operations
    function getAllPesan() {
        $query = "SELECT * FROM pesan";
        return mysqli_query($this->kon, $query);
    }    
    function getPesanById($id_pesan) {
        $query = "SELECT * FROM pesan WHERE id_pesan='$id_pesan'";
        return mysqli_query($this->kon, $query);
    }
    function addPesan($nama, $kode_mobil, $tanggal, $durasi, $total, $pembayaran) {
        $query = "INSERT INTO pesan (nama, kode_mobil, tanggal, durasi, total, pembayaran) 
                  VALUES ('$nama', '$kode_mobil', '$tanggal', '$durasi', '$total', '$pembayaran')";
        return mysqli_query($this->kon, $query);
    }
    function updatePesan($id_pesan, $nama, $kode_mobil, $tanggal, $durasi, $total, $pembayaran) {
        $query = "UPDATE pesan SET nama='$nama', kode_mobil='$kode_mobil', tanggal='$tanggal', durasi='$durasi', total='$total', pembayaran='$pembayaran' WHERE id_pesan='$id_pesan'";
        return mysqli_query($this->kon, $query);
    }
    function deletePesan($id_pesan) {
        $query = "DELETE FROM pesan WHERE id_pesan='$id_pesan'";
        $result = mysqli_query($this->kon, $query);
        // Pastikan hasil query sebelumnya sudah dibersihkan jika ada
        return $result;
    }
    
}

?>
