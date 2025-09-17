<?php
session_start();
require "functions.php";

// Cek role: hanya super_admin & admin bisa lihat
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['super_admin','admin'])) {
    echo "<script>alert('Akses ditolak'); window.location.href='login.php';</script>";
    exit;
}

$supplier = query("SELECT * FROM supplier");
include "navbar.php";
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Supplier</h2>
        <?php if ($_SESSION['role'] == 'super_admin'): ?>
            <a href="tambah_supplier.php" class="btn btn-success btn-sm">Tambah Supplier</a>
        <?php endif; ?>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">Data Supplier</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <?php if ($_SESSION['role'] == 'super_admin'): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($supplier)): ?>
                        <?php foreach($supplier as $s): ?>
                        <tr>
                            <td><?= $s['nama_supplier'] ?></td>
                            <td><?= $s['kontak'] ?></td>
                            <?php if ($_SESSION['role'] == 'super_admin'): ?>
                                <td>
                                    <a href="edit_supplier.php?id=<?= $s['id_supplier'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="hapus_supplier.php?id=<?= $s['id_supplier'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus supplier ini?')">Hapus</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="<?= ($_SESSION['role'] == 'super_admin') ? 3 : 2 ?>" class="text-center text-muted">Belum ada data supplier.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
