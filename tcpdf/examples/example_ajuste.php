<?php

/* Conexion a la base de datos */
include ('../../conexion.php');
$conexion = conexion::conectar();
$ajus_cod= isset($_GET['ajus_cod']) ? intval($_GET['ajus_cod']) : 0;
//RECUPERAMOS ID
//$idv = $_GET['idv'];
//$idp = $_GET['idp'];
//CONSULTAMOS VALORES

$id=$ajus_cod ;


$resultado = pg_query($conexion, 
    "SELECT * from v_ajuste_reporte;");

$datos = pg_fetch_all($resultado);
foreach ($datos as $g){
            //$resultado1 = $g['max'];
        }

//asignando valores
 $ajus_cod = $g['ajus_cod'];
 $fecha = $g['fecha'];
 $estado= $g['estado'];
 $mot_id = $g['mot_id'];
 $mot_descri = $g['mot_descri'];
 $id_suc = $g['id_suc'];
 $suc_nombre = $g['suc_nombre'];
 $auditoria = $g['auditoria'];
 $id_item = $g['id_item'];
 $item_descrip = $g['item_descrip'];
 $dajus_cantidad = $g['dajus_cantidad'];
 
//echo $reserva_nro;

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Bethania Vega');
$pdf->SetTitle('FERRETERÍA FERRESHOP S.A');
$pdf->SetSubject('AJUSTE DE STOCK');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
/*$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));*/
$pdf->SetHeaderData('ferre.png', '12', 'AJUSTE DE STOCK', 'FERRESHOP S.A');

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
<td colspan="6" width="638"><p align="center" color="orange"><b>DATOS DEL AJUSTE DE STOCK</b></p></td>
</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"><p align="left"><b>COD. AJUSTE</b> <br align="center">$ajus_cod</p></td>
        <td colspan="2"><p align="left"><b>FECHA DE OPERACIÓN</b> <br align="center">$fecha</p></td>
        <td colspan="2"><p align="left"><b>ESTADO</b> <br align="center">$estado</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>MOTIVO DE AJUSTE</b> <br align="center">$mot_id - $mot_descri</p></td>
        <td colspan="2"><p align="left"><b>SUCURSAL</b> <br align="center">$id_suc - $suc_nombre</p></td>
        <td colspan="2"><p align="left"><b>FUNCIONARIO RESPONSABLE</b> <br align="center">BETHANIA BEATRIZ</p></td>
    </tr>
</table>
 
<table cellspacing="0" cellpadding="1" border="1">
 <tr>
<td colspan="6" width="638"><p align="center" color="orange"><b>DATOS DEL DETALLE DE AJUSTE</b></p></td>
</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"><p align="left"><b>COD. ITEM</b></p></td>
        <td colspan="2"><p align="left"><b>DESCRIPCION DE ARTICULO</b></p></td>
        <td colspan="2"><p align="left"><b>CANTIDAD</b></p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"> <br align="center">$id_item</p></td>
        <td colspan="2"><p align="left"> <br align="center">$item_descrip</p></td>
        <td colspan="2"><p align="left"> <br align="center">$dajus_cantidad</p></td>
    </tr>
</table>   

EOD;
        


$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML($tbl, false, false, false, false, '');
/*$pdf->Ln(2);*/
ob_clean();
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_ajuste.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
