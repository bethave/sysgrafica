<?php

/* Conexion a la base de datos */
include ('../../conexion.php');
$conexion = conexion::conectar();
$id_oc= isset($_GET['bdep_cod']) ? intval($_GET['bdep_cod']) : 0;
//RECUPERAMOS ID
//$idv = $_GET['idv'];
//$idp = $_GET['idp'];
//CONSULTAMOS VALORES

$id=$id_ped ;


$resultado = pg_query($conexion, 
    "SELECT * from v_bdep");

$datos = pg_fetch_all($resultado);
foreach ($datos as $g){
            //$resultado1 = $g['max'];
        }

//asignando valores
 $id_oc = $g['bdep_cod'];
 $bdep_nro = $g['bdep_nro'];
 $fecha = $g['fecha'];
 $id_suc = $g['id_suc'];
 $suc_nombre = $g['suc_nombre'];
 $tip_cod = $g['tip_cod'];
 $tip_descri = $g['tip_descri'];
 $bdep_tipoope = $g['bdep_tipoope'];
 $bdep_estado = $g['bdep_estado'];
 $che_cod = $g['che_cod'];
 $che_nrocuenta = $g['che_nrocuenta'];
 $bdep_importe = $g['bdep_importe'];
 $cuen_bank = $g['cuen_bank'];
 $cuen_nro = $g['cuen_nro'];
 $audi = $g['auditoria'];
 
//echo $reserva_nro;

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Bethania Vega');
$pdf->SetTitle('FERRETERÍA FERRESHOP S.A');
$pdf->SetSubject('BOLETA DE DEPÓSITO');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
/*$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));*/
$pdf->SetHeaderData('ferre.png', '12', 'BOLETA DE DEPÓSITO', 'FERRESHOP S.A');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
//$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
/*$pdf->SetFont('dejavusans', '', 14, '', true);*/
//$pdf->SetFont('helvetica', 'B', 12);
//$pdf->Write(0, 'COMPRONATE DE RESERVA N° ', 0, 'C', true, 0, false, false, 0);
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set font
$pdf->SetFont('helvetica', 'B', 12);
//$pdf->Write(0, 'COMPRONATE DE RESERVA N° ', 0, 'C', true, 0, false, false, 0);
/*$pdf->Write(0, 'CODIGO N° '.$id, 'C', true, 0, true, false, 0, false, 0);*/
$pdf->Ln(2);
// -----------------------------------------------------------------------------

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
 <tr>
<td colspan="6" width="638"><p align="center" color="orange"><b>DATOS DE LA BOLETA DE DEPÓSITO</b></p></td>
</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"><p align="left"><b>COD. BOLETA</b> <br align="center">$id_oc</p></td>
        <td colspan="2"><p align="left"><b>NRO. BOLETA</b> <br align="center">$bdep_nro</p></td>
        <td colspan="2"><p align="left"><b>FECHA</b> <br align="center">$fecha</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>SUCURSAL</b> <br align="center">$id_suc - $suc_nombre</p></td>
        <td colspan="2"><p align="left"><b>TIPO DE DOCUMENTO</b> <br align="center">cod: <b>$tip_cod</b> - descripción: <b>$tip_descri</b></p></td>
        <td colspan="2"><p align="left"><b>TIPO DE OPERACION</b> <br align="center">$bdep_tipoope</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>ESTADO ACTUAL DE BOLETA</b> <br align="center">$bdep_estado</p></td>
        <td colspan="2"><p align="left"><b>DATOS: CHEQUE</b> <br align="center">cod: <b>$che_cod</b> - N° cuenta: <b>$che_nrocuenta</b></p></td>
        <td colspan="2"><p align="left"><b>IMPORTE DE BOLETA</b> <br align="center">$bdep_importe</p></td>
    </tr>
        <tr>
        <td colspan="3"><p align="left"><b>DATOS: CUENTA BANCARIA</b> <br align="center">codigo: <b>$cuen_bank</b> - Cuenta N°: <b>$cuen_nro</b></p></td>
        <td colspan="3"><p align="left"><b>FUNCIONARIO RESPONSABLE</b> <br align="center">$audi</p></td>
    </tr>
</table>

EOD;
        


$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML($tbl, false, false, false, false, '');
/*$pdf->Ln(2);*/
ob_clean();
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_bdep.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
