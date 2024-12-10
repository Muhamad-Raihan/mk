<?php
include '../koneksi/koneksi.php';
$database = new database;

if(isset($_GET['usnm'])) {
    $usnm = $_GET['usnm'];
    $admin = $database->readAdmin()->fetch_assoc();
}

if(isset($_POST['submit'])) {
    $pass = $_POST['pass'];
    $database->updateAdmin($usnm, $pass);
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Admin</h1>
    <form method="POST">
        <div class="form-group">
            <label for="usnm">Username:</label>
            <input type="text" class="form-control" id="usnm" name="usnm" value="<?= $admin['usnm'] ?>" readonly>
        </div>
        <div class="form-group">
            <label for="pass">Password:</label>
            <input type="password" class="form-control" id="pass" name="pass" value="<?= $admin['pass'] ?>" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btn-block">Update</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
