<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cfacp_concepto = $_POST['facp_concepto'];
    $cid_suc = $_SESSION['id_suc'];
    $cid_pro = $_POST['id_pro'];
    $usuario = $_SESSION['per_nombre'];
    $ccon_faccompra = $_POST['con_faccompra'];
    $cfac_cod = $_POST['fac_cod'];
    $cid_item = $_POST['id_item'];
    $cdfp_monto = $_POST['dfp_monto'];
    $cdfp_iva = $_POST['dfp_iva'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_fac_pago($cid_oc, '$cfacp_concepto', $cid_suc, $cid_pro, '$usuario', '$ccon_faccompra', $cfac_cod, $cid_item, $cdfp_monto, $cdfp_iva, $operacion);;";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?> 