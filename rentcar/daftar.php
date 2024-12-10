<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../fontawesome/css/all.min.css" rel="stylesheet">
    <link href="aset/css/index.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 400px;">
            <h3 class="text-center mb-4">Daftar Akun</h3>
            <form action="koneksi/daftar.php" method="POST">
                <div class="mb-3">
                    <label for="usnm" class="form-label">Username</label>
                    <input type="text" class="form-control" id="usnm" name="usnm" placeholder="Masukkan Username" required>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
                </div>
                <div class="mb-3">
                    <label for="kontak" class="form-label">Kontak</label>
                    <input type="text" class="form-control" id="kontak" name="kontak" placeholder="Masukkan Kontak" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                </div>
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-container">
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Masukkan Password" required>
                        <span class="eye">
                            <i id="hide1" class="fas fa-eye" onclick="togglePassword()"></i>
                            <i id="hide2" class="fas fa-eye-slash" onclick="togglePassword()"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" name="daftar" class="btn btn-primary w-100">Daftar</button>
            </form>
        </div>
    </div>

    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="aset/js/mata.js"></script>
</body>
</html>
