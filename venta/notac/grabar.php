<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $ctip_cod = $_POST['tip_cod'];
    $cmot_cod = $_POST['mot_cod'];
    $cid_suc = $_SESSION['id_suc'];
    $ccon_fac = $_POST['con_fac'];
    $ccli_id = $_POST['cli_id'];
    $cusuario = $_SESSION['per_nombre'];
    $cid_ped = $_POST['id_ped'];
    $cid_item = $_POST['id_item'];
    $ccantidad = $_POST['cantidad'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_venta_credito($cid_oc, $ctip_cod, $cmot_cod, $cid_suc, '$ccon_fac', $ccli_id, '$cusuario', $cid_ped, $cid_item, $ccantidad, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>