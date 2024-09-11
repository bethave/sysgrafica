<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cid_suc = $_SESSION['id_suc'];
    $usuario = $_SESSION['per_nombre'];
    $ccuen_bank = $_POST['cuen_bank'];
    $ccon_cheque = $_POST['con_cheque'];
    $ccon_orden = $_POST['con_orden'];
    $cche_cod = $_POST['che_cod'];
    $cpag_cod = $_POST['pag_cod'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_proc_especial($cid_oc, $cid_suc, '$usuario', $ccuen_bank, '$ccon_cheque', '$ccon_orden', $cche_cod, $cpag_cod, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>