<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: pages/login.php");
    exit();
}

include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $spesifikasi = $_POST['spesifikasi'];
    $jumlah = $_POST['jumlah'];

    $sql = "INSERT INTO barang (nama_barang, spesifikasi, jumlah) VALUES ('$nama_barang', '$spesifikasi', '$jumlah')";

    if ($conn->query($sql) === TRUE) {
        echo "Barang berhasil ditambahkan.";
        header("Location: pages/dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
</head>
<body>
    <h2>Tambah Barang</h2>
    <form method="post">
        Nama Barang: <input type="text" name="nama_barang" required><br>
        Spesifikasi: <textarea name="spesifikasi" required></textarea><br>
        Jumlah: <input type="number" name="jumlah" required><br>
        <input type="submit" value="Tambah">
    </form>
</body>
</html>
