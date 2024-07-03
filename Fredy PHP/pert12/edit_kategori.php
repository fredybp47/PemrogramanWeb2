<?php 
require_once("koneksi_db.php"); // Memasukkan file koneksi untuk mendapatkan variabel $conn

// Pastikan bahwa $_GET['id'] telah diatur dan bukan null
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menggunakan parameter binding untuk menghindari SQL Injection
    $sql = "SELECT * FROM tblKategori WHERE idKategori = ?";
    
    // Persiapkan statement
    $stmt = $conn->prepare($sql);

    // Bind parameter
    $stmt->bind_param("i", $id);

    // Eksekusi statement
    $stmt->execute();

    // Ambil hasil query
    $result = $stmt->get_result();

    // Ambil data kategori
    $data = $result->fetch_assoc();

    // Tutup statement
    $stmt->close();
} else {
    // Jika $_GET['id'] tidak diatur, berikan pesan kesalahan
    echo "ID tidak diberikan.";
}

// Jika form disubmit, lakukan pembaruan kategori
if(isset($_POST['simpan'])) {
    $kategori = $_POST['kategori'];

    $sql_update = "UPDATE tblKategori SET namaKategori = ? WHERE idKategori = ?";
    
    // Persiapkan statement
    $stmt_update = $conn->prepare($sql_update);

    // Bind parameter
    $stmt_update->bind_param("si", $kategori, $id);

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
    <form action="edit_kategori.php?id=<?= $id; ?>" method="POST">
        <fieldset>
            <legend>Edit Kategori</legend>

            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" id="kategori" value="<?= $data['namaKategori']; ?>" required>
            <br>

            <input type="submit" value="Simpan" name="simpan">
        </fieldset>
    </form>
</section>
