<?php
$conn = mysqli_connect("localhost", "root", "", "tokoayah");

function query($sql) {
    global $conn;
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahPembeli($data) {
    global $conn;
    $nama = htmlspecialchars($data["nama_pembeli"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);

    $query = "INSERT INTO pembeli (nama_pembeli, alamat, no_hp)
              VALUES ('$nama', '$alamat', '$no_hp')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editPembeli($data) {
    global $conn;
    $id = $data["id_pembeli"];
    $nama = htmlspecialchars($data["nama_pembeli"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);

    $query = "UPDATE pembeli SET 
                nama_pembeli='$nama',
                alamat='$alamat',
                no_hp='$no_hp'
              WHERE id_pembeli=$id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapusPembeli($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM pembeli WHERE id_pembeli=$id");
    return mysqli_affected_rows($conn);
}
?>
