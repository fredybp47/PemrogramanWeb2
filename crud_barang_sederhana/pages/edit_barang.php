<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: pages/login.php");
    exit();
}

include('includes/db.php');

$id = $_GET['id'];
$sql = "SELECT * FROM barang WHERE id_barang='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $spesifikasi = $_POST['spesifikasi'];
    $jumlah = $_POST['jumlah'];
    $kondisi = $_POST['kondisi'];

    $sql_update = "UPDATE barang SET nama_barang='$nama_barang', spesifikasi='$spesifikasi', jumlah='$jumlah', kondisi='$kondisi' WHERE id_barang='$id'";

    if ($conn->query($sql_update) === TRUE) {
        echo "Barang berhasil diperbarui.";
        header("Location: pages/dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        input[type="text"], textarea, input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        textarea {
            resize: vertical;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Barang</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $id; ?>">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" id="nama_barang" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" required>

            <label for="spesifikasi">Spesifikasi:</label>
            <textarea id="spesifikasi" name="spesifikasi" rows="4" required><?php echo $row['spesifikasi']; ?></textarea>

            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" value="<?php echo $row['jumlah']; ?>" required>

            <label for="kondisi">Kondisi:</label>
            <select id="kondisi" name="kondisi" required>
                <option value="">Pilih kondisi barang</option>
                <option value="Baik" <?php echo ($row['kondisi'] == 'Baik') ? 'selected' : ''; ?>>Baik</option>
                <option value="Rusak" <?php echo ($row['kondisi'] == 'Rusak') ? 'selected' : ''; ?>>Rusak</option>
                <option value="Perlu Perbaikan" <?php echo ($row['kondisi'] == 'Perlu Perbaikan') ? 'selected' : ''; ?>>Perlu Perbaikan</option>
            </select>

            <input type="submit" value="Perbarui">
        </form>
    </div>
</body>
</html>
