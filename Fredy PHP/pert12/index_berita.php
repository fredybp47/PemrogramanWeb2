<?php 
require_once("koneksi_db.php"); // Memasukkan file koneksi untuk mendapatkan variabel $conn

// Query untuk mengambil data berita dari tabel tblBerita dan tblKategori
$query = "SELECT tblBerita.*, tblKategori.namaKategori 
          FROM tblBerita 
          INNER JOIN tblKategori ON tblBerita.idKategori = tblKategori.idKategori 
          ORDER BY tblBerita.tgldipublish DESC";

// Eksekusi query
$result = mysqli_query($conn, $query);

// Cek apakah query berhasil dieksekusi
if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Ambil data hasil query
$beritaList = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita</title>
</head>
<body>
    <h1>Daftar Berita</h1>
    <a href="create_berita.php">Tambah Berita</a>
    <a href="index.php">Kembali ke Beranda</a>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Judul Berita</th>
                <th>Isi Berita</th>
                <th>Penulis</th>
                <th>Tanggal Publish</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($beritaList as $key => $berita) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= htmlspecialchars($berita['namaKategori']) ?></td>
                    <td><?= htmlspecialchars($berita['judulBerita']) ?></td>
                    <td><?= htmlspecialchars($berita['isiBerita']) ?></td>
                    <td><?= htmlspecialchars($berita['penulis']) ?></td>
                    <td><?= htmlspecialchars($berita['tgldipublish']) ?></td>
                    <td>
                        <a href="edit_berita.php?id=<?= $berita['idBerita'] ?>">Edit</a>
                        <a href="delete_berita.php?id=<?= $berita['idBerita'] ?>">Hapus</a>
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
