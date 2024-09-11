<?php

/* Conexion a la base de datos */
include ('../../conexion.php');
$conexion = conexion::conectar();
$id_oc= isset($_GET['rep_cod']) ? intval($_GET['rep_cod']) : 0;
//RECUPERAMOS ID
//$idv = $_GET['idv'];
//$idp = $_GET['idp'];
//CONSULTAMOS VALORES

$id=$id_ped ;


$resultado = pg_query($conexion, 
    "SELECT * from v_reposicion");

$datos = pg_fetch_all($resultado);
foreach ($datos as $g){
            //$resultado1 = $g['max'];
        }

//asignando valores
 $id_oc = $g['rep_cod'];
 $id_suc = $g['id_suc'];
 $suc = $g['suc_nombre'];
 $fecha = $g['fecha'];
 $asig_cod= $g['asig_cod'];
 $asig_motivo = $g['asig_motivo'];
 $rep_monto = $g['rep_monto'];
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
$pdf->SetSubject('REPOSICION DE FONDO FIJO');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
/*$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));*/
$pdf->SetHeaderData('ferre.png', '12', 'REPOSICIÓN DE FONDO FIJO', 'FERRESHOP S.A');

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
<td colspan="6" width="638"><p align="center" color="orange"><b>DATOS DE LA REPOSICIÓN</b></p></td>
</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"><p align="left"><b>COD. REPOSICION</b> <br align="center">$id_oc</p></td>
        <td colspan="2"><p align="left"><b>SUCURSAL</b> <br align="center">$id_suc - $suc</p></td>
        <td colspan="2"><p align="left"><b>FECHA DE OPERACION</b> <br align="center">$fecha</p></td>
    </tr>
    <tr>
        <td colspan="3"><p align="left"><b>DATOS: ASIGNACIÓN DE FONDO FIJO</b> <br align="center">cod: <b>$asig_cod</b> - Motivo: <b>$asig_motivo</b></p></td>
        <td colspan="3"><p align="left"><b>MONTO DE REPOSICION</b> <br align="center">$rep_monto</p></td>
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
$pdf->Output('example_conciliacion.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+