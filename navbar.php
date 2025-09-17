<?php
if(!isset($_SESSION)) session_start();
$role = $_SESSION['role'] ?? '';
?>
<nav style="background:#333; padding:10px;">
    <a href="<?= in_array($role,['super_admin','admin','gudang','kasir']) ? 'barang.php' : '#' ?>" 
       style="color:<?= in_array($role,['super_admin','admin','gudang','kasir']) ? '#fff' : '#888' ?>; margin-right:15px; 
              <?= !in_array($role,['super_admin','admin','gudang','kasir']) ? 'pointer-events:none; cursor:default;' : '' ?>">
        Barang
    </a>

    <a href="<?= in_array($role,['super_admin','admin']) ? 'supplier.php' : '#' ?>" 
       style="color:<?= in_array($role,['super_admin','admin']) ? '#fff' : '#888' ?>; margin-right:15px; 
              <?= !in_array($role,['super_admin','admin']) ? 'pointer-events:none; cursor:default;' : '' ?>">
        Supplier
    </a>

    <a href="<?= $role=='super_admin' ? 'user.php' : '#' ?>" 
       style="color:<?= $role=='super_admin' ? '#fff' : '#888' ?>; margin-right:15px; 
              <?= $role!='super_admin' ? 'pointer-events:none; cursor:default;' : '' ?>">
        Users
    </a>

    <a href="<?= in_array($role,['super_admin','admin','kasir']) ? 'penjualan.php' : '#' ?>" 
       style="color:<?= in_array($role,['super_admin','admin','kasir']) ? '#fff' : '#888' ?>; margin-right:15px; 
              <?= !in_array($role,['super_admin','admin','kasir']) ? 'pointer-events:none; cursor:default;' : '' ?>">
        Penjualan
    </a>

    <a href="logout.php" style="color:#fff; margin-left:20px;">Logout</a>
</nav>
