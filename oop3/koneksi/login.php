<?php
session_start();
include 'koneksi.php'; // Memanggil class database

// Buat instance dari class database
$db = new database(); // Ini menghubungkan ke database

if (isset($_POST['login'])) {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    
    // Gunakan koneksi dari class database
    $query_petugas = mysqli_query($db->koneksi, "SELECT * FROM petugas WHERE nama='$nama' AND password='$password'");
    
    if (mysqli_num_rows($query_petugas) > 0) {
        $_SESSION['role'] = 'petugas';
        $_SESSION['nama'] = $nama;
        
        // Setel cookie untuk menjaga sesi login
        setcookie("logged_in", "true", time() + (86400 * 1), "/"); // Cookie berlaku selama 1 hari
        
        header("Location: ../dashboard_petugas.php");
        exit;
    }
    
    // Cek login peminjam
    $query_peminjam = mysqli_query($db->koneksi, "SELECT * FROM peminjam WHERE nama='$nama' AND password='$password'");
    
    if (mysqli_num_rows($query_peminjam) > 0) {
        $_SESSION['role'] = 'peminjam';
        $_SESSION['nama'] = $nama;
        
        // Setel cookie untuk menjaga sesi login
        setcookie("logged_in", "true", time() + (86400 * 365), "/"); // Cookie berlaku selama 1 hari
        
        header("Location: ../dashboard_peminjam.php");
        exit;
    }
    
    // Jika login gagal
    echo "Nama atau Password salah!";
}
?>