<?php
session_start();
include 'db.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Menangani penyimpanan data dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $grup_id = $_POST['grup_id'];
    $nama_negara = $_POST['nama_negara'];
    $menang = $_POST['menang'];
    $seri = $_POST['seri'];
    $kalah = $_POST['kalah'];
    $poin = $_POST['poin'];

    $query = "INSERT INTO negara (grup_id, nama_negara, menang, seri, kalah, poin) VALUES ('$grup_id', '$nama_negara', '$menang', '$seri', '$kalah', '$poin')";
    if (mysqli_query($conn, $query)) {
        echo "<div class='notification'>Negara berhasil ditambahkan</div>";
        // Redirect to index.php after successful insertion
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='notification error'>Error: " . mysqli_error($conn) . "</div>";
    }
}

$groups_query = "SELECT * FROM grup";
$groups_result = mysqli_query($conn, $groups_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Negara</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input, select, button {
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #5cb85c;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .notification {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #dff0d8;
            color: #3c763d;
        }
        .notification.error {
            background-color: #f2dede;
            color: #a94442;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Negara</h2>
        <form method="POST">
            <label for="grup_id">Grup:</label>
            <select name="grup_id" id="grup_id" required>
                <?php while ($row = mysqli_fetch_assoc($groups_result)): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nama_grup']; ?></option>
                <?php endwhile; ?>
            </select>
            <label for="nama_negara">Nama Negara:</label>
            <input type="text" name="nama_negara" id="nama_negara" required>
            <label for="menang">Menang:</label>
            <input type="number" name="menang" id="menang" required>
            <label for="seri">Seri:</label>
            <input type="number" name="seri" id="seri" required>
            <label for="kalah">Kalah:</label>
            <input type="number" name="kalah" id="kalah" required>
            <label for="poin">Poin:</label>
            <input type="number" name="poin" id="poin" required>
            <button type="submit">Tambah Negara</button>
        </form>
    </div>
</body>
</html>
