<?php
include '../config/functions.php'; 
require_once '../config/library/fpdf.php';
date_default_timezone_set('Asia/Jakarta');

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// Set elegant theme colors
$headerColor = array(44, 62, 80);      // Dark blue-gray #2c3e50
$primaryColor = array(52, 152, 219);   // Nice blue #3498db
$rowColor1 = array(255, 255, 255);     // White
$rowColor2 = array(236, 240, 241);     // Light gray #ecf0f1
$borderColor = array(189, 195, 199);   // Gray border #bdc3c7
$textColor = array(44, 62, 80);        // Dark text #2c3e50
$highlightColor = array(241, 196, 15); // Soft yellow for emphasis #f1c40f

// Title with elegant styling
$pdf->SetFont('Helvetica', 'B', 18);
$pdf->SetTextColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
$pdf->Cell(0, 12, 'LAPORAN STOK PRODUK', 0, 1, 'C');
$pdf->SetFont('Helvetica', '', 10);
$pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
$pdf->Cell(0, 6, 'Dibuat: ' . date('j F Y H:i:s'), 0, 1, 'C');
$pdf->Ln(8);

// Column setup
$columnWidths = [
    'no' => 10,
    'kode' => 15,
    'nama' => 45,
    'ukuran' => 40,
    'total_stok' => 25,
    'harga' => 35
];

$totalTableWidth = array_sum($columnWidths);
$startX = ($pdf->GetPageWidth() - $totalTableWidth) / 2;

// Table header
$pdf->SetX($startX);
$pdf->SetFont('Helvetica', 'B', 11);
$pdf->SetFillColor($headerColor[0], $headerColor[1], $headerColor[2]);
$pdf->SetTextColor(255, 255, 255); // White text for header
$pdf->Cell($columnWidths['no'], 10, 'NO', 1, 0, 'C', true);
$pdf->Cell($columnWidths['kode'], 10, 'KODE', 1, 0, 'C', true);
$pdf->Cell($columnWidths['nama'], 10, 'NAMA PRODUK', 1, 0, 'C', true);
$pdf->Cell($columnWidths['ukuran'], 10, 'UKURAN', 1, 0, 'C', true);
$pdf->Cell($columnWidths['total_stok'], 10, 'STOK', 1, 0, 'C', true);
$pdf->Cell($columnWidths['harga'], 10, 'HARGA', 1, 1, 'C', true);

// Table data
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
$pdf->SetFont('Helvetica', '', 10);
$pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);

foreach($data as $row) {
    $pdf->SetX($startX);
    
    // Alternate row colors
    $fill = ($no % 2 == 0) ? $rowColor2 : $rowColor1;
    $pdf->SetFillColor($fill[0], $fill[1], $fill[2]);
    
    $pdf->Cell($columnWidths['no'], 8, $no++, 1, 0, 'C', true);
    $pdf->Cell($columnWidths['kode'], 8, $row['Kode'], 1, 0, 'L', true);
    $pdf->Cell($columnWidths['nama'], 8, $row['Nama'], 1, 0, 'L', true);

    $ukuran_string = "S:" . $row['Ukuran_S'] . 
                     " M:" . $row['Ukuran_M'] . 
                     " L:" . $row['Ukuran_L'] . 
                     " XL:" . $row['Ukuran_XL'];
    $pdf->Cell($columnWidths['ukuran'], 8, $ukuran_string, 1, 0, 'C', true);

    // Highlight low stock (assuming < 10 is low)
    if ($row['TotalStokUkuran'] < 6) {
        $pdf->SetTextColor(231, 76, 60); // Red for low stock
    }
    $pdf->Cell($columnWidths['total_stok'], 8, $row['TotalStokUkuran'], 1, 0, 'C', true);
    $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]); // Reset color
    
    // Format price with right alignment
    $pdf->Cell($columnWidths['harga'], 8, 'Rp ' . number_format($row['Harga'], 0, ',', '.'), 1, 1, 'R', true);
}

// Footer
$pdf->SetY(-15);
$pdf->SetFont('Helvetica', 'I', 8);
$pdf->SetTextColor(150, 150, 150);
$pdf->Cell(0, 10, 'Halaman ' . $pdf->PageNo(), 0, 0, 'C');

$filename_timestamp = date('j F Y_H:i:s'); 
$fileName = 'Laporan_Stok_Produk_'.$filename_timestamp.'.pdf';

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="'.$fileName.'"');
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

$pdf->Output('D', $fileName);
exit;
?>