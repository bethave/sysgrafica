<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cid_suc = $_SESSION['id_suc'];
    $ccli_id = $_POST['cli_id'];
    $ccon_pedido = $_POST['con_pedido'];
    $cid_ped = $_POST['id_ped'];
    $cid_item = $_POST['id_item'];
    $ccantidad = $_POST['cantidad'];
    $operacion = $_POST['operacion'];
    $usuario = $_SESSION['usu_nombre'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_presu_venta($cid_oc, $cid_suc, $ccli_id, '$ccon_pedido', '$usuario', $cid_ped , $cid_item, $ccantidad, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>