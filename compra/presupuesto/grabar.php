<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cid_suc = $_SESSION['id_suc'];
    $cid_pro = $_POST['id_pro'];
    $ccon_pedido = $_POST['con_pedido'];
    $cid_ped = $_POST['id_ped'];
    $cid_item = $_POST['id_item'];
    $ccantidad = $_POST['cantidad'];
    $operacion = $_POST['operacion'];
    $cid_usu = $_SESSION['id_usu'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_presu_orden($cid_oc, $cid_suc, $cid_usu, $cid_pro, '$ccon_pedido', $cid_ped, $cid_item, $ccantidad, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>