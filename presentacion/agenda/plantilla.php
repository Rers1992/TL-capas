<?php

require('../../pdf/fpdf/fpdf.php');

class PDF extends FPDF {

    function Header() {
        $this->Image('images/logo.jpg', 9, 5, 20);
        $this->SetY(18);
        $this->SetFont('Arial', '', 8);
        $this->Cell(30);
        $this->MultiCell(120, 5, utf8_decode('GOBIERNO REGIONAL DE TARAPACÁ
División de Planificación y Desarrollo Regional	
Depto. Coordinación  de la Inversión Pública
'), 0, 'L', 0);
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetX(-20);
        $this->Cell(0, 10, $this->PageNo(), 0, 0, 'C');
    }

}

?>