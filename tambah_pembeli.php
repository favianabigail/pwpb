<?php
require "functions.php";

if (isset($_POST["submit"])) {
    if (tambahPembeli($_POST) > 0) {
        echo "<script>alert('Data berhasil ditambahkan'); document.location.href='pembeli.php';</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Tambah Pembeli</title></head>
<body>
<h2>Tambah Data Pembeli</h2>
<form method="post">
    <label>Nama:</label><br>
    <input type="text" name="nama_pembeli" required><br><br>
    <label>Telepon:</label><br>
    <input type="text" name="no_hp" required><br><br>
    <label>Alamat:</label><br>
    <input type="text" name="alamat" required><br><br>
    
    <button type="submit" name="submit">Simpan</button>
</form>
</body>
</html>