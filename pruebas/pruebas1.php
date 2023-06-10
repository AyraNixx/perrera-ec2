<?php

require '../vendor/fpdf/fpdf/src/Fpdf/Fpdf.php'; // Requiere el archivo autoload.php generado por Composer


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');
$pdf->Output();

$pdf = new FPDF('P','mm','A4');




// use FPDF\FPDF;

// // Crear una nueva instancia de la clase FPDF
// $pdf = new FPDF();

// // // Agregar una página al PDF
// $pdf->AddPage();

// // Establecer la fuente y el tamaño del texto
// $pdf->SetFont('Arial', 'B', 16);

// // Escribir texto en el PDF
// $pdf->Cell(0, 10, '¡Hola, mundo!', 0, 1, 'C');

// // Generar el PDF y guardarlo en el servidor
// $pdf->Output('output.pdf', 'F');

// // Mostrar el PDF en el navegador
// $pdf->Output('output.pdf', 'I');
