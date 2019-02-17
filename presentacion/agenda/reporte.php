<?php

//Agregamos la libreria FPDF
include 'plantilla.php';

include_once('../../../negocio/class.evidencia.php');
$obj_evidencia = new evidencia();



$evd = $obj_evidencia->obtieneEvidenciaFechas($_GET['inicio'], $_GET['final']);


$pdf = new PDF(); //Creamos un objeto de la librería
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10); //Establecemos tipo de fuente, negrita y tamaño 16
//Agregamos texto en una celda de 40px ancho y 10px de alto, Con Borde, Sin salto de linea y Alineada a la derecha
$pdf->Cell(40, 10, utf8_decode('XI.-MEDIOS DE VERIFICACIÓN'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(232, 232, 232);
$pdf->MultiCell(182, 5, utf8_decode('Se solicita adjuntar documentación de verificación de las distintas actividades realizadas, como registros, actas de acuerdos, listados, fotografías, u otros.'), 1, 'L', 1);


for ($i = 0; $i < count($evd); $i++) {
    $pdf->Cell(182, 6, utf8_decode($evd[$i][2]), 1, 1, 'C');

    $pdf->Cell(182, 150, $pdf->Image("../actividad/" . $evd[$i][3], 50, $pdf->GetY()+10, 100), 1, 1, 'C');
    $pdf->Cell(182, 6, utf8_decode($evd[$i][4]), 1, 1, 'C');
    $pdf->AddPage();
}

$pdf->Output(); //Mostramos el PDF creado
?>