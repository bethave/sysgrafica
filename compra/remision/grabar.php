<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cmotivo = $_POST['motivo'];
    $cvehi_cod = $_POST['vehi_cod'];
    $cid_pro = $_POST['id_pro'];
    $cid_suc = $_SESSION['id_suc'];
    $cid_suc2 = $_POST['id_suc2'];
    $ccon_pedido = $_POST['con_pedido'];
    $usuario = $_SESSION['usu_nombre']."/".conexion::get_client_ip();
    $ctim_vto = $_POST['tim_vto'];
    $ctim_nro = $_POST['tim_nro'];
    $crem_nro = $_POST['rem_nro'];
    $cid_ped = $_POST['id_ped'];
    $cid_item = $_POST['id_item'];
    $ccantidad = $_POST['cantidad'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_remision($cid_oc, '$cmotivo', $cvehi_cod, $cid_pro, $cid_suc, $cid_suc2, '$ccon_pedido', '$usuario', '$ctim_vto', $ctim_nro, '$crem_nro', $cid_ped, $cid_item, $ccantidad, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>