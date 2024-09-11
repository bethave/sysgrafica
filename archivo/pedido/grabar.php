<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_ped = $_POST['id_ped'];
    $cid_suc = $_POST['id_suc'];
    $cid_usu = $_SESSION['id_usu'];
    $cid_item = $_POST['id_item'];
    $ccantidad = $_POST['cantidad'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_compra_pedido($cid_ped, $cid_suc, $cid_usu, $cid_item, $ccantidad, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>