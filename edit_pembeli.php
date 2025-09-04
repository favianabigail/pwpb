<?php
require "functions.php";
$id = $_GET["id"];
$pembeli = query("SELECT * FROM pembeli WHERE id_pembeli=$id")[0];

if (isset($_POST["submit"])) {
    if (editPembeli($_POST) > 0) {
        echo "<script>alert('Data berhasil diubah'); document.location.href='pembeli.php';</script>";
    } else {
        echo "<script>alert('Data gagal diubah');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Pembeli</title></head>
<body>
<h2>Edit Data Pembeli</h2>
<form method="post">
    <input type="hidden" name="id_pembeli" value="<?= $pembeli['id_pembeli'] ?>">
    <label>Nama:</label><br>
    <input type="text" name="nama_pembeli" value="<?= $pembeli['nama_pembeli'] ?>" required><br><br>
    <label>Alamat:</label><br>
    <input type="text" name="alamat" value="<?= $pembeli['alamat'] ?>" required><br><br>
    <label>Telepon:</label><br>
    <input type="text" name="no_hp" value="<?= $pembeli['no_hp'] ?>" required><br><br>
    <button type="submit" name="submit">Update</button>
</form>
</body>
</html>
