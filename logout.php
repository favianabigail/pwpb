<?php
session_start();

// Hapus semua session
session_unset();
session_destroy();

// Arahkan ke login
header("Location: login.php");
exit;
?>
