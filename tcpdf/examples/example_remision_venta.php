<?php

/* Conexion a la base de datos */
include ('../../conexion.php');
$conexion = conexion::conectar();
$id_oc= isset($_GET['id_oc']) ? intval($_GET['id_oc']) : 0;
//RECUPERAMOS ID
//$idv = $_GET['idv'];
//$idp = $_GET['idp'];
//CONSULTAMOS VALORES

$id=1 ;


$resultado = pg_query($conexion, 
    "SELECT * FROM v_venta_remision");

$resultado2 = pg_query($conexion, 
    "SELECT * FROM v_venta_remision_detalle");

$datos = pg_fetch_all($resultado);
foreach ($datos as $g){
            //$resultado1 = $g['max'];
        }
        
$datos2 = pg_fetch_all($resultado2);
foreach ($datos2 as $e){
            //$resultado1 = $g['max'];
        }

//asignando valores
 $id_oc = $g['rem_cod'];
 $mot = $g['rem_motivo'];
 $vehicod = $g['vehi_cod'];
 $vehichapa = $g['vehi_chapa'];
 $chofer = $g['chofer'];
 $fun = $g['auditoria2'];
 $confac = $g['con_fac'];
 $estado = $g['estado'];
 $fecha = $g['fecha'];
 $suc1 = $g['suc_salida'];
 $suc2 = $g['suc_llegada'];
 $cli = $g['cliente'];
 $tim = $g['tim_nro'];
 $item = $e['id_item'];
 $itemdescrip = $e['item_descrip'];
 $canti = $e['cantidad'];
 $monto = $e['monto'];
 
//echo $reserva_nro;

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Bethania Vega');
$pdf->SetTitle('NOTA DE REMISION VENTA');
$pdf->SetSubject('NOTA REMISION');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
/*$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));*/
$pdf->SetHeaderData('ferre.png', '15', 'FERRETERIA', 'TEL.: (021)123-456 ');

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
<td colspan="6" width="638"><h3 align="center" color="orange"><b>DATOS DE LA NOTA REMISION</b></h3></td>
</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"><p align="left" ><b>CODIGO</b> <br align="center">$id_oc</p></td>
        <td colspan="2"><p align="left"><b>MOTIVO</b> <br align="center">$mot</p></td>
        <td colspan="2"><p align="left"><b>CON FACTURA</b> <br align="center">$confac</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>SUCURSAL SALIDA</b> <br align="center">$suc1</p></td>
        <td colspan="2"><p align="left"><b>SUCURSAL LLEGADA</b> <br align="center">$suc2</p></td>
        <td colspan="2"><p align="left"><b>FUNCIONARIO</b> <br align="center">$fun</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>CLIENTE</b> <br align="center">$cli</p></td>
        <td colspan="2"><p align="left"><b>TIMBRADO NRO</b> <br align="center">$tim</p></td>
        <td colspan="1"><p align="left"><b>ESTADO</b> <br align="center">$estado</p></td>
        <td colspan="1"><p align="left"><b>FECHA</b> <br align="center">$fecha</p></td>
    </tr>
    <tr>
        <td colspan="6" width="638"><h3 align="center" color="orange"><b>DATOS DEL VEHICULO</b></h3></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>VEHICULO</b> <br align="center">$vehicod</p></td>
        <td colspan="2"><p align="left"><b>CHAPA</b> <br align="center">$vehichapa</p></td>
        <td colspan="2"><p align="left"><b>CHOFER</b> <br align="center">$chofer</p></td>
    </tr>    
    <tr>
        <td colspan="8" width="638"><h3 align="center" color="orange"><b>DATOS DEL DETALLE</b></h3></td>
    </tr>
     <tr>
        <td colspan="2"><p align="left"><b>ITEM</b> <br align="center"></p></td>
        <td colspan="2"><p align="left"><b>DESCRIPCION</b></p></td>
        <td colspan="2"><p align="left"><b>CANTIDAD</b></p></td>
        <td colspan="2"><p align="left"><b>MONTO</b></p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><br align="center">$item</p></td>
        <td colspan="2"><p align="left"><br align="center">$itemdescrip</p></td>
        <td colspan="2"><p align="left"><br align="center">$canti</p></td>
        <td colspan="2"><p align="left"><br align="center">$monto</p></td>
    </tr>
        
</table>
EOD;
        


$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML($tbl, TRUE, false, false, false, '');
$pdf->Ln(2);
ob_clean();
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_remision_venta.pdf', 'I');

//============================================================+
// END OF FILExample_presupuesto_venta.pdf',
//============================================================+
