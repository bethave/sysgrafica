<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cfac_tipo = $_POST['fac_tipo'];
    $cfac_cuotas = $_POST['fac_cuotas'];
    $ccon_presu = $_POST['con_presu'];
    $cid_suc = $_SESSION['id_suc'];
    $ccli_id = $_POST['cli_id'];
    $usuario = $_SESSION['per_nombre']." ".$_SESSION['per_apellido'];
    $cfac_intervalo = $_POST['fac_intervalo'];
    $cpre_cod = $_POST['pre_cod'];
    $cid_item = $_POST['id_item'];
    $ccantidad = $_POST['cantidad'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_venta_factura($cid_oc, '$cfac_tipo', $cfac_cuotas, '$ccon_presu', $cid_suc, $ccli_id, '$usuario', $cfac_intervalo, $cpre_cod, $cid_item, $ccantidad, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?> 
