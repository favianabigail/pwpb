<?php
session_start();
require "functions.php";

// Cek role (super_admin & admin bisa lihat)
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['super_admin','admin'])) {
    echo "<script>alert('Akses ditolak'); window.location.href='login.php';</script>";
    exit;
}

// Tambah User (super_admin)
if (isset($_POST['tambah']) && $_SESSION['role'] == 'super_admin') {
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];

    mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username','$password','$role')");
    header("Location: user.php"); exit;
}

// Edit User (super_admin)
if (isset($_POST['edit']) && $_SESSION['role'] == 'super_admin') {
    $id       = $_POST['id_user'];
    $username = htmlspecialchars($_POST['username']);
    $role     = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET username='$username', password='$password', role='$role' WHERE id_user=$id");
    } else {
        mysqli_query($conn, "UPDATE users SET username='$username', role='$role' WHERE id_user=$id");
    }
    header("Location: user.php"); exit;
}

// Hapus User (super_admin)
if (isset($_GET['hapus']) && $_SESSION['role'] == 'super_admin') {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM users WHERE id_user=$id");
    header("Location: user.php"); exit;
}

// Ambil data
$users = query("SELECT * FROM users");
include "navbar.php";
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-4">
    <h2 class="mb-3">Kelola Users</h2>

    <!-- Form Tambah -->
    <?php if ($_SESSION['role'] == 'super_admin'): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">Tambah User</div>
        <div class="card-body">
            <form method="post" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="super_admin">super_admin</option>
                        <option value="admin">admin</option>
                        <option value="gudang">gudang</option>
                        <option value="kasir">kasir</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" name="tambah" class="btn btn-success">Tambah User</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <!-- Tabel User -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">Daftar User</div>
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <?php if ($_SESSION['role'] == 'super_admin'): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?= $u['id_user'] ?></td>
                        <td><?= $u['username'] ?></td>
                        <td><?= $u['role'] ?></td>
                        <?php if ($_SESSION['role'] == 'super_admin'): ?>
                        <td>
                            <!-- Form Edit -->
                            <form method="post" class="d-flex flex-wrap gap-2">
                                <input type="hidden" name="id_user" value="<?= $u['id_user'] ?>">
                                <input type="text" name="username" value="<?= $u['username'] ?>" class="form-control form-control-sm w-auto" required>
                                <input type="password" name="password" placeholder="Password baru (opsional)" class="form-control form-control-sm w-auto">
                                <select name="role" class="form-select form-select-sm w-auto">
                                    <option value="super_admin" <?= $u['role']=='super_admin'?'selected':'' ?>>super_admin</option>
                                    <option value="admin" <?= $u['role']=='admin'?'selected':'' ?>>admin</option>
                                    <option value="gudang" <?= $u['role']=='gudang'?'selected':'' ?>>gudang</option>
                                    <option value="kasir" <?= $u['role']=='kasir'?'selected':'' ?>>kasir</option>
                                </select>
                                <button type="submit" name="edit" class="btn btn-sm btn-warning">Update</button>
                                <a href="user.php?hapus=<?= $u['id_user'] ?>" onclick="return confirm('Hapus user ini?')" class="btn btn-sm btn-danger">Hapus</a>
                            </form>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($users)): ?>
                    <tr>
                        <td colspan="<?= $_SESSION['role']=='super_admin'?4:3 ?>" class="text-center text-muted">Belum ada user.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
