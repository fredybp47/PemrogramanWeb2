<?php
session_start();
include 'db.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Mengambil data grup dan negara untuk ditampilkan di halaman utama
$groups_query = "SELECT * FROM grup";
$groups_result = mysqli_query($conn, $groups_query);

$countries_query = "SELECT n.*, g.nama_grup FROM negara n JOIN grup g ON n.grup_id = g.id";
$countries_result = mysqli_query($conn, $countries_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>UEFA 2024 FREDY</title>
    <style>
        body {
            background-image: url('path_to_your_football_background_image.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            color: #fff;
            text-align: center;
        }
        h1, h2 {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
        }
        nav {
            margin: 20px 0;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 5px 10px;
            border-radius: 5px;
        }
        nav a:hover {
            background-color: rgba(255, 255, 255, 0.7);
            color: #000;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            background-color: rgba(0, 0, 0, 0.7);
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #fff;
            background-color: rgba(0, 0, 0, 0.7);
        }
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Selamat Datang di Klasemen UEFA 2024</h1>

    <nav>
        <a href="add_group.php">Tambah Grup</a> | 
        <a href="add_country.php">Tambah Negara</a> | 
        <a href="logout.php">Logout</a>
    </nav>

    <h2>Daftar Grup</h2>
    <ul>
        <?php while ($group = mysqli_fetch_assoc($groups_result)): ?>
            <li><?php echo $group['nama_grup']; ?></li>
        <?php endwhile; ?>
    </ul>

    <h2>Daftar Negara</h2>
    <table>
        <thead>
            <tr>
                <th>Grup</th>
                <th>Nama Negara</th>
                <th>Menang</th>
                <th>Seri</th>
                <th>Kalah</th>
                <th>Poin</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($country = mysqli_fetch_assoc($countries_result)): ?>
                <tr>
                    <td><?php echo $country['nama_grup']; ?></td>
                    <td><?php echo $country['nama_negara']; ?></td>
                    <td><?php echo $country['menang']; ?></td>
                    <td><?php echo $country['seri']; ?></td>
                    <td><?php echo $country['kalah']; ?></td>
                    <td><?php echo $country['poin']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
