<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $caper_minicial = $_POST['aper_minicial'];
    $cid_suc = $_SESSION['id_suc'];
    $ccaja_id = $_POST['caja_id'];
    $usuario = $_SESSION['per_nombre']."/".conexion::get_client_ip();
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_apertura($cid_oc, $caper_minicial, $cid_suc, $ccaja_id, '$usuario', $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>