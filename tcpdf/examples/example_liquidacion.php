<?php

/* Conexion a la base de datos */
include ('../../conexion.php');
$conexion = conexion::conectar();
$id_oc= isset($_GET['liq_cod']) ? intval($_GET['liq_cod']) : 0;
//RECUPERAMOS ID
//$idv = $_GET['idv'];
//$idp = $_GET['idp'];
//CONSULTAMOS VALORES

$id=$id_ped ;


$resultado = pg_query($conexion, 
    "SELECT * from v_liqtar");

$datos = pg_fetch_all($resultado);
foreach ($datos as $g){
            //$resultado1 = $g['max'];
        }

//asignando valores
 $id_oc = $g['liq_cod'];
 $liq_nro = $g['liq_nro'];
 $fecha = $g['fecha'];
 $liq_descri = $g['liq_descri'];
 $id_suc = $g['id_suc'];
 $suc_nombre = $g['suc_nombre'];
 $ent_cod = $g['ent_cod'];
 $ent_descri = $g['ent_descri'];
 $cuen_bank = $g['cuen_bank'];
 $cuen_nro = $g['cuen_nro'];
 $liq_concepto = $g['liq_concepto'];
 $liq_total = $g['liq_total'];
 $audi = $g['auditoria'];
 $estado = $g['estado'];
 
//echo $reserva_nro;

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Bethania Vega');
$pdf->SetTitle('FERRETERÍA FERRESHOP S.A');
$pdf->SetSubject('LIQUIDACIÓN CON TARJETA DE CRÉDITO');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
/*$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));*/
$pdf->SetHeaderData('ferre.png', '12', 'LIQUIDACIÓN CON TARJETA DE CRÉDITO', 'FERRESHOP S.A');

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
<td colspan="6" width="638"><p align="center" color="orange"><b>DATOS DE LA LIQUIDACIÓN</b></p></td>
</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"><p align="left"><b>COD. LIQUIDACION</b> <br align="center">$id_oc</p></td>
        <td colspan="2"><p align="left"><b>NRO. LIQUIDACION</b> <br align="center">$liq_nro</p></td>
        <td colspan="2"><p align="left"><b>FECHA DE OPERACION</b> <br align="center">$fecha</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>DESCRIPCION DE LIQUIDACION</b> <br align="center">$liq_descri</p></td>
        <td colspan="2"><p align="left"><b>SUCURSAL</b> <br align="center">$id_suc - $suc_nombre</p></td>
        <td colspan="2"><p align="left"><b>DATOS: ENTIDAD</b> <br align="center">$ent_cod - $ent_descri</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>DATOS: CUENTA BANCARIA</b> <br align="center">cod: - $cuen_bank - cuenta nro: $cuen_nro</p></td>
        <td colspan="2"><p align="left"><b>CONCEPTO DE LIQUIDACION</b> <br align="center">$liq_concepto</p></td>
        <td colspan="2"><p align="left"><b>TOTAL DE LIQUIDACION</b> <br align="center">$liq_total</p></td>
    </tr>
    <tr>
        <td colspan="3"><p align="left"><b>FUNCIONARIO RESPONSABLE</b> <br align="center">$audi</p></td>
        <td colspan="3"><p align="left"><b>ESTADO ACTUAL</b> <br align="center">$estado</p></td>
        
    </tr>
</table>

EOD;
        


$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML($tbl, false, false, false, false, '');
/*$pdf->Ln(2);*/
ob_clean();
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_liquidacion.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
