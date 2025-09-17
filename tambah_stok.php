<?php
require "functions.php";

$id = $_GET['id'];
$b = query("SELECT * FROM barang WHERE id_barang='$id'")[0];
include "navbar.php";

if (isset($_POST['tambah'])) {
    $jumlah = $_POST['jumlah'];
    mysqli_query($conn, "UPDATE barang SET stok=stok+$jumlah WHERE id_barang='$id'");
    echo "<script>alert('Stok berhasil ditambahkan!');window.location='barang.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0">Tambah Stok</h4>
                </div>
                <div class="card-body">
                    <h5 class="text-center mb-4"><?= $b['nama_barang'] ?></h5>
                    <form method="post">
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Tambahan</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="barang.php" class="btn btn-secondary">Kembali</a>
                            <button type="submit" name="tambah" class="btn btn-success">Tambah Stok</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
