<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cen_che_concepto = $_POST['en_che_concepto'];
    $cid_pro = $_POST['id_pro'];
    $cid_suc = $_SESSION['id_suc'];
    $cche_cod = $_POST['che_cod'];
    $cusuario = $_SESSION['per_nombre'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_entrega_che($cid_oc, '$cen_che_concepto', $cid_pro, $cid_suc, $cche_cod, '$cusuario', $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>