<?php
session_start();

// Pengecekan apakah user sudah login berdasarkan session
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'petugas') {
        header("Location: dashboard_petugas.php");
        exit;
    } elseif ($_SESSION['role'] == 'peminjam') {
        header("Location: dashboard_peminjam.php");
        exit;
    }
}

// Pengecekan cookie, jika sudah login, arahkan ke dashboard
if (isset($_COOKIE['logged_in']) && $_COOKIE['logged_in'] == "true") {
    if ($_SESSION['role'] == 'petugas') {
        header("Location: dashboard_petugas.php");
        exit;
    } elseif ($_SESSION['role'] == 'peminjam') {
        header("Location: dashboard_peminjam.php");
        exit;
    }
}

// Jika tidak ada session atau cookie, tetap di halaman login
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link href="../../fontawesome/css/all.min.css" rel="stylesheet">
    <link href="template/mata.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 400px;">
            <h3 class="text-center mb-4">Login</h3>
            <form action="koneksi/login.php" method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                </div>
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-container">
                        <input type="password" class="form-control" id="pass" name="password" placeholder="Enter your password">
                        <span class="eye">
                            <i id="hide1" class="fas fa-eye" onclick="togglePassword()"></i>
                            <i id="hide2" class="fas fa-eye-slash" onclick="togglePassword()"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="template/mata.js"></script>
</body>
</html>
