<?php

/* Conexion a la base de datos */
include ('../../conexion.php');
$conexion = conexion::conectar();
$id_oc= isset($_GET['con_cod']) ? intval($_GET['con_cod']) : 0;
//RECUPERAMOS ID
//$idv = $_GET['idv'];
//$idp = $_GET['idp'];
//CONSULTAMOS VALORES

$id=$id_ped ;


$resultado = pg_query($conexion, 
    "SELECT * from v_conciliacion");

$datos = pg_fetch_all($resultado);
foreach ($datos as $g){
            //$resultado1 = $g['max'];
        }

//asignando valores
 $id_oc = $g['con_cod'];
 $fecha = $g['fecha'];
 $con_estado= $g['con_estado'];
 $bdep_cod = $g['bdep_cod'];
 $bdep_importe = $g['bdep_importe'];
 $cuen_bank = $g['cuen_bank'];
 $cuen_nro = $g['cuen_nro'];
 $che_cod = $g['che_cod'];
 $che_nrocuenta = $g['che_nrocuenta'];
 $liq_cod = $g['liq_cod'];
 $liq_nro = $g['liq_nro'];
 $liq_concepto = $g['liq_concepto'];
 $otr_cod = $g['otr_cod'];
 $otr_tipo = $g['otr_tipo'];
 $otr_motivo = $g['otr_motivo'];
 $id_suc = $g['id_suc'];
 $suc = $g['suc_nombre'];
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
$pdf->SetSubject('CONCILIACIÓN BANCARIA');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
/*$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));*/
$pdf->SetHeaderData('ferre.png', '12', 'CONCILIACIÓN BANCARIA', 'FERRESHOP S.A');

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
<td colspan="6" width="638"><p align="center" color="orange"><b>DATOS DE LA CONCILIACIÓN BANCARIA</b></p></td>
</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"><p align="left"><b>COD. CONCILIACIÓN</b> <br align="center"><b>$id_oc</b></p></td>
        <td colspan="2"><p align="left"><b>FECHA DE OPERACIÓN</b> <br align="center"><b>$fecha</b></p></td>
        <td colspan="2"><p align="left"><b>ESTADO</b> <br align="center"><b>$con_estado</b></p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>DATOS: BOLETA DEP.</b> <br align="center">cod: <b>$bdep_cod</b> - Importe: <b>$bdep_importe</b></p></td>
        <td colspan="2"><p align="left"><b>DATOS: CUENTA BANCARIA</b> <br align="center">cod: <b>$cuen_bank</b> - cuenta n°: <b>$cuen_nro</b></p></td>
        <td colspan="2"><p align="left"><b>DATOS: CHEQUE</b> <br align="center">cod: <b>$che_cod</b> - nro cuenta: <b>$che_nrocuenta</b></p></td>
    </tr>
    <tr>
        <td colspan="3"><p align="left"><b>DATOS: LIQUIDACIÓN</b> <br align="center">cod: <b>$liq_cod</b> - nro: <b>$liq_nro</b> - concepto: <b>$liq_concepto</b></p></td>
        <td colspan="3"><p align="left"><b>DATOS: OTROS DÉBITOS / CRÉDITOS</b> <br align="center">cod: <b>$otr_cod</b> - motivo: <b>$otr_motivo</b></p></td>
    </tr>
        <tr>
        <td colspan="3"><p align="left"><b>DATOS: SUCURSAL</b> <br align="center">codigo: <b>$id_suc</b> - descripcion: <b>$suc_nombre</b></p></td>
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
$pdf->Output('example_conciliacion.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
