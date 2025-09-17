<?php
require "functions.php";
checkRole(['super_admin']);

// Barang
$barang = query("SELECT * FROM barang");
// Supplier
$supplier = query("SELECT * FROM supplier");
// Users
$users = query("SELECT * FROM users");
?>

<h1>Super Admin Dashboard</h1>

<h2>Barang</h2>
<a href="tambah_barang.php">Tambah Barang</a>
<table border="1">
<tr><th>Nama</th><th>Stok</th><th>Harga Beli</th><th>Harga Jual</th><th>Aksi</th></tr>
<?php foreach($barang as $b): ?>
<tr>
    <td><?= $b['nama_barang'] ?></td>
    <td><?= $b['stok'] ?></td>
    <td><?= $b['harga_beli'] ?></td>
    <td><?= $b['harga_jual'] ?></td>
    <td>
        <a href="edit_barang.php?id=<?= $b['id_barang'] ?>">Edit</a> |
        <a href="hapus_barang.php?id=<?= $b['id_barang'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<h2>Supplier</h2>
<a href="tambah_supplier.php">Tambah Supplier</a>
<table border="1">
<tr><th>Nama</th><th>Kontak</th><th>Aksi</th></tr>
<?php foreach($supplier as $s): ?>
<tr>
    <td><?= $s['nama_supplier'] ?></td>
    <td><?= $s['kontak'] ?></td>
    <td>
        <a href="edit_supplier.php?id=<?= $s['id_supplier'] ?>">Edit</a> |
        <a href="hapus_supplier.php?id=<?= $s['id_supplier'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<h2>Users</h2>
<a href="tambah_user.php">Tambah User</a>
<table border="1">
<tr><th>Username</th><th>Role</th><th>Aksi</th></tr>
<?php foreach($users as $u): ?>
<tr>
    <td><?= $u['username'] ?></td>
    <td><?= $u['role'] ?></td>
    <td>
        <a href="edit_user.php?id=<?= $u['id_user'] ?>">Edit</a> |
        <a href="hapus_user.php?id=<?= $u['id_user'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
