<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cid_suc = $_SESSION['id_suc'];
    $casig_cod = $_POST['asig_cod'];
    $crep_monto = $_POST['rep_monto'];
    $cusuario = $_SESSION['per_nombre'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_reposicion($cid_oc, $cid_suc, $casig_cod, $crep_monto, '$cusuario', $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>