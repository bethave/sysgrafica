<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cid_suc = $_SESSION['id_suc'];
    $cotr_nro = $_POST['otr_nro'];
    $cotr_tipo = $_POST['otr_tipo'];
    $cotr_motivo = $_POST['otr_motivo'];
    $ccuen_bank = $_POST['cuen_bank'];
    $cusuario = $_SESSION['per_nombre'];
    $ccon_ban = $_POST['con_ban'];
    $cban_cod = $_POST['ban_cod'];
    $cdoc_cuenta = $_POST['doc_cuenta'];
    $cdoc_monto = $_POST['doc_monto'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_otrosdc($cid_oc, $cid_suc, $cotr_nro, '$cotr_tipo', '$cotr_motivo', $ccuen_bank, '$cusuario', '$ccon_ban', $cban_cod, $cdoc_cuenta, $cdoc_monto, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>