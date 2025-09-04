<?php
$conn = mysqli_connect("localhost","root","","tokoayah");
$id = $_GET["id"];
$query = "SELECT * FROM barang WHERE id_barang='$id'";
$result = mysqli_query($conn,$query);
$rows = [];
while($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Data Barang</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm p-4">
          <form action="prsEb.php" method="post">
            <?php foreach ($rows as $row) : ?>
              <input type="hidden" name="id" value="<?=$row['id_barang']; ?>">

              <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" name="namaE" id="nama" class="form-control" value="<?=$row['nama_barang']; ?>" required>
              </div>

              <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" name="stokE" id="stok" class="form-control" value="<?=$row['stok']; ?>" required>
              </div>

              <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="hargaE" id="harga" class="form-control" value="<?=$row['harga']; ?>" required>
              </div>

              <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </div>
            <?php endforeach ?>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
