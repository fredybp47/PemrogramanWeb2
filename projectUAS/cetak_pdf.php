<?php
require('fpdf186/fpdf.php');
include 'db.php';

// Fetch Data
$result = mysqli_query($conn, "SELECT * FROM negara");

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Select Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30, 10, 'Klasemen UEFA 2024', 0, 0, 'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Table
    function BasicTable($header, $data)
    {
        // Header
        foreach ($header as $col) {
            $this->Cell(35, 7, $col, 1);
        }
        $this->Ln();
        // Data
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(35, 6, $col, 1);
            }
            $this->Ln();
        }
    }
}

// Instantiation of inherited class
$pdf = new PDF();
$pdf->AddPage();

// Arial bold 15
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 10, 'Tanggal dan Waktu: ' . date('d-m-Y H:i:s'), 0, 1, 'C');

// Column headings
$header = array('Tim', 'Menang', 'Seri', 'Kalah', 'Poin');
$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array($row['nama_negara'], $row['menang'], $row['seri'], $row['kalah'], $row['poin']);
}

$pdf->SetFont('Arial', '', 12);
$pdf->BasicTable($header, $data);
$pdf->Output();
?>
