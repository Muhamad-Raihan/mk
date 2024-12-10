<?php

class database {
    var $host = "localhost";
    var $user = "root";
    var $pass = "";
    var $db = "kasir";
    var $kon;

    function __construct() {
        $this->kon = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (mysqli_connect_errno()){
            echo "koneksi gagal : ".mysqli_connect_error();
        }
    }

    //------------ CRUD ADMIN
    public function readAdmin() {
        $query = "SELECT * FROM admin";
        return $this->kon->query($query);
    }
    public function createAdmin($usnm, $pass) {
        $query = "INSERT INTO admin (usnm, pass) VALUES (?, ?)";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param("ss", $usnm, $pass);
        return $stmt->execute();
    }
    public function updateAdmin($usnm, $pass) {
        $query = "UPDATE admin SET pass=? WHERE usnm=?";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param("ss", $pass, $usnm);
        return $stmt->execute();
    }
    public function deleteAdmin($usnm) {
        $query = "DELETE FROM admin WHERE usnm=?";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param("s", $usnm);
        return $stmt->execute();
    }
    
    //------------ CRUD PELANGGAN

    function readPelanggan() {
        $query = "SELECT * FROM pelanggan";
        return $this->kon->query($query);
    }
    function createPelanggan($nama_pelanggan, $alamat, $telepon) {
        $query = "INSERT INTO pelanggan (nama_pelanggan, alamat, telepon) VALUES (?, ?, ?)";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param("sss", $nama_pelanggan, $alamat, $telepon);
        return $stmt->execute();
    }
    function getPelangganById($pelanggan_id) {
        $query = "SELECT * FROM pelanggan WHERE pelanggan_id=?";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param("i", $pelanggan_id);
        $stmt->execute();
        return $stmt->get_result();
    }
    function updatePelanggan($pelanggan_id, $nama_pelanggan, $alamat, $telepon) {
        $query = "UPDATE pelanggan SET nama_pelanggan=?, alamat=?, telepon=? WHERE pelanggan_id=?";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param("sssi", $nama_pelanggan, $alamat, $telepon, $pelanggan_id);
        return $stmt->execute();
    }
    function deletePelanggan($pelanggan_id) {
        $query = "DELETE FROM pelanggan WHERE pelanggan_id=?";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param("i", $pelanggan_id);
        return $stmt->execute();
    }

    //------------ CRUD PRODUK

    function readProduk() {
        $query = "SELECT * FROM produk";
        return $this->kon->query($query);
    }
    function addProduk($nama_produk, $harga, $stok) {
        $query = "INSERT INTO produk (nama_produk, harga, stok) VALUES (?, ?, ?)";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param("sii", $nama_produk, $harga, $stok);
        return $stmt->execute();
    }
    function deleteProduk($produk_id) {
        $query = "DELETE FROM produk WHERE produk_id=?";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param("i", $produk_id);
        return $stmt->execute();
    }
    function updateProduk($produk_id, $nama_produk, $harga, $stok) {
        $query = "UPDATE produk SET nama_produk=?, harga=?, stok=? WHERE produk_id=?";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param("siii", $nama_produk, $harga, $stok, $produk_id);
        return $stmt->execute();
    }

