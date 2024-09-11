<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cajus_cod = $_POST['ajus_cod'];
    $cmotivo = $_POST['motivo'];
    $cid_suc = $_SESSION['id_suc'];
    $cid_item = $_POST['id_item'];
    $ccantidad = $_POST['cantidad'];
    $operacion = $_POST['operacion'];
    $usuario = $_SESSION['usu_nombre']."/".conexion::get_client_ip();
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_ajuste_compra($cajus_cod, $cid_suc, '$usuario', $cmotivo, $cid_item, $ccantidad, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>