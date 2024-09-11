<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $crem_motivo = $_POST['rem_motivo'];
    $cvehi_cod = $_POST['vehi_cod'];
    $usuario = $_SESSION['per_nombre'];
    $ccon_pedido = $_POST['con_pedido'];
    $cid_suc = $_SESSION['id_suc'];
    $ccli_id = $_POST['cli_id'];
    $ctim_cod = $_POST['tim_cod'];
    $cid_ped = $_POST['id_ped'];
    $cid_item = $_POST['id_item'];
    $ccantidad = $_POST['cantidad'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_venta_remision($cid_oc, '$crem_motivo', $cvehi_cod, '$usuario', '$ccon_pedido', $cid_suc,  $ccli_id, $cid_ped, $cid_item, $ccantidad, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>