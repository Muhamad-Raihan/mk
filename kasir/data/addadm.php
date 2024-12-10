<?php
include '../koneksi/koneksi.php';
$database = new database;

if(isset($_POST['submit'])) {
    $usnm = $_POST['usnm'];
    $pass = $_POST['pass'];
    $database->createAdmin($usnm, $pass);
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Tambah Admin</h1>
    <form method="POST">
        <div class="form-group">
            <label for="usnm">Username:</label>
            <input type="text" class="form-control" id="usnm" name="usnm" required>
        </div>
        <div class="form-group">
            <label for="pass">Password:</label>
            <input type="password" class="form-control" id="pass" name="pass" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btn-block">Tambah</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>