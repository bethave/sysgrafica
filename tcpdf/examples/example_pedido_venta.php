<?php

/* Conexion a la base de datos */
include ('../../conexion.php');
$conexion = conexion::conectar();
$id_ped= isset($_GET['id_ped']) ? intval($_GET['id_ped']) : 0;
$iditem = isset($_GET['id_item']) ? $_GET['id_item'] : 0;
//RECUPERAMOS ID
//$idv = $_GET['idv'];
//$idp = $_GET['idp'];
//CONSULTAMOS VALORES

$id=$id_ped ;


$resultado = pg_query($conexion, 
    "SELECT * from v_venta_pedido_reporte");

$datos = pg_fetch_all($resultado);
foreach ($datos as $g){
            //$resultado1 = $g['max'];
        }

//asignando valores
 $id_ped = $g['id_ped'];
 $cli_id= $g['cliente'];
 $id_suc= $g['suc_nombre'];
 $fecha= $g['fecha'];
 $id_fun= $g['auditoria2'];
 $estado = $g['estado'];
 $iditem = $g['id_item'];
 $item= $g['item_descrip'];
 $cantidad= $g['cantidad'];
 $precio= $g['precio'];
 $iva= $g['iva'];
 
 
 
//echo $reserva_nro;

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Bethania Vega');
$pdf->SetTitle('PEDIDO VENTA');
$pdf->SetSubject('PEDIDO VENTA');
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
$pdf->SetFont('helvetica', 'B', 10);
//$pdf->Write(0, 'COMPRONATE DE RESERVA N° ', 0, 'C', true, 0, false, false, 0);
/*$pdf->Write(0, 'CODIGO N° '.$id, 'C', true, 0, true, false, 0, false, 0);*/
$pdf->Ln(2);
// -----------------------------------------------------------------------------

/*$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
 <tr>
<td colspan="10" width="638"><p align="center"><b>DATOS DEL PEDIDO VENTA</b></p></td>
</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"><p align="left"><b>NRO PEDIDO</b> <br align="center">$id_ped</p></td>
        <td colspan="2"><p align="left"><b>CLIENTE</b> <br align="center">$cli_id</p></td>
        <td colspan="2"><p align="left"><b>SUCURSAL</b> <br align="center">$id_suc</p></td>
        <td colspan="2"><p align="left"><b>FECHA PEDIDO</b> <br align="center">$fecha</p></td>
        <td colspan="2"><p align="left"><b>FUNCIONARIO</b> <br align="center">$id_fun</p></td>
    </tr>
</table>

<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="10" width="638"><p align="center"><b>DATOS DEL DETALLE</b></p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="center"><b>CÓDIGO DE ITEM</b></p></td>
        <td colspan="2"><p align="center"><b>DESCRIPCIÓN</b></p></td>
        <td colspan="2"><p align="center"><b>CANTIDAD</b></p></td>
        <td colspan="2"><p align="center"><b>PRECIO</b></p></td> 
        <td colspan="2"><p align="center"><b>IVA</b></p></td> 
    </tr>
        <tr>
	<td colspan="2"><p align="center"><br>$iditem</p></td>
        <td colspan="2"><p align="center"><br>$item</p></td>
        <td colspan="2"><p align="center"><br>$cantidad</p></td>
        <td colspan="2"><p align="center"><br>$precio</p></td>
        <td colspan="2"><p align="center"><br>$iva</p></td>
        </tr> 
        
</table>
EOD;*/

$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetTextColor(255,165,0);
$pdf->Cell(165,5,'PEDIDO VENTA ',0,1,'C');
$pdf->writeHTML($tbl, false, false, false, false, '');
$pdf->Ln(5);

$pdf->SetFont('helvetica', '', 9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(80,5,'Nro Pedido: '.$id_ped.'',0,0);
$pdf->Cell(73,5,'Cliente: '.$cli_id.'',0,0);
$pdf->Ln(8);
$pdf->Cell(80,5,'Sucursal: '.$id_suc.'',0,0);
$pdf->Cell(40,5,'Fecha Pedido: '.$fecha.'',0,0);

$pdf->Ln(8);
$pdf->Cell(80,5,'Funcionario: '.$id_fun.'',0,0);

$pdf->Ln(8);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetTextColor(255,165,0);
$pdf->Cell(170,5,'DETALLE DEL PEDIDO ',0,1,'C');

$pdf->Ln(5);

$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(253,253,150);
$pdf->Cell(36,5,'Codigo Item',1,0,'C',1);
$pdf->Cell(36,5,'Descripcion Item',1,0,'C',1);
$pdf->Cell(30,5,'Cantidad',1,0,'C',1);
$pdf->Cell(38,5,'Precio',1,0,'C',1);
$pdf->Cell(40,5,'IVA',1,1,'C',1);

$pdf->SetFont('helvetica', '', 9);
$pdf->SetFillColor(224,235,255);
$pdf->Cell(36,5,$iditem,1,0,0,0);
$pdf->Cell(36,5,$item,1,0,0,0);
$pdf->Cell(30,5,$cantidad,1,0,0,0);
$pdf->Cell(38,5,$precio,1,0,0,0);
$pdf->Cell(40,5,$iva,1,0,0,0);


ob_clean();
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_pedido_venta.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
