<?php
session_start();
require "functions.php";

if ($_SESSION['role'] != 'kasir') {
    header("Location: login.php");
    exit;
}

if (isset($_POST['jual'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah    = $_POST['jumlah'];
    $id_user   = $_SESSION['id_user']; // ini kasir

    // ambil harga & stok barang
    $barang = query("SELECT * FROM barang WHERE id_barang=$id_barang")[0];
    if ($barang['stok'] < $jumlah) {
        echo "<script>alert('Stok tidak mencukupi');document.location.href='kasir.php';</script>";
        exit;
    }

    $total = $barang['harga_jual'] * $jumlah;

    // kurangi stok
    $stok_baru = $barang['stok'] - $jumlah;
    mysqli_query($conn, "UPDATE barang SET stok=$stok_baru WHERE id_barang=$id_barang");

    // simpan ke tabel penjualan
    $query = "INSERT INTO penjualan (id_kasir, id_barang, jumlah, harga_total, tanggal)
              VALUES ('$id_user', '$id_barang', '$jumlah', '$total', NOW())";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Transaksi berhasil');document.location.href='kasir.php';</script>";
    } else {
        echo "<script>alert('Gagal melakukan transaksi');document.location.href='kasir.php';</script>";
    }
}
?>
