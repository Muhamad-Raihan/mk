<?php
session_start();
session_destroy();

// Hapus cookie yang sudah disetel
setcookie("logged_in", "", time() - 31537000, "/"); // Mengatur waktu cookie ke masa lalu untuk menghapusnya

header("Location: ../index.php");
exit;
?>