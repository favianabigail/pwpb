<?php
session_start();
require "functions.php";

// Hanya super_admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'super_admin') {
    echo "<script>alert('Akses ditolak'); window.location.href='supplier.php';</script>";
    exit;
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM supplier WHERE id_supplier=$id");

header("Location: supplier.php");
exit;
