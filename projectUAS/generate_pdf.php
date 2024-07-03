<?php
session_start();
include 'db.php';
require('fpdf/fpdf.php'); // Pastikan path ini sesuai dengan struktur direktori proyek Anda

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Mengambil data negara untuk ditampilkan di PDF
$countries_query = "SELECT n.*, g.nama_grup FROM negara n JOIN grup g ON n.grup_id = g.id";
$countries_result = mysqli_query($conn, $countries_query);

// Initialize FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Judul
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Daftar Negara UEFA 2024', 0, 1, 'C');

// Header tabel
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Grup', 1, 0, 'C');
$pdf->Cell(50, 10, 'Nama Negara', 1, 0, 'C');
$pdf->Cell(30, 10, 'Menang', 1, 0, 'C');
$pdf->Cell(30, 10, 'Seri', 1, 0, 'C');
$pdf->Cell(30, 10, 'Kalah', 1, 0, 'C');
$pdf->Cell(30, 10, 'Poin', 1, 1, 'C');

// Isi tabel
$pdf->SetFont('Arial', '', 12);
while ($country = mysqli_fetch_assoc($countries_result)) {
    $pdf->Cell(40, 10, $country['nama_grup'], 1, 0, 'L');
    $pdf->Cell(50, 10, $country['nama_negara'], 1, 0, 'L');
    $pdf->Cell(30, 10, $country['menang'], 1, 0, 'C');
    $pdf->Cell(30, 10, $country['seri'], 1, 0, 'C');
    $pdf->Cell(30, 10, $country['kalah'], 1, 0, 'C');
    $pdf->Cell(30, 10, $country['poin'], 1, 1, 'C');
}

// Output PDF
$pdf->Output('daftar_negara_uefa_2024.pdf', 'D'); // D untuk download langsung

?>
