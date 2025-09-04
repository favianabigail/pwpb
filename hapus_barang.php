<?php
$conn = mysqli_connect('localhost','root','','tokoayah');
$id = $_GET["id"];

function hapus($id) {
    global $conn;
    $query = "DELETE FROM barang WHERE id_barang='$id'";
    mysqli_query($conn,$query);
}

hapus($id); 

require "barang.php";
?>
