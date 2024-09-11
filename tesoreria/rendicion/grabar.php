<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $casig_cod = $_POST['asig_cod'];
    $cid_pro = $_POST['id_pro'];
    $cid_suc = $_SESSION['id_suc'];
    $cren_descri = $_POST['ren_descri'];
    $usuario = $_SESSION['per_nombre'];
    $ccon_asig = $_POST['con_asig'];
    $cfacp_cod = $_POST['facp_cod'];
    $cdr_total = $_POST['dr_total'];
    $cdr_iva = $_POST['dr_iva'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_rendicion($cid_oc, $casig_cod, $cid_pro, $cid_suc, '$cren_descri', '$usuario', '$ccon_asig', $cfacp_cod, $cdr_total, $cdr_iva, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?> 
