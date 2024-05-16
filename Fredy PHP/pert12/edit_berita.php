<?php 
require_once("koneksi_db.php"); // Memasukkan file koneksi untuk mendapatkan variabel $conn

// Pastikan bahwa $_GET['id'] telah diatur dan bukan null
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menggunakan parameter binding untuk menghindari SQL Injection
    $sql = "SELECT * FROM tblBerita WHERE idBerita = ?";
    
    // Persiapkan statement
    $stmt = $conn->prepare($sql);

    // Bind parameter
    $stmt->bind_param("i", $id);

    // Eksekusi statement
    $stmt->execute();

    // Ambil hasil query
    $result = $stmt->get_result();

    // Ambil data berita
    $berita = $result->fetch_assoc();

    // Tutup statement
    $stmt->close();
} else {
    // Jika $_GET['id'] tidak diatur, berikan pesan kesalahan
    echo "ID tidak diberikan.";
    exit; // Berhenti eksekusi script
}

// Query untuk mendapatkan daftar kategori
$sql_kategori = "SELECT * FROM tblKategori";
$query_kategori = mysqli_query($conn, $sql_kategori);
$kategori = mysqli_fetch_all($query_kategori, MYSQLI_ASSOC);

// Jika form disubmit, lakukan pembaruan berita
if(isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $idKategori = $_POST['kategori'];
    $isi = $_POST['isi'];
    $penulis = $_POST['penulis'];
    $tanggal = $_POST['tanggal'];

    $sql_update = "UPDATE tblBerita SET judulBerita = ?, isiBerita = ?, penulis = ?, tgldipublish = ?, idKategori = ? WHERE idBerita = ?";
    
    // Persiapkan statement
    $stmt_update = $conn->prepare($sql_update);

    // Bind parameter
    $stmt_update->bind_param("ssssii", $judul, $isi, $penulis, $tanggal, $idKategori, $id);

    // Eksekusi statement
    if($stmt_update->execute()) {
        // Jika berhasil diupdate, arahkan kembali ke halaman index.php
        header("Location: index.php");
        exit; // Pastikan tidak ada output lain yang dihasilkan setelah header
    } else {
        // Jika terjadi kesalahan saat mengupdate
        echo "Error: " . $conn->error;
    }

    // Tutup statement
    $stmt_update->close();
}

// Tutup koneksi
$conn->close();
?>

<section>
    <form action="edit_berita.php?id=<?= $id ?>" method="POST">
        <fieldset>
            <legend>Edit Berita</legend>

            <label for="judul">Judul Berita</label>
            <input type="text" name="judul" id="judul" value="<?= htmlspecialchars($berita['judulBerita']) ?>" required>
            <br>

            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" required>
                <option value="">Pilih Kategori</option>
                <?php foreach($kategori as $value) : ?>
                    <option value="<?= $value['idKategori'] ?>" <?= $value['idKategori'] == $berita['idKategori'] ? 'selected' : ''?>><?= htmlspecialchars($value['namaKategori']) ?></option>
                <?php endforeach; ?>
            </select>
            <br>

            <label for="isi">Isi Berita</label>
            <textarea name="isi" id="isi" cols="30" rows="10" required><?= htmlspecialchars($berita['isiBerita']) ?></textarea>
            <br>

            <label for="penulis">Penulis</label>
            <input type="text" name="penulis" id="penulis" value="<?= htmlspecialchars($berita['penulis']) ?>" required>
            <br>

            <label for="tanggal">Tanggal Publish</label>
            <input type="date" name="tanggal" id="tanggal" value="<?= htmlspecialchars($berita['tgldipublish']) ?>" required>
            <br>

            <input type="submit" value="Simpan" name="simpan">
        </fieldset>
    </form>
</section>
