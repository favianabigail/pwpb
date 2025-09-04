<?php
require "functions.php";

$keyword = isset($_GET['search']) ? $_GET['search'] : '';
$pembelian = query("
    SELECT 
        pb.id_pembelian,
        p.id_pembeli,
        b.id_barang,
        p.nama_pembeli,
        pb.jumlah_beli,
        pb.total_harga
    FROM pembelian pb
    JOIN pembeli p ON pb.id_pembeli = p.id_pembeli
    JOIN barang b ON pb.id_barang = b.id_barang
    WHERE p.nama_pembeli LIKE '%$keyword%'
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Toko Ayah - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="home.php">TokoAyah</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="pembeli.php">Pembeli</a></li>
        <li class="nav-item"><a class="nav-link" href="barang.php">Barang</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <h2 class="mb-4">Data Pembelian</h2>

    <form method="GET" action="" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari nama pembeli..." value="<?= htmlspecialchars($keyword) ?>">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Cari</button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID Pembelian</th>
                        <th>ID Pembeli</th>
                        <th>ID Barang</th>
                        <th>Nama Pembeli</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pembelian)): ?>
                        <?php foreach($pembelian as $row): ?>
                        <tr>
                            <td><?= $row['id_pembelian'] ?></td>
                            <td><?= $row['id_pembeli'] ?></td>
                            <td><?= $row['id_barang'] ?></td>
                            <td><?= $row['nama_pembeli'] ?></td>
                            <td><?= $row['jumlah_beli'] ?></td>
                            <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Data tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>