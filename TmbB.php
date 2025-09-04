<?php
$conn = mysqli_connect("localhost","root","","tokoayah");

$nama = $_POST["namaB"];
$stok = $_POST["stok"];
$harga = $_POST["HargaB"];

$query = "INSERT INTO barang (nama_barang,stok,harga) VALUES ('$nama','$stok','$harga')";
mysqli_query($conn,$query);

require "barang.php";

?>