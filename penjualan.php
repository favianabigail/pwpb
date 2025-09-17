<?php
require "functions.php";
include "navbar.php";

$bulan = $_GET['bulan'] ?? date('m');
$tahun = $_GET['tahun'] ?? date('Y');
$role  = $_SESSION['role'];

// Ambil data penjualan sesuai role
if ($role == 'kasir') {
    $id_kasir = $_SESSION['id_user'];
    $penjualan = query("SELECT p.id_penjualan, b.nama_barang, p.jumlah, p.harga_total, u.username AS kasir, p.tanggal
                        FROM penjualan p
                        JOIN barang b ON p.id_barang = b.id_barang
                        JOIN users u ON p.id_kasir = u.id_user
                        WHERE p.id_kasir='$id_kasir' 
                          AND MONTH(p.tanggal)='$bulan' 
                          AND YEAR(p.tanggal)='$tahun'
                        ORDER BY p.tanggal ASC");
} else {
    $penjualan = query("SELECT p.id_penjualan, b.nama_barang, p.jumlah, p.harga_total, u.username AS kasir, p.tanggal
                        FROM penjualan p
                        JOIN barang b ON p.id_barang = b.id_barang
                        JOIN users u ON p.id_kasir = u.id_user
                        WHERE MONTH(p.tanggal)='$bulan' 
                          AND YEAR(p.tanggal)='$tahun'
                        ORDER BY p.tanggal ASC");
}

$total = 0;
foreach ($penjualan as $p) $total += $p['harga_total'];
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-4">
    <h2 class="mb-3">Laporan Penjualan</h2>

    <!-- Filter Bulan & Tahun -->
    <form method="get" class="row g-3 mb-4">
        <div class="col-md-2">
            <label class="form-label">Bulan</label>
            <input type="number" name="bulan" value="<?= $bulan ?>" min="1" max="12" class="form-control">
        </div>
        <div class="col-md-2">
            <label class="form-label">Tahun</label>
            <input type="number" name="tahun" value="<?= $tahun ?>" min="2000" max="2100" class="form-control">
        </div>
        <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <!-- Tabel Laporan -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">Data Penjualan</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Total</th>
                        <?php if ($role != 'kasir'): ?>
                            <th>Kasir</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($penjualan)): ?>
                        <?php foreach ($penjualan as $p): ?>
                        <tr>
                            <td><?= $p['tanggal'] ?></td>
                            <td><?= $p['nama_barang'] ?></td>
                            <td><?= $p['jumlah'] ?></td>
                            <td>Rp <?= number_format($p['harga_total'], 0, ',', '.') ?></td>
                            <?php if ($role != 'kasir'): ?>
                                <td><?= $p['kasir'] ?></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="fw-bold">
                            <td colspan="<?= $role != 'kasir' ? 4 : 3 ?>" class="text-end">Total</td>
                            <td>Rp <?= number_format($total, 0, ',', '.') ?></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="<?= $role != 'kasir' ? 5 : 4 ?>" class="text-center text-muted">
                                Tidak ada data penjualan pada periode ini.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
