<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $caper_cod = $_POST['aper_cod'];
    $ccli_id = $_POST['cli_id'];
    $ccon_factura = $_POST['con_factura'];
    $cid_suc = $_SESSION['id_suc'];
    $usuario = $_SESSION['per_nombre'];
    $ccuen_nro = $_POST['cuen_nro'];
    $cfc_id = $_POST['fc_id'];
    $cban_cod = $_POST['ban_cod'];
    $cmontototal = $_POST['montototal'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_venta_cobro($cid_oc, $caper_cod, $ccli_id, '$ccon_factura', $cid_suc, '$usuario', $ccuen_nro, $cfc_id, $cban_cod, $cmontototal, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>