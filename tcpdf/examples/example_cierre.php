<?php

/* Conexion a la base de datos */
include ('../../conexion.php');
$conexion = conexion::conectar();
$id_oc= isset($_GET['cie_cod']) ? intval($_GET['cie_cod']) : 0;
$aper_cod = isset($_GET['aper_cod']) ? $_GET['aper_cod'] : 0;
//RECUPERAMOS ID
//$idv = $_GET['idv'];
//$idp = $_GET['idp'];
//CONSULTAMOS VALORES

$id=$id_oc ;


$resultado = pg_query($conexion, 
    "SELECT * FROM v_cierre_reporte");

$datos = pg_fetch_all($resultado);
foreach ($datos as $g){
            //$resultado1 = $g['max'];
        }

//asignando valores
 $id_oc = $g['cie_cod'];
 $fecha = $g['fecha'];
 $hora = $g['hora'];
 $estado = $g['cie_estado'];
 $tefectivo = $g['cie_totalefectivo'];
 $tcheque = $g['cie_totalcheque'];
 $ttarjeta = $g['cie_totaltarjeta'];
 $mtotal = $g['cie_montototal'];
 $faltante = $g['cie_faltante'];
 $sobrante = $g['cie_sobrante'];
 $den = $g['den_tipo'];
 $dencod = $g['den_cod'];
 $suc = $g['suc_nombre'];
 $caja = $g['caja_id'];
 $cajadescri = $g['caja_descri'];
 $cajaestado = $g['c_estado'];
 $aper_cod = $g['aper_cod'];
 $aper_estado = $g['estado'];
 $aper_minicial = $g['aper_minicial'];
 $funcionario = $g['auditoria2'];
 $arq_cod = $g['arq_cod'];
 $arq_fecha = $g['arq_fecha'];
 $arq_tarjeta = $g['arq_totaltarjeta'];
 $arq_cheque = $g['arq_totalcheque'];
 $arq_total = $g['arq_total'];
 $arq_faltante = $g['arq_faltante'];
 $arq_sobrante = $g['arq_sobrante'];
 $rec_cod = $g['rec_cod'];
 $rec_efectivo = $g['rec_efectivo'];
 $rec_cheque = $g['rec_cheque'];
 $rec_total= $g['rec_total'];
 
//echo $reserva_nro;

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Bethania Vega');
$pdf->SetTitle('CIERRE DE CAJA');
$pdf->SetSubject('CIERRE DE CAJA');
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
<td colspan="6" width="638"><H3 align="center" color="orange"><b>DATOS DEL CIERRE DE CAJA</b></H3></td>
</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"><p align="left"><b>CÓDIGO DE CIERRE</b> <br align="center">$id_oc</p></td>
        <td colspan="2"><p align="left"><b>FECHA DE CIERRE</b> <br align="center">$fecha</p></td>
        <td colspan="2"><p align="left"><b>HORA DE CIERRE</b> <br align="center">$hora</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>ESTADO DE CIERRE</b> <br align="center">$estado</p></td>
        <td colspan="2"><p align="left"><b>CAJA NRO</b> <br align="center">$caja - $cajadescri - $cajaestado</p></td>
        <td colspan="2"><p align="left"><b>DENOMINACIÓN</b> <br align="center">$dencod - $den</p></td>
    </tr>
    <tr>
        <td colspan="3"><p align="left"><b>SUCURSAL</b> <br align="center">$suc</p></td>
        <td colspan="3"><p align="left"><b>FUNCIONARIO</b> <br align="center">$funcionario</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>TOTAL EFECTIVO</b> <br align="center"></p></td>
        <td colspan="4"><p align="left"><br align="center">$tefectivo .GS</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>TOTAL CHEQUE</b> <br align="center"></p></td>
        <td colspan="4"><p align="left"><br align="center">$tcheque .GS</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>TOTAL TARJETA</b> <br align="center"></p></td>
        <td colspan="4"><p align="left"><br align="center">$ttarjeta .GS</p></td>
    </tr>
        <tr>
        <td colspan="2"><p align="left"><b>FALTANTE</b> <br align="center"></p></td>
        <td colspan="4"><p align="left"><br align="center">$faltante .GS</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>SOBRANTE</b> <br align="center"></p></td>
        <td colspan="4"><p align="left"><br align="center">$sobrante .GS</p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>MONTO TOTAL</b> <br align="center"></p></td>
        <td colspan="4"><p align="left"><br align="center">$mtotal .GS</p></td>
    </tr>
    <tr>
        <td colspan="6" width="638"><H3 align="center" color="orange"><b>DATOS DE LA APERTURA</b></H3></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>CÓDIGO APERTURA</b> <br align="center">$aper_cod - $aper_estado</p></td>
        <td colspan="2"><p align="left"><b>MONTO DE APERTURA</b> <br align="center"></p></td>
        <td colspan="2"><p align="left"><br align="center">$aper_minicial .GS</p></td>
    </tr>
    <tr>
        <td colspan="6" width="638"><H3 align="center" color="orange"><b>DATOS DEL ARQUEO</b></H3></td>
    </tr>
    <tr>
        <td colspan="3"><p align="left"><b>CÓDIGO DE ARQUEO</b> <br align="center">$arq_cod</p></td>
        <td colspan="3"><p align="left"><b>FECHA DE ARQUEO</b> <br align="center">$arq_fecha</p></td>
    </tr>
    <tr> 
        <td colspan="2"><p align="left"><b>TOTAL TARJETA</b> <br align="center">$arq_tarjeta .GS</p></td>
        <td colspan="2"><p align="left"><b>TOTAL CHEQUE</b> <br align="center">$arq_cheque .GS</p></td>
        <td colspan="2"><p align="left"><b>TOTAL</b> <br align="center">$arq_total .GS</p></td>
    </tr>    
    <tr>
        <td colspan="3"><p align="left"><b>SOBRANTE</b> <br align="center">$arq_faltante</p></td>
        <td colspan="3"><p align="left"><b>FALTANTE</b> <br align="center">$arq_sobrante</p></td>
    </tr> 
    <tr>
        <td colspan="8" width="638"><H3 align="center" color="orange"><b>DATOS DE LA RECAUDACIÓN</b></H3></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>CÓDIGO DE RECAUDACIÓN</b> <br align="center">$rec_cod</p></td> 
        <td colspan="2"><p align="left"><b>TOTAL TARJETA</b> <br align="center">$rec_efectivo .GS</p></td>
        <td colspan="2"><p align="left"><b>TOTAL CHEQUE</b> <br align="center">$rec_cheque .GS</p></td>
        <td colspan="2"><p align="left"><b>TOTAL</b> <br align="center">$rec_total .GS</p></td>
    </tr>    
   </table>

EOD;
        


$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML($tbl, TRUE, false, false, false, '');
$pdf->Ln(2);
ob_clean();
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_cierre.pdf', 'I');

//============================================================+
// END OF FILExample_presupuesto_venta.pdf',
//============================================================+
