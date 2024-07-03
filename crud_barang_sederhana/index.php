<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');

// Proses pencarian jika ada inputan pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM barang WHERE nama_barang LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 10px;
        }
        h3 {
            color: #555;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Selamat datang, <?php echo $_SESSION['username']; ?></h2>
    <a href="logout.php">Logout</a>
    <h3>Daftar Barang</h3>
    <a href="halamanbarang/add_barang.php" class="btn btn-primary">Tambah Barang</a>
    <form action="" method="GET" style="margin-top: 10px;">
        <input type="text" name="search" placeholder="Cari barang..." value="<?php echo htmlspecialchars($search); ?>">
        <input type="submit" value="Cari">
    </form>
    <table>
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Spesifikasi</th>
            <th>Jumlah</th>
            <th>Kondisi</th>
            <th>Aksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_barang']}</td>
                        <td>{$row['nama_barang']}</td>
                        <td>{$row['spesifikasi']}</td>
                        <td>{$row['jumlah']}</td>
                        <td>{$row['kondisi']}</td>
                        <td>
                            <a href='../edit_barang.php?id={$row['id_barang']}'>Edit</a> | 
                            <a href='../delete_barang.php?id={$row['id_barang']}' onclick=\"return confirm('Anda yakin ingin menghapus barang ini?');\">Hapus</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
