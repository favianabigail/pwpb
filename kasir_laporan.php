<?php
session_start();
require "functions.php";

if ($_SESSION['role'] != 'kasir') {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$laporan = query("
    SELECT 
        MONTH(tanggal) AS bulan, 
        YEAR(tanggal) AS tahun,
        COUNT(*) AS total_transaksi,
        SUM(jumlah) AS total_barang,
        SUM(harga_total) AS total_pendapatan
    FROM penjualan
    WHERE id_kasir = $id_user
    GROUP BY YEAR(tanggal), MONTH(tanggal)
    ORDER BY tahun DESC, bulan DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laporan Kasir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-4">
  <h2>Laporan Bulanan - Kasir <?= $_SESSION['username'] ?></h2>
  <a href="kasir.php" class="btn btn-secondary mb-3">⬅ Kembali</a>

  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">Laporan Per Bulan</div>
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Total Transaksi</th>
            <th>Total Barang</th>
            <th>Total Pendapatan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($laporan as $l): ?>
          <tr>
            <td><?= $l['bulan'] ?></td>
            <td><?= $l['tahun'] ?></td>
            <td><?= $l['total_transaksi'] ?></td>
            <td><?= $l['total_barang'] ?></td>
            <td>Rp <?= number_format($l['total_pendapatan'], 0, ',', '.') ?></td>
          </tr>
          <?php endforeach; ?>

          <?php if(empty($laporan)): ?>
          <tr>
            <td colspan="5" class="text-center text-muted">Belum ada transaksi.</td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
