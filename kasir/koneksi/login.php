<?php
session_start();
include 'koneksi.php'; // Memanggil class database

// Buat instance dari class database
$db = new database(); // Ini menghubungkan ke database

if (isset($_POST['login'])) {
    $user = $_POST['usnm'];
    $password = $_POST['pass'];
    
    // Gunakan koneksi dari class database
    $qkas = mysqli_query($db->kon, "SELECT * FROM admin WHERE usnm='$user' AND pass='$password'");
    
    if (mysqli_num_rows($qkas) > 0) {
        $_SESSION['role'] = 'kasir';
        $_SESSION['usnm'] = $user;
        
        // Setel cookie untuk menjaga sesi login
        setcookie("logged_in", "true", time() + (86400 * 1), "/"); // Cookie berlaku selama 1 hari
        
        header("Location: ../dskas.php");
        exit;
    }
    
    // Cek login peminjam
    $qpel = mysqli_query($db->kon, "SELECT * FROM apel WHERE usnm='$user' AND pass='$password'");
    
    if (mysqli_num_rows($qpel) > 0) {
        $_SESSION['role'] = 'pelanggan';
        $_SESSION['usnm'] = $user;
        
        // Setel cookie untuk menjaga sesi login
        setcookie("logged_in", "true", time() + (86400 * 365), "/"); // Cookie berlaku selama 1 hari
        
        header("Location: ../dspel.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ra : Market</title>
    <style>
        body{
            width: 100vw;
            height: 100vh;
            display: grid;
            place-items: center;
            overflow: hidden;
            background: #ff0000;
        }
        .card{
            padding: 10rem;
            display: grid;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
        }
        span:nth-child(1){
            font-size: 10rem;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            color: #fff;
            font-weight: 700;
            text-transform: uppercase;
        }
        
        /* body {
            background-color: red;
            color: white;
            text-align: center;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        .er {
            margin-top: 120px;
            font-size: 40px;
        }*/
        a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- <div class="er">
        <h1>ERROR</h1>
        <h2>Username atau Password anda <b>salah</b></h2>
        <a href="../index.php" title="Klik untuk kembali">Silahkan Login ulang</a>
    </div> -->
    <center>
    <div class="card">
        <span>Error 404</span>
        <span style="font-size: 2rem; color:#fff;">Silahkan periksa kembali username atau password anda</span><br><br>
        <div class="flex">
            <a href="../index.php">Back</a>
        </div>
    </div>
    </center>
</body>
</html>