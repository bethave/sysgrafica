<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cid_suc = $_SESSION['id_suc'];
    $aper_cod = $_POST['aper_cod'];
    $usuario = $_SESSION['per_nombre'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_cierre($cid_oc, $cid_suc, $aper_cod, '$usuario', $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>