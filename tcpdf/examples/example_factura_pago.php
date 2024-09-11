<?php

/* Conexion a la base de datos */
include ('../../conexion.php');
$conexion = conexion::conectar();
$id_oc= isset($_GET['facp_cod']) ? intval($_GET['facp_cod']) : 0;
//RECUPERAMOS ID
//$idv = $_GET['idv'];
//$idp = $_GET['idp'];
//CONSULTAMOS VALORES

$id=1 ;


$resultado = pg_query($conexion, 
    "SELECT * FROM reporte_facpago");

$datos = pg_fetch_all($resultado);
foreach ($datos as $g){
            //$resultado1 = $g['max'];
        }

//asignando valores
 $id_oc = $g['facp_cod'];
 $fecha = $g['fecha'];
 $facp_estado= $g['facp_estado'];
 $facp_concepto= $g['facp_concepto'];
 $id_suc= $g['id_suc'];
 $suc_nombre= $g['suc_nombre'];
 $proveedor = $g['proveedor'];
 $id_pro= $g['id_pro'];
 $auditoria= $g['auditoria'];
 $con_faccompra= $g['con_faccompra'];
 $fac_cod= $g['fac_cod'];
 $id_item= $g['id_item'];
 $item= $g['item_descrip'];
 $monto= $g['dfp_monto'];
 $iva= $g['dfp_iva'];
 
//echo $reserva_nro;

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Bethania Vega');
$pdf->SetTitle('FACTURA DE PAGO');
$pdf->SetSubject('FACTURA DE PAGO');
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
$pdf->Ln(5);
// -----------------------------------------------------------------------------

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
 <tr>
<td colspan="8" width="638"><p align="center"><b>DATOS DE LA FACTURA DE PAGO</b></p></td>
</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"><p align="left"><b>NRO FACTURA</b> <br align="center">$id_oc</p></td>
        <td colspan="2"><p align="left"><b>PROVEEDOR</b> <br align="center">$id_pro - $proveedor</p></td>
        <td colspan="2"><p align="left"><b>SUCURSAL</b> <br align="center">$id_suc - $suc_nombre</p></td>
        <td colspan="2"><p align="left"><b>FECHA</b> <br align="center">$fecha</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>ESTADO DE FACTURA</b> <br align="center">$facp_estado</p></td>
        <td colspan="2"><p align="left"><b>CONCEPTO</b> <br align="center">$facp_concepto</p></td>
        <td colspan="2"><p align="left"><b>EN BASE A FACTURA COMPRA</b> <br align="center">$con_faccompra</p></td>
        <td colspan="2"><p align="left"><b>FUNCIONARIO</b> <br align="center">$auditoria</p></td>
    </tr>
</table>

<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="10" width="638"><p align="center"><b>DATOS DEL DETALLE</b></p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="center"><b>COD. FACTURA COMPRA</b></p></td>
        <td colspan="2"><p align="center"><b>COD. ARTICULO</b></p></td>
        <td colspan="2"><p align="center"><b>DESCRIPCIÓN ARTICULO</b></p></td>
        <td colspan="2"><p align="center"><b>MONTO</b></p></td> 
        <td colspan="2"><p align="center"><b>IVA</b></p></td> 
    </tr>
        <tr>
	<td colspan="2"><p align="center">$fac_cod</p></td>
        <td colspan="2"><p align="center">$id_item</p></td>
        <td colspan="2"><p align="center">$item</p></td>
        <td colspan="2"><p align="center">$monto</p></td>
        <td colspan="2"><p align="center">$iva</p></td>
        </tr> 
</table>
EOD;
        


$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML($tbl, TRUE, false, false, false, '');
$pdf->Ln(2);
ob_clean();
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_factura_pago.pdf', 'I');

//============================================================+
// END OF FILExample_presupuesto_venta.pdf',
//============================================================+
