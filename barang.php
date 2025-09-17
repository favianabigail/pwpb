<?php
require "functions.php";
$barang = query("SELECT * FROM barang");
include "navbar.php";
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Barang</h2>
        <?php if(in_array($_SESSION['role'], ['super_admin','admin'])): ?>
            <a href="tambah_barang.php" class="btn btn-success">+ Tambah Barang</a>
        <?php endif; ?>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($barang as $b): ?>
                    <tr>
                        <td><?= $b['nama_barang'] ?></td>
                        <td><?= $b['stok'] ?></td>
                        <td>Rp <?= number_format($b['harga_beli'],0,',','.') ?></td>
                        <td>Rp <?= number_format($b['harga_jual'],0,',','.') ?></td>
                        <td>
                            <?php if(in_array($_SESSION['role'], ['super_admin','admin'])): ?>
                                <a href="edit_barang.php?id=<?= $b['id_barang'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="hapus_barang.php?id=<?= $b['id_barang'] ?>" onclick="return confirm('Hapus barang ini?')" class="btn btn-sm btn-danger">Hapus</a>
                            <?php endif; ?>
                            <?php if(in_array($_SESSION['role'], ['admin','gudang'])): ?>
                                <a href="tambah_stok.php?id=<?= $b['id_barang'] ?>" class="btn btn-sm btn-primary">Tambah Stok</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($barang)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada barang</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
