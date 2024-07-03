<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('includes/db.php');

// Inisialisasi variabel untuk menyimpan pesan kesalahan
$errors = [];

// Proses form jika ada data yang dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form dan lakukan sanitasi
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $spesifikasi = htmlspecialchars($_POST['spesifikasi']);
    $jumlah = intval($_POST['jumlah']); // Konversi ke integer
    $kondisi = htmlspecialchars($_POST['kondisi']); // Ambil nilai kondisi

    // Validasi input jika diperlukan
    if (empty($nama_barang)) {
        $errors[] = "Nama barang harus diisi";
    }
    if (empty($spesifikasi)) {
        $errors[] = "Spesifikasi barang harus diisi";
    }
    if ($jumlah <= 0) {
        $errors[] = "Jumlah barang harus lebih besar dari 0";
    }
    if (empty($kondisi)) {
        $errors[] = "Kondisi barang harus diisi";
    }

    // Jika tidak ada kesalahan, lakukan penyimpanan data ke database
    if (empty($errors)) {
        // Query untuk menyimpan data ke dalam database
        $sql = "INSERT INTO barang (nama_barang, spesifikasi, jumlah, kondisi) 
                VALUES ('$nama_barang', '$spesifikasi', $jumlah, '$kondisi')";

        if ($conn->query($sql) === TRUE) {
            echo "Data barang berhasil ditambahkan";
            // Redirect atau lakukan sesuatu setelah berhasil menyimpan
            // Misalnya, redirect kembali ke halaman daftar barang
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Baru</title>
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
        h1 {
            color: #333;
            margin-bottom: 10px;
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
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
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
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Barang Baru</h1>
        <?php if (!empty($errors)): ?>
            <div class="error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" id="nama_barang" name="nama_barang" value="<?php echo isset($_POST['nama_barang']) ? $_POST['nama_barang'] : ''; ?>" required>

            <label for="spesifikasi">Spesifikasi:</label>
            <textarea id="spesifikasi" name="spesifikasi" rows="4" required><?php echo isset($_POST['spesifikasi']) ? $_POST['spesifikasi'] : ''; ?></textarea>

            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" value="<?php echo isset($_POST['jumlah']) ? $_POST['jumlah'] : ''; ?>" required>

            <label for="kondisi">Kondisi:</label>
            <select id="kondisi" name="kondisi" required>
                <option value="">Pilih kondisi barang</option>
                <option value="Baik" <?php echo (isset($_POST['kondisi']) && $_POST['kondisi'] == 'Baik') ? 'selected' : ''; ?>>Baik</option>
                <option value="Rusak" <?php echo (isset($_POST['kondisi']) && $_POST['kondisi'] == 'Rusak') ? 'selected' : ''; ?>>Rusak</option>
                <option value="Perlu Perbaikan" <?php echo (isset($_POST['kondisi']) && $_POST['kondisi'] == 'Perlu Perbaikan') ? 'selected' : ''; ?>>Perlu Perbaikan</option>
            </select>

            <input type="submit" value="Simpan">
        </form>
    </div>
</body>
</html>
