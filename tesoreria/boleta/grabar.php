<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cbdep_nro = $_POST['bdep_nro'];
    $cid_suc = $_SESSION['id_suc'];
    $ctip_cod = $_POST['tip_cod'];
    $cbdep_tipoope = $_POST['bdep_tipoope'];
    $cche_cod = $_POST['che_cod'];
    $cbdep_importe = $_POST['bdep_importe'];
    $ccuen_bank = $_POST['cuen_bank'];
    $cusuario = $_SESSION['per_nombre'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_bdep($cid_oc, $cbdep_nro, $cid_suc, '$ctip_cod', '$cbdep_tipoope', $cche_cod, $cbdep_importe, $ccuen_bank, '$cusuario', $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>