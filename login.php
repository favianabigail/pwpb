<?php
session_start();
require "functions.php";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // bisa diganti password_hash kalau mau lebih aman

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        // Set session
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];

        // Redirect sesuai role
        switch ($data['role']) {
            case 'super_admin':
                header("Location: user.php"); // Bisa akses semua tabel, redirect ke halaman user
                break;
            case 'admin':
                header("Location: barang.php"); // Admin tapi terbatas
                break;
            case 'gudang':
                header("Location: barang.php"); // Langsung ke tabel barang
                break;
            case 'kasir':
                header("Location: kasir.php"); // Tetap sama
                break;
            default:
                echo "<script>alert('Role tidak dikenali'); window.location.href='login.php';</script>";
                exit;
        }
        exit;
    } else {
        echo "<script>alert('Username atau password salah'); window.location.href='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
