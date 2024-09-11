<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $ccred_tipo = $_POST['cred_tipo'];
    $ccred_motivo = $_POST['cred_motivo'];
    $ccred_timnro = $_POST['cred_timnro'];
    $ccred_timvto = $_POST['cred_timvto'];
    $cid_suc = $_SESSION['id_suc'];
    $cid_fun = $_SESSION['usu_nombre'];
    $ccon_fac = $_POST['con_fac'];
    $cid_pro = $_POST['id_pro'];
    $ccred_nro = $_POST['cred_nro'];
    $cporcentaje = $_POST['porcentaje'];
    $cfac_cod = $_POST['fac_cod'];
    $cid_item = $_POST['id_item'];
    $ccantidad = $_POST['cantidad'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_compra_nota_credito($cid_oc, '$ccred_tipo', '$ccred_motivo', $ccred_timnro, '$ccred_timvto', $cid_suc, '$cid_fun', '$ccon_fac', $cid_pro, '$ccred_nro', $cporcentaje, $cfac_cod, $cid_item, $ccantidad, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>