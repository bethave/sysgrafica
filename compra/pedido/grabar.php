<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_ped = $_POST['id_ped'];
    $cid_suc = $_SESSION['id_suc'];
    $cid_item = $_POST['id_item'];
    $ccantidad = $_POST['cantidad'];
    $cid_pro = $_POST['id_pro'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $usuario = $_SESSION['usu_nombre']."/".conexion::get_client_ip();
    $consulta = "SELECT sp_compra_pedido($cid_ped, $cid_suc, $cid_item, $ccantidad, '$usuario', $cid_pro, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>