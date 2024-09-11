<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cbdep_cod = $_POST['bdep_cod'];
    $ccuen_bank = $_POST['cuen_bank'];
    $cche_cod = $_POST['che_cod'];
    $cliq_cod = $_POST['liq_cod'];
    $cotr_cod = $_POST['otr_cod'];
    $cid_suc = $_SESSION['id_suc'];
    $cusuario = $_SESSION['per_nombre'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_conciliacion($cid_oc, $cbdep_cod, $ccuen_bank, $cche_cod, $cliq_cod, $cotr_cod, $cid_suc, '$cusuario', $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>