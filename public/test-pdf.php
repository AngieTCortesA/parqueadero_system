<?php
require_once __DIR__ . '/../framework/libs/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'FPDF funciona correctamente 🎉',0,1,'C');
$pdf->Output();