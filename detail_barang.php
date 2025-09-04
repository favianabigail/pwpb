<?php 
require "functions.php"; 
$id = $_GET['id'];
$data = query("SELECT * FROM barang WHERE id_barang=$id")[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <h2 class="mb-4 text-center">Detail Barang</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm p-4">
          <p><b>Nama Barang:</b> <?= $data['nama_barang'] ?></p>
          <p><b>Stok:</b> <?= $data['stok'] ?></p>
          <p><b>Harga:</b> Rp <?= number_format($data['harga'], 0, ',', '.') ?></p>

          <div class="d-flex justify-content-between mt-4 flex-wrap">
            <div class="d-flex btn-group-responsive">
              <a href="edit_barang.php?id=<?= $data['id_barang'] ?>" class="btn btn-warning btn-action">Edit</a>
              <a href="hapus_barang.php?id=<?= $data['id_barang'] ?>" class="btn btn-danger btn-action"onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </div>
        
            <a href="barang.php" class="btn btn-secondary mt-2 mt-sm-0">Kembali</a>
          </div>

        </div>
      </div>
    </div>
  </div>


</body>
</html>