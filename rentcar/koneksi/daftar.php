<?php
// Sertakan kelas database
include('koneksi.php');

// Mulai sesi
session_start();

// Membuat instance dari kelas database untuk mendapatkan koneksi
$db = new database();
$kon = $db->kon; // Mendapatkan koneksi dari objek database

// Periksa apakah formulir daftar sudah disubmit
if (isset($_POST['daftar'])) {
    // Ambil data dari form
    $usnm = $_POST['usnm'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Sanitasi input
    $usnm = mysqli_real_escape_string($kon, $usnm);
    $nama = mysqli_real_escape_string($kon, $nama);
    $alamat = mysqli_real_escape_string($kon, $alamat);
    $kontak = mysqli_real_escape_string($kon, $kontak);
    $email = mysqli_real_escape_string($kon, $email);
    $pass = mysqli_real_escape_string($kon, $pass);

    // Query untuk memasukkan data ke tabel pelanggan
    $query = "INSERT INTO pelanggan (usnm, nama, alamat, kontak, email, pass) 
              VALUES ('$usnm', '$nama', '$alamat', '$kontak', '$email', '$pass')";

    // Eksekusi query
    if (mysqli_query($kon, $query)) {
        header("Location: ../view.php");
    } else {
        header("Location: daftar.php");
    }
}
?>
