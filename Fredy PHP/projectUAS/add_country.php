<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $grup_id = $_POST['grup_id'];
    $nama_negara = $_POST['nama_negara'];
    $menang = $_POST['menang'];
    $seri = $_POST['seri'];
    $kalah = $_POST['kalah'];
    $poin = $_POST['poin'];

    $query = "INSERT INTO negara (grup_id, nama_negara, menang, seri, kalah, poin) VALUES ('$grup_id', '$nama_negara', '$menang', '$seri', '$kalah', '$poin')";
    if (mysqli_query($conn, $query)) {
        echo "Negara berhasil ditambahkan";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$groups_query = "SELECT * FROM grup";
$groups_result = mysqli_query($conn, $groups_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Negara</title>
</head>
<body>
    <h2>Tambah Negara</h2>
    <form method="POST">
        Grup:
        <select name="grup_id">
            <?php while ($row = mysqli_fetch_assoc($groups_result)): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['nama_grup']; ?></option>
            <?php endwhile; ?>
        </select><br>
        Nama Negara: <input type="text" name="nama_negara" required><br>
        Menang: <input type="number" name="menang" required><br>
        Seri: <input type="number" name="seri" required><br>
        Kalah: <input type="number" name="kalah" required><br>
        Poin: <input type="number" name="poin" required><br>
        <button type="submit">Tambah Negara</button>
    </form>
</body>
</html>
