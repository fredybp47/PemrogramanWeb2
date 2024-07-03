<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: pages/login.php");
    exit();
}

include('includes/db.php');

$id = $_GET['id'];

$sql = "DELETE FROM barang WHERE id_barang='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Barang berhasil dihapus.";
    header("Location: pages/dashboard.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
