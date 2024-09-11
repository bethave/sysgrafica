<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cid_suc = $_SESSION['id_suc'];
    $ccaja_id = $_POST['caja_id'];
    $casig_motivo = $_POST['asig_motivo'];
    $casig_monto = $_POST['asig_monto'];
    $usuario = $_SESSION['per_nombre'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_asignacion($cid_oc, $cid_suc, $ccaja_id, '$casig_motivo', $casig_monto, '$usuario', $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?> 
