<?php 
require_once("koneksi_db.php"); // Memasukkan file koneksi untuk mendapatkan variabel $conn

// Pastikan bahwa $_GET['id'] telah diatur dan bukan null
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menggunakan parameter binding untuk menghindari SQL Injection
    $sql = "DELETE FROM tblKategori WHERE idKategori = ?";
    
    // Persiapkan statement
    $stmt = $conn->prepare($sql);

    // Bind parameter
    $stmt->bind_param("i", $id);

    // Eksekusi statement
    if($stmt->execute()) {
        // Jika berhasil dihapus, arahkan kembali ke halaman index.php
        header("Location: index.php");
        exit; // Pastikan tidak ada output lain yang dihasilkan setelah header
    } else {
        // Jika terjadi kesalahan saat menghapus
        echo "Error: " . $conn->error;
    }

    // Tutup statement
    $stmt->close();
} else {
    // Jika $_GET['id'] tidak diatur, berikan pesan kesalahan
    echo "ID tidak diberikan.";
}

// Tutup koneksi
$conn->close();
?>
