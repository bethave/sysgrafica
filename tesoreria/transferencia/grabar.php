<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cid_suc = $_SESSION['id_suc'];
    $ctb_titular = $_POST['tb_titular'];
    $ctb_cta_titular = $_POST['tb_cta_titular'];
    $ctb_beneficiario = $_POST['tb_beneficiario'];
    $ctb_cta_beneficiario = $_POST['tb_cta_beneficiario'];
    $ctb_concepto = $_POST['tb_concepto'];
    $ctb_importe = $_POST['tb_importe'];
    $ccuen_bank = $_POST['cuen_bank'];
    $cusuario = $_SESSION['per_nombre'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_transferencia($cid_oc, $cid_suc, '$ctb_titular', '$ctb_cta_titular', '$ctb_beneficiario', $ctb_cta_beneficiario, '$ctb_concepto', $ctb_importe, $ccuen_bank, '$cusuario', $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>