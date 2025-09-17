<?php
session_start();
require "functions.php";

// Hanya super_admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'super_admin') {
    echo "<script>alert('Akses ditolak'); window.location.href='supplier.php';</script>";
    exit;
}

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama_supplier']);
    $kontak = htmlspecialchars($_POST['kontak']);
    mysqli_query($conn, "INSERT INTO supplier (nama_supplier, kontak) VALUES ('$nama','$kontak')");
    header("Location: supplier.php");
    exit;
}

include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Supplier</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Tambah Supplier</h4>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="nama_supplier" class="form-label">Nama Supplier</label>
                            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" required>
                        </div>
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="text" class="form-control" id="kontak" name="kontak">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="supplier.php" class="btn btn-secondary">Kembali</a>
                            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
