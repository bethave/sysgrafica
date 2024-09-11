<?php 
    include "../../conexion.php";
    include "../../session.php";
     $cid_ped = $_POST['id_ped'];
    $cid_suc = $_SESSION['id_suc'];
    $ccli_id = $_POST['cli_id'];
    $cid_item = $_POST['id_item'];
    $ccantidad = $_POST['cantidad'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $usuario = $_SESSION['usu_nombre']."/".conexion::get_client_ip();
    $consulta = "SELECT sp_venta_pedido($cid_ped, $cid_suc, $ccli_id, $cid_item, $ccantidad, '$usuario', $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>