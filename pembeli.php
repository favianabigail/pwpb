<?php
require "functions.php";

if (isset($_POST["simpan_pembeli"])) {
    $nama   = htmlspecialchars($_POST["nama_pembeli"]);
    $no_hp  = htmlspecialchars($_POST["no_hp"]);
    $alamat = htmlspecialchars($_POST["alamat"]);

    $query = "INSERT INTO pembeli (nama_pembeli, no_hp, alamat)
              VALUES ('$nama', '$no_hp', '$alamat')";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Pembeli baru berhasil ditambahkan'); document.location.href='pembeli.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan pembeli');</script>";
    }
}

$pembeli = query("SELECT * FROM pembeli");
$barang  = query("SELECT * FROM barang");

if (isset($_POST["simpan_pembelian"])) {
    $id_pembeli = $_POST["id_pembeli"];
    $id_barang  = $_POST["id_barang"];
    $jumlah     = $_POST["jumlah"];

    $brg = query("SELECT * FROM barang WHERE id_barang = $id_barang")[0];
    $harga = $brg["harga"];
    $total = $jumlah * $harga;

    $query = "INSERT INTO pembelian (id_pembeli, id_barang, jumlah_beli, total_harga)
              VALUES ('$id_pembeli', '$id_barang', '$jumlah', '$total')";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Pembelian berhasil ditambahkan'); document.location.href='home.php';</script>";
    } else {
        echo "<script>alert('Pembelian gagal');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="home.php">TokoAyah</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="pembeli.php">Pembeli</a></li>
        <li class="nav-item"><a class="nav-link" href="barang.php">Barang</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-4">

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">Tambah Pembeli</div>
        <div class="card-body">
            <form method="post" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" required>
                </div>
                <div class="col-12">
                    <button type="submit" name="simpan_pembeli" class="btn btn-success">Simpan Pembeli</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">Tambah Pembelian</div>
        <div class="card-body">
            <form method="post" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Pilih Pembeli</label>
                    <select name="id_pembeli" class="form-select" required>
                        <option value="">-- pilih pembeli --</option>
                        <?php foreach($pembeli as $p): ?>
                            <option value="<?= $p['id_pembeli'] ?>"><?= $p['nama_pembeli'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Pilih Barang</label>
                    <select name="id_barang" class="form-select" required>
                        <option value="">-- pilih barang --</option>
                        <?php foreach($barang as $b): ?>
                            <option value="<?= $b['id_barang'] ?>"><?= $b['nama_barang'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jumlah Beli</label>
                    <input type="number" name="jumlah" min="1" class="form-control" required>
                </div>
                <div class="col-12">
                    <button type="submit" name="simpan_pembelian" class="btn btn-primary">Simpan Pembelian</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Pembeli -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">Daftar Pembeli</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID Pembeli</th>
                        <th>Nama Pembeli</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pembeli as $row): ?>
                    <tr>
                        <td><?= $row['id_pembeli'] ?></td>
                        <td><?= $row['nama_pembeli'] ?></td>
                        <td><?= $row['no_hp'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td>
                            <a href="edit_pembeli.php?id=<?= $row['id_pembeli'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="hapus_pembeli.php?id=<?= $row['id_pembeli'] ?>" onclick="return confirm('Yakin hapus pembeli ini?')" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($pembeli)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data pembeli.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