    //------------ CRUD DETIL PENJUALAN
    function readTransaksi() {
        return $this->kon->query("CALL btrai()");
    }
    // function readTransaksi() {
    //     $query = "
    //         SELECT 
    //             p.penjualan_id,
    //             p.tgl_penjualan, 
    //             pel.nama_pelanggan, 
    //             pr.nama_produk, 
    //             dp.jumlah_produk, 
    //             dp.subtotal,
    //             p.total_harga
    //         FROM 
    //             penjualan p
    //         JOIN 
    //             pelanggan pel
    //                ON p.pelanggan_id = pel.pelanggan_id
    //         JOIN 
    //             detailpenjualan dp
    //                ON p.penjualan_id = dp.penjualan_id
    //         JOIN
    //             produk pr
    //                ON dp.produk_id = pr.produk_id
    //     ";
    //     return $this->kon->query($query);
    // }
    function addTransaksi($pelanggan_id, $produk_id, $jumlah_produk) {
        // Ambil harga produk untuk menghitung subtotal
        $query_produk = "SELECT harga FROM produk WHERE produk_id = ?";
        $stmt = $this->kon->prepare($query_produk);
        $stmt->bind_param("i", $produk_id);
        $stmt->execute();
        $result_produk = $stmt->get_result();
        $produk = $result_produk->fetch_assoc();
        $harga = $produk['harga'];

        $subtotal = $jumlah_produk * $harga;

        // Masukkan data ke tabel penjualan
        $query_penjualan = "INSERT INTO penjualan (pelanggan_id, tgl_penjualan, total_harga) 
                            VALUES (?, NOW(), ?)";
        $stmt = $this->kon->prepare($query_penjualan);
        $stmt->bind_param("ii", $pelanggan_id, $subtotal);
        $stmt->execute();

        // Ambil id penjualan yang baru dimasukkan
        $penjualan_id = $this->kon->insert_id;

        // Masukkan data ke tabel detailpenjualan
        $query_detail = "INSERT INTO detailpenjualan (penjualan_id, produk_id, jumlah_produk, subtotal) 
                         VALUES (?, ?, ?, ?)";
        $stmt = $this->kon->prepare($query_detail);
        $stmt->bind_param("iiii", $penjualan_id, $produk_id, $jumlah_produk, $subtotal);
        return $stmt->execute();
    }
    function getTransaksiById($id) {
        $query = "
            SELECT p.penjualan_id, dp.produk_id, dp.jumlah_produk, p.pelanggan_id
            FROM penjualan p
            JOIN detailpenjualan dp ON p.penjualan_id = dp.penjualan_id
            WHERE p.penjualan_id = ?
        ";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    function updateTransaksi($id, $pelanggan_id, $produk_id, $jumlah_produk) {
        // Ambil harga produk untuk menghitung subtotal
        $query_produk = "SELECT harga FROM produk WHERE produk_id = ?";
        $stmt = $this->kon->prepare($query_produk);
        $stmt->bind_param("i", $produk_id);
        $stmt->execute();
        $result_produk = $stmt->get_result();
        $produk = $result_produk->fetch_assoc();
        $harga = $produk['harga'];
        $subtotal = $jumlah_produk * $harga;

        // Update data penjualan
        $query_penjualan = "UPDATE penjualan SET pelanggan_id = ?, total_harga = ? WHERE penjualan_id = ?";
        $stmt = $this->kon->prepare($query_penjualan);
        $stmt->bind_param("iii", $pelanggan_id, $subtotal, $id);
        $stmt->execute();

        // Update data detailpenjualan
        $query_detail = "UPDATE detailpenjualan SET produk_id = ?, jumlah_produk = ?, subtotal = ? WHERE penjualan_id = ?";
        $stmt = $this->kon->prepare($query_detail);
        $stmt->bind_param("iiii", $produk_id, $jumlah_produk, $subtotal, $id);
        return $stmt->execute();
    }
    function deleteTransaksi($penjualan_id) {
        // Hapus dari detailpenjualan
        $query_detail = "DELETE FROM detailpenjualan WHERE penjualan_id = ?";
        $stmt = $this->kon->prepare($query_detail);
        $stmt->bind_param("i", $penjualan_id);
        $stmt->execute();

        // Hapus dari penjualan
        $query_penjualan = "DELETE FROM penjualan WHERE penjualan_id = ?";
        $stmt = $this->kon->prepare($query_penjualan);
        $stmt->bind_param("i", $penjualan_id);
        return $stmt->execute();
    }

    //------------ READ LOG
    function readLog() {
        $query = "SELECT * FROM log_kasir ORDER BY waktu DESC";
        return $this->kon->query($query);
    }

    
    public function close() {
        $this->kon->close();
    }
}

?>