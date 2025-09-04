<?php
$conn = mysqli_connect('localhost','root','','tokoayah');
$id = $_POST['id'];
$nama = $_POST['namaE'];
$stok = $_POST['stokE'];
$harga = $_POST['hargaE'];

$query = "UPDATE barang SET nama_barang= '$nama', stok = '$stok', harga = '$harga' WHERE id_barang = '$id'";
mysqli_query($conn,$query);

require "barang.php";



?>