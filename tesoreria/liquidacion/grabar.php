<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cliq_nro = $_POST['liq_nro'];
    $cliq_descri = $_POST['liq_descri'];
    $cid_suc = $_SESSION['id_suc'];
    $cent_cod = $_POST['ent_cod'];
    $ccuen_bank = $_POST['cuen_bank'];
    $cliq_concepto = $_POST['liq_concepto'];
    $cliq_total = $_POST['liq_total'];
    $cusuario = $_SESSION['per_nombre'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_liqtar($cid_oc, $cliq_nro, '$cliq_descri', $cid_suc, $cent_cod, $ccuen_bank, '$cliq_concepto', $cliq_total, '$cusuario', $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>