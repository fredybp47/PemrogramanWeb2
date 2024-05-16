<?php 
require_once("koneksi_db.php"); // Memasukkan file koneksi untuk mendapatkan variabel $conn

// Query untuk mengambil data kategori dari tabel tblKategori
$query = "SELECT * FROM tblKategori";

// Eksekusi query
$result = mysqli_query($conn, $query);

// Cek apakah query berhasil dieksekusi
if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Ambil data hasil query
$kategoriList = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori</title>
</head>
<body>
    <h1>Daftar Kategori</h1>
    <a href="create_kategori.php">Tambah Kategori</a>
    <a href="index.php">Kembali ke Beranda</a>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($kategoriList as $key => $kategori) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= htmlspecialchars($kategori['namaKategori']) ?></td>
                    <td>
                        <a href="edit_kategori.php?id=<?= $kategori['idKategori'] ?>">Edit</a>
                        <a href="delete_kategori.php?id=<?= $kategori['idKategori'] ?>">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php 
// Menutup koneksi setelah selesai digunakan
mysqli_close($conn);
?>
