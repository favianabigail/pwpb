<?php
session_start();
require "functions.php";

if ($_SESSION['role'] != 'kasir') {
    header("Location: login.php");
    exit;
}

$barang = query("SELECT * FROM barang");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Kasir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="kasir.php">TokoAyah - Kasir</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="kasir.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="kasir_laporan.php">Laporan</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-4">
  <h1 class="mb-4">Dashboard Kasir</h1>
  <a href="logout.php" class="btn btn-danger mb-3">Logout</a>

  <!-- Form Transaksi -->
  <div class="card mb-4 shadow-sm">
    <div class="card-header bg-primary text-white">Transaksi Penjualan</div>
    <div class="card-body">
      <form action="kasir_transaksi.php" method="post" class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Pilih Barang</label>
          <select name="id_barang" class="form-select" required>
            <option value="">-- pilih barang --</option>
            <?php foreach($barang as $b): ?>
              <option value="<?= $b['id_barang'] ?>">
                <?= $b['nama_barang'] ?> (Stok: <?= $b['stok'] ?>)
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Jumlah Beli</label>
          <input type="number" name="jumlah" min="1" class="form-control" required>
        </div>
        <div class="col-12">
          <button type="submit" name="jual" class="btn btn-success">Proses Transaksi</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Tabel Barang -->
  <div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">Daftar Barang</div>
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>ID</th><th>Nama Barang</th><th>Stok</th><th>Harga Jual</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($barang as $b): ?>
          <tr>
            <td><?= $b['id_barang'] ?></td>
            <td><?= $b['nama_barang'] ?></td>
            <td><?= $b['stok'] ?></td>
            <td><?= $b['harga_jual'] ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
