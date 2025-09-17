<?php
session_start();
require "functions.php";

// Hanya super_admin & admin yang boleh edit
if (!in_array($_SESSION['role'], ['super_admin', 'admin'])) {
    echo "<script>alert('Akses ditolak'); window.location='barang.php';</script>";
    exit;
}

$id = $_GET['id'];
$barang = query("SELECT * FROM barang WHERE id_barang=$id")[0];

if (isset($_POST['update'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $stok = (int)$_POST['stok'];
    $harga_beli = (int)$_POST['harga_beli'];
    $harga_jual = (int)$_POST['harga_jual'];

    $query = "UPDATE barang 
              SET nama_barang='$nama', stok=$stok, harga_beli=$harga_beli, harga_jual=$harga_jual 
              WHERE id_barang=$id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Barang berhasil diperbarui'); window.location='barang.php';</script>";
    } else {
        echo "<script>alert('Gagal update barang');</script>";
    }
}
include "navbar.php";
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">Edit Barang</div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="nama" value="<?= $barang['nama_barang'] ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" value="<?= $barang['stok'] ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Beli</label>
                    <input type="number" name="harga_beli" value="<?= $barang['harga_beli'] ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Jual</label>
                    <input type="number" name="harga_jual" value="<?= $barang['harga_jual'] ?>" class="form-control" required>
                </div>
                <button type="submit" name="update" class="btn btn-warning">Update</button>
                <a href="barang.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
