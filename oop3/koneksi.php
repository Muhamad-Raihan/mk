<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'perpus';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Fungsi untuk menampilkan semua buku
function getAllBuku() {
    global $mysqli;
    $query = "SELECT * FROM buku";
    return $mysqli->query($query);
}

// Fungsi untuk menambah buku
function tambahBuku($judul, $kategori, $penerbit, $stok) {
    global $mysqli;
    $query = "INSERT INTO buku (judul, kategori, penerbit, stok) VALUES ('$judul', '$kategori', '$penerbit', '$stok')";
    return $mysqli->query($query);
}

// Fungsi untuk mengambil data buku berdasarkan ID
function getBukuById($id) {
    global $mysqli;
    $query = "SELECT * FROM buku WHERE buku_id = $id";
    return $mysqli->query($query)->fetch_assoc();
}

// Fungsi untuk mengedit buku
function editBuku($id, $judul, $kategori, $penerbit, $stok) {
    global $mysqli;
    $query = "UPDATE buku SET judul='$judul', kategori='$kategori', penerbit='$penerbit', stok='$stok' WHERE buku_id = $id";
    return $mysqli->query($query);
}

// Fungsi untuk menghapus buku
function hapusBuku($id) {
    global $mysqli;
    $query = "DELETE FROM buku WHERE buku_id = $id";
    return $mysqli->query($query);
}

// Fungsi untuk menampilkan semua petugas
function getAllPetugas() {
    global $mysqli;
    $query = "SELECT * FROM petugas";
    return $mysqli->query($query);
}

// Fungsi untuk menambah petugas
function tambahPetugas($nama, $jk, $ttl, $agama) {
    global $mysqli;
    $query = "INSERT INTO petugas (nama, jk, ttl, agama) VALUES ('$nama', '$jk', '$ttl', '$agama')";
    return $mysqli->query($query);
}

// Fungsi untuk mengambil data petugas berdasarkan ID
function getPetugasById($id) {
    global $mysqli;
    $query = "SELECT * FROM petugas WHERE petugas_id = $id";
    return $mysqli->query($query)->fetch_assoc();
}

// Fungsi untuk mengedit petugas
function editPetugas($id, $nama, $jk, $ttl, $agama) {
    global $mysqli;
    $query = "UPDATE petugas SET nama='$nama', jk='$jk', ttl='$ttl', agama='$agama' WHERE petugas_id = $id";
    return $mysqli->query($query);
}

// Fungsi untuk menghapus petugas
function hapusPetugas($id) {
    global $mysqli;
    $query = "DELETE FROM petugas WHERE petugas_id = $id";
    return $mysqli->query($query);
}

// Fungsi untuk menampilkan semua peminjam
function getAllPeminjam() {
    global $mysqli;
    $query = "SELECT * FROM peminjam";
    return $mysqli->query($query);
}

// Fungsi untuk menambah peminjam
function tambahPeminjam($nama, $tgl_pinjam, $lama_pinjam, $status, $telp) {
    global $mysqli;
    $query = "INSERT INTO peminjam (nama, tgl_pinjam, lama_pinjam, status, telp) VALUES ('$nama', '$tgl_pinjam', '$lama_pinjam', '$status', '$telp')";
    return $mysqli->query($query);
}

// Fungsi untuk mengambil data peminjam berdasarkan ID
function getPeminjamById($id) {
    global $mysqli;
    $query = "SELECT * FROM peminjam WHERE peminjam_id = $id";
    return $mysqli->query($query)->fetch_assoc();
}

// Fungsi untuk mengedit peminjam
function editPeminjam($id, $nama, $tgl_pinjam, $lama_pinjam, $status, $telp) {
    global $mysqli;
    $query = "UPDATE peminjam SET nama='$nama', tgl_pinjam='$tgl_pinjam', lama_pinjam='$lama_pinjam', status='$status', telp='$telp' WHERE peminjam_id = $id";
    return $mysqli->query($query);
}

// Fungsi untuk menghapus peminjam
function hapusPeminjam($id) {
    global $mysqli;
    $query = "DELETE FROM peminjam WHERE peminjam_id = $id";
    return $mysqli->query($query);
}

// Fungsi untuk menampilkan semua peminjaman (gabung data peminjam, buku, dan petugas)
function getAllPinjam() {
    global $mysqli;
    $query = "
        SELECT p.pinjam_id, pem.nama AS peminjam_nama, pem.tgl_pinjam, b.judul, b.penerbit, b.kategori, p.jumlah, pt.nama AS petugas_nama
        FROM pinjam p
        JOIN buku b ON p.buku_id = b.buku_id
        JOIN peminjam pem ON p.peminjam_id = pem.peminjam_id
        JOIN petugas pt ON p.petugas_id = pt.petugas_id";
    return $mysqli->query($query);
}


// Fungsi untuk menambah peminjaman
function tambahPinjam($peminjam_id, $buku_id, $jumlah, $petugas_id) {
    global $mysqli;
    $query = "INSERT INTO pinjam (peminjam_id, buku_id, jumlah, petugas_id) 
              VALUES ('$peminjam_id', '$buku_id', '$jumlah', '$petugas_id')";
    return $mysqli->query($query);
}


// Fungsi untuk mengambil data peminjaman berdasarkan ID
function getPinjamById($id) {
    global $mysqli;
    $query = "SELECT * FROM pinjam WHERE pinjam_id = $id";
    return $mysqli->query($query)->fetch_assoc();
}

// Fungsi untuk mengedit data peminjaman
function editPinjam($id, $peminjam_id, $buku_id, $jumlah, $petugas_id) {
    global $mysqli;
    $query = "UPDATE pinjam 
              SET peminjam_id = '$peminjam_id', buku_id = '$buku_id', jumlah = '$jumlah', petugas_id = '$petugas_id' 
              WHERE pinjam_id = $id";
    return $mysqli->query($query);
}

// Fungsi untuk menghapus peminjaman
function hapusPinjam($id) {
    global $mysqli;
    $query = "DELETE FROM pinjam WHERE pinjam_id = $id";
    return $mysqli->query($query);
}

?>