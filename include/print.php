<?php
include '../config/functions.php'; 
require_once '../config/library/fpdf.php';
date_default_timezone_set('Asia/Jakarta');

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(0, 10, 'Laporan Stok Produk', 0, 1, 'C');
$pdf->Ln(5);

$columnWidths = [
    'no' => 10,
    'kode' => 10,
    'nama' => 40,
    'ukuran' => 40,
    'total_stok' => 25,
    'harga' => 35
];

$totalTableWidth = array_sum($columnWidths);
$startX = ($pdf->GetPageWidth() - $totalTableWidth) / 2;

$pdf->SetX($startX);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell($columnWidths['no'], 10, 'No', 1, 0, 'C');
$pdf->Cell($columnWidths['kode'], 10, 'Kode', 1, 0, 'C');
$pdf->Cell($columnWidths['nama'], 10, 'Nama Produk', 1, 0, 'C');
$pdf->Cell($columnWidths['ukuran'], 10, 'Ukuran (S/M/L/XL)', 1, 0, 'C');
$pdf->Cell($columnWidths['total_stok'], 10, 'Stok', 1, 0, 'C');
$pdf->Cell($columnWidths['harga'], 10, 'Harga', 1, 1, 'C');

$data = select("SELECT 
            Kode, 
            Nama, 
            Ukuran_S, 
            Ukuran_M, 
            Ukuran_L, 
            Ukuran_XL, 
            (Ukuran_S + Ukuran_M + Ukuran_L + Ukuran_XL) AS TotalStokUkuran,
            Harga 
            FROM barang");
$no = 1;
$pdf->SetFont('Times', '', 11);

foreach($data as $row) {
    $pdf->SetX($startX);

    $pdf->Cell($columnWidths['no'], 8, $no++, 1, 0, 'C');
    $pdf->Cell($columnWidths['kode'], 8, $row['Kode'], 1, 0);
    $pdf->Cell($columnWidths['nama'], 8, $row['Nama'], 1, 0);

    $ukuran_string = "S:" . $row['Ukuran_S'] . 
                     " M:" . $row['Ukuran_M'] . 
                     " L:" . $row['Ukuran_L'] . 
                     " XL:" . $row['Ukuran_XL'];
    $pdf->Cell($columnWidths['ukuran'], 8, $ukuran_string, 1, 0, 'C');

    $pdf->Cell($columnWidths['total_stok'], 8, $row['TotalStokUkuran'], 1, 0, 'C');
    $pdf->Cell($columnWidths['harga'], 8, 'Rp. ' . number_format($row['Harga'], 0, ',', '.'), 1, 1, 'R');
}

$filename_timestamp = date('D/M/Y_H:i:s'); 
$fileName = 'Laporan_Stok_Produk_'.$filename_timestamp.'.pdf';

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="'.$fileName.'"');
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

$pdf->Output('D', $fileName);
exit;
?>