<?php
include '../koneksi/koneksi.php';
$database = new database;
$dataLog = $database->readLog();

$database->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Log Kasir</title>
</head>
<body class="container mt-5">

    <h1 class="text-center mb-4">Data Log Kasir</h1>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Kejadian</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php while($log = $dataLog->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($log['kejadian']) ?></td>
                    <td><?= htmlspecialchars($log['waktu']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
