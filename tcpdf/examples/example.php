<?php

/* Conexion a la base de datos */
include ('../../conexion.php');
$conexion = conexion::conectar();
$viaje = isset($_GET['viaje']) ? intval($_GET['viaje']) : 0;
$doc = isset($_GET['doc']) ? $_GET['doc'] : 0;
//RECUPERAMOS ID
//$idv = $_GET['idv'];
//$idp = $_GET['idp'];
//CONSULTAMOS VALORES

$id= 1;


$resultado = pg_query($conexion, "SELECT rc.reserva_nro,
	r.res_fecha,
    p.per_ci,
    p.per_ruc,
    concat(p.per_nombre, ' ', p.per_apellido) AS concat,
    concat(r.res_fec_expira, ' ', r.res_hora_expira) AS exp,
    s.serv_descrip,
    rc.viaje_nr,
    rt.ruta_dsc,
    concat(v.viaje_fec_sa, ' ', vp.viaje_pro_hora) AS salida,
    rc.asi_nro,
    r.res_estado
   FROM reserva_cli rc,
    personas p,
    reservas r,
    servicios s,
    viajes v,
    viaje_programado vp,
    ruta rt
  WHERE v.viaje_nr = '$viaje'
  AND p.per_ci = '$doc'
  AND r.reserva_nro = (select max (reserva_nro) from reservas)
  AND rc.id_per = p.id_per 
  AND rc.reserva_nro = r.reserva_nro
  AND r.res_servicio = s.id_serv 
  AND rc.viaje_nr = v.viaje_nr 
  AND vp.viaje_pro_cod = v.viaje_pro_cod 
  AND vp.ruta_co = rt.ruta_co 
  AND v.viaje_nr = rc.viaje_nr 
  AND vp.id_serv = s.id_serv 
  AND r.res_estado = 'ACTIVO'
  AND rc.res_estado = 'ACTIVO'");

$datos = pg_fetch_all($resultado);
foreach ($datos as $g){
            //$resultado1 = $g['max'];
        }

//asignando valores
$reserva_nro = $g["reserva_nro"];
$res_fecha = $g["res_fecha"];
$per_ci = $g["per_ci"];
$per_ruc = $g["per_ruc"];
$persona = $g["concat"];
$exp = $g["exp"];
$serv_descrip = $g["serv_descrip"];
$viaje_nr = $g["viaje_nr"];
$ruta_dsc = $g["ruta_dsc"];
$salida = $g["salida"];
$asi_nro = $g["asi_nro"];
$res_estado = $g["res_estado"];
//echo $reserva_nro;

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ever Insaurralde');
$pdf->SetTitle('NSA PASAJES');
$pdf->SetSubject('COMPROBRESERVA');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
/*$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));*/
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '');

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
$pdf->Write(0, 'COMPRONATE DE RESERVA N° '.$id, 'C', true, 0, true, false, 0, false, 0);
$pdf->Ln(5);
// -----------------------------------------------------------------------------

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
 <tr>
<td colspan="6" width="650"><p align="center"><b>DATOS DEL CLIENTE</b></p></td>
</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"><p align="left"><b>CLIENTE:</b> <br>$persona</p></td>
        <td colspan="4"><p align="left"><b>RUC:</b> <br>$per_ruc</p></td>
        <td colspan="2"><p align="left"><b>CEDULA:</b> <br>$per_ci</p></td>
    </tr>
</table>

<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="6" width="650"><p align="center"><b>DATOS DE LA RESERVA</b></p></td>
    </tr>
    <tr>
        <td colspan="2"><p align="left"><b>RESERVA NUMERO:</b>$reserva_nro</p></td>
        <td colspan="2"><p align="left"><b>FECHA DE RESERVA:</b>$res_fecha</p></td>
        <td colspan="2"><p align="left"><b>FECHA DE EXPIRACION:</b>$exp</p></td>                
    </tr>
    <tr>
        <td><p align="left"><b>NUMERO DE VIAJE:</b> $viaje_nr</p></td>
        <td><p align="left"><b>TRAMO:</b> $ruta_dsc</p></td>
        <td colspan="2"><p align="left"><b>SALIDA:</b> $salida</p></td>
        <td colspan="2"><p align="left"><b>ASIENTO:</b> $asi_nro</p></td>
    </tr>
</table>
EOD;



$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Ln(5);



// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
