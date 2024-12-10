<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: view.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="dashboard">
    <meta name="author" content="Raihan'S">
    <title>Ra : Market Rumahan</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../fontawesome/css/all.min.css">
    <link href="template/dash.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('data/pelanggan.php')">Pelanggan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('data/sopir.php')">Sopir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('data/transaksi.php')">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('mobil/mobil.php')">Mobil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('mobil/pemmobil.php')">Pemilik Mobil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="koneksi/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <iframe id="contentFrame" src="data/transaksi.php" style="width: 100%; height: 650px; border: none;"></iframe>
    </div>
    <a href="javascript:void(0);" title="Kembali" onclick="scrollToTop()" style="position: fixed; bottom: 20px; right: 20px; background-color: #3A3B3C; color: white; border-radius: 50%; padding: 10px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
        <i class="fas fa-chevron-up"></i>
    </a>
    <script>
        function loadPage(page) {
        var iframe = document.getElementById('contentFrame');
        iframe.src = page;
        
        // Tambahkan event listener 'load' untuk memastikan iframe telah dimuat
        iframe.onload = function() {
            iframe.scrollIntoView({ behavior: 'smooth' });
        };
    }
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>