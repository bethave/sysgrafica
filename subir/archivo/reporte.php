<?php
require_once('../tcpdf/tcpdf.php');
//$producto = trim($_POST['producto']);
$producto = "MOUSE INALÁMBRICO O LO QUE SEA";
//$precio = trim($_POST['precio']);
$precio = "130000";
//$codigo_barra = trim($_POST['codigo_barra']);
$codigo_barra = "1213141516";

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetPrintHeader(false);
$pdf->SetFont('helvetica', '', 11);
$pdf->AddPage();
$style = array(
	'border' => 2,
	'vpadding' => 'auto',
	'hpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 1, // width of a single module in points
	'module_height' => 1 // height of a single module in points
);
$cc = 0;
$cf = 0;
$columnas = 3;
$filas = 4;
$tamano = 60;
$pdf->ln(5);
while($cf < $filas){
	$pdf->Cell(5, 5);
	$cc = 0;
	while($cc < $columnas){
		$pdf->Cell($tamano, 5, $producto." - G. ".number_format($precio,0,',','.'), 1, 0, 'C', 0, '', 1);
		$cc = $cc + 1;
	}
	$pdf->ln();
	$cc = 0;
	while($cc < $columnas){
		$pdf->write2DBarcode($codigo_barra, 'QRCODE,H', ($cc * $tamano) + 15, ($cf * $tamano) + 15 + ($cf*5), $tamano, $tamano, $style, 'N');
		$cc = $cc + 1;
	}
	$pdf->ln();
	$cf = $cf + 1;
}
$pdf->Output('codigos_qr.pdf', 'I');