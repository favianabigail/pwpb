<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <h2 class="mb-4">Tambah Data Barang</h2>
    <form action="TmbB.php" method="post">
      <div class="mb-3">
        <label for="namaB" class="form-label">Nama Barang</label>
        <input type="text" name="namaB" id="namaB" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" name="stok" id="stok" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" name="HargaB" id="harga" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
  </div>

</body>
</html>
