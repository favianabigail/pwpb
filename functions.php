<?php
$conn = mysqli_connect("localhost", "root", "", "tokoayah");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Fungsi login yang diperbaiki
function login($username, $password) {
    global $conn;
    
    // Escape input untuk mencegah SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password (sesuai dengan data di database tokoayah)
        if ($password === $user['password']) {
            // Set session
            $_SESSION['user_id'] = $user['id_users'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
    }
    
    return false;
}

// Fungsi logout
function logout() {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Fungsi hapusPembeli
function hapusPembeli($id) {
    global $conn;
    
    // Cek apakah pembeli memiliki transaksi
    $cek_transaksi = mysqli_query($conn, "SELECT * FROM pembelian WHERE id_pembeli = $id");
    if (mysqli_num_rows($cek_transaksi) > 0) {
        return -1; // Kode error untuk pembeli dengan transaksi
    }
    
    $query = "DELETE FROM pembeli WHERE id_pembeli = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
?>