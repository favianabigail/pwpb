<?php
session_start();
require "functions.php";

// Hanya super_admin & admin yang boleh tambah
if (!in_array($_SESSION['role'], ['super_admin', 'admin'])) {
    echo "<script>alert('Akses ditolak'); window.location='barang.php';</script>";
    exit;
}

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $stok = (int)$_POST['stok'];
    $harga_beli = (int)$_POST['harga_beli'];
    $harga_jual = (int)$_POST['harga_jual'];

    $query = "INSERT INTO barang (nama_barang, stok, harga_beli, harga_jual) 
              VALUES ('$nama', $stok, $harga_beli, $harga_jual)";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Barang berhasil ditambahkan'); window.location='barang.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah barang');</script>";
    }
}
include "navbar.php";
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">Tambah Barang</div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Beli</label>
                    <input type="number" name="harga_beli" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Jual</label>
                    <input type="number" name="harga_jual" class="form-control" required>
                </div>
                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                <a href="barang.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
