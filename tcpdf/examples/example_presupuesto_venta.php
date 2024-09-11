<?php

/* Conexion a la base de datos */
include ('../../conexion.php');
$conexion = conexion::conectar();
$pre_cod= isset($_GET['pre_cod']) ? intval($_GET['pre_cod']) : 0;
$cli_id = isset($_GET['cli_id']) ? $_GET['cli_id'] : 0;
//RECUPERAMOS ID
//$idv = $_GET['idv'];
//$idp = $_GET['idp'];
//CONSULTAMOS VALORES

$id=1 ;


$resultado = pg_query($conexion, 
    "SELECT * FROM v_venta_presupuesto_reporte");

$datos = pg_fetch_all($resultado);
foreach ($datos as $g){
            //$resultado1 = $g['max'];
        }

//asignando valores
 $pre_cod = $g['pre_cod'];
 $con_ped = $g['con_pedido'];
 $cli_id= $g['cliente'];
 $id_suc= $g['suc_nombre'];
 $fecha= $g['fecha'];
 $id_fun= $g['auditoria2'];
 $estado = $g['pre_estado'];
 $iditem= $g['id_item'];
 $item= $g['item_descrip'];
 $precio= $g['dpre_preciounit'];
 $cantidad= $g['dpre_cantidad'];
 $monto= $g['monto'];
 $iva= $g['iva'];
 
//echo $reserva_nro;

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Bethania Vega');
$pdf->SetTitle('PRESUPUESTO VENTA');
$pdf->SetSubject('PRESUPUESTO DEL CLIENTE');
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
<td colspan="8" width="638"><p align="center"><b>DATOS DEL PRESUPUESTO</b></p></td>
</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"><p align="left"><b>NRO PRESUPUESTO</b> <br align="center">$pre_cod</p></td>
        <td colspan="2"><p align="left"><b>CLIENTE</b> <br align="center">$cli_id</p></td>
        <td colspan="2"><p align="left"><b>SUCURSAL</b> <br align="center">$id_suc</p></td>
        <td colspan="2"><p align="left"><b>FECHA</b> <br align="center">$fecha</p></td>
    </tr>
    <tr>
        <td colspan="3"><p align="left"><b>ESTADO PRESUPUESTO</b> <br align="center">$estado</p></td>
        <td colspan="3"><p align="left"><b>FUNCIONARIO</b> <br align="center">$id_fun</p></td>
        <td colspan="2"><p align="left"><b>EN BASE A PEDIDO</b> <br align="center">$con_ped</p></td>
    </tr>
</table>

<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="12" width="638"><p align="center"><b>DATOS DEL DETALLE</b></p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="center"><b>CÓDIGO ITEM</b></p></td>
        <td colspan="2"><p align="center"><b>DESCRIPCIÓN</b></p></td>
        <td colspan="2"><p align="center"><b>PRECIO</b></p></td>
        <td colspan="2"><p align="center"><b>CANTIDAD</b></p></td> 
        <td colspan="2"><p align="center"><b>MONTO TOTAL</b></p></td> 
        <td colspan="2"><p align="center"><b>IVA</b></p></td> 
    </tr>
        <tr>
	<td colspan="2"><p align="center">$iditem</p></td>
        <td colspan="2"><p align="center">$item</p></td>
        <td colspan="2"><p align="center">$precio</p></td>
        <td colspan="2"><p align="center">$cantidad</p></td>
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
$pdf->Output('example_presupuesto_venta.pdf', 'I');

//============================================================+
// END OF FILExample_presupuesto_venta.pdf',
//============================================================+
