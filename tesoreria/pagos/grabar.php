<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cid_pro = $_POST['id_pro'];
    $usuario = $_SESSION['per_nombre'];
    $cid_suc = $_SESSION['id_suc'];
    $ccpag_cod = $_POST['cpag_cod'];
    $cfc_id = $_POST['fc_id'];
    $cban_cod = $_POST['ban_cod'];
    $cimporte = $_POST['importe'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_tpagos($cid_oc, $cid_pro, '$usuario', $cid_suc, $ccpag_cod, $cfc_id, $cban_cod, $cimporte, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>