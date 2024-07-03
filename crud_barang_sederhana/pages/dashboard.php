<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Selamat datang, <?php echo $_SESSION['username']; ?></h2>
    <a href="logout.php">Logout</a>
    <h3>Daftar Barang</h3>
    <a href="../add_barang.php">Tambah Barang</a>
    <table border="1">
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Spesifikasi</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT * FROM barang";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_barang']}</td>
                        <td>{$row['nama_barang']}</td>
                        <td>{$row['spesifikasi']}</td>
                        <td>{$row['jumlah']}</td>
                        <td>
                            <a href='../edit_barang.php?id={$row['id_barang']}'>Edit</a> | 
                            <a href='../delete_barang.php?id={$row['id_barang']}'>Hapus</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
        }
        ?>
    </table>
</body>
</html>
