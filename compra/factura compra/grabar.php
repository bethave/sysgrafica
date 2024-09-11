<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $ctip_fac = $_POST['tip_fac'];
    $ccfac_cuotas = $_POST['fac_cuotas'];
    $ccfac_timnro = $_POST['fac_timnro'];
    $cfac_vto = $_POST['fac_vto'];
    $ccon_pedido = $_POST['con_pedido'];
    $cid_suc = $_SESSION['id_suc'];
    $cid_pro = $_POST['id_pro'];
    $usuario = $_SESSION['usu_nombre']."/".conexion::get_client_ip();
    $cfac_nro = $_POST['fac_nro'];
    $cfac_inicio = $_POST['fac_inicio'];
    $cintervalo = $_POST['intervalo'];
    $cid_ped = $_POST['id_ped'];
    $cid_item = $_POST['id_item'];
    $ccantidad = $_POST['cantidad'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_fac_compra($cid_oc, '$ctip_fac', $ccfac_cuotas, '$ccfac_timnro', '$cfac_vto', '$ccon_pedido', $cid_suc, $cid_pro, '$usuario', '$cfac_nro', '$cfac_inicio', $cintervalo, $cid_ped, $cid_item, $ccantidad, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?> 
