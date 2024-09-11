<?php 
    include "../../conexion.php";
    include "../../session.php";
    $cid_oc = $_POST['id_oc'];
    $cid_suc = $_SESSION['id_suc'];
    $cid_pro = $_POST['id_pro'];
    $cpag_formapag = $_POST['pag_formapag'];
    $cpag_obs = $_POST['pag_obs'];
    $ccuen_bank = $_POST['cuen_bank'];
    $usuario = $_SESSION['usu_nombre'];
    $ccon_ordcompra = $_POST['con_ordcompra'];
    $cid_co = $_POST['id_co'];
    $cdop_monto = $_POST['dop_monto'];
    $operacion = $_POST['operacion'];
    $conexion = conexion::conectar();
    $consulta = "SELECT sp_orden_pago($cid_oc, $cid_suc, $cid_pro, '$cpag_formapag', '$cpag_obs', $ccuen_bank , '$usuario', '$ccon_ordcompra',$cid_co, $cdop_monto, $operacion);";
    $guardar = pg_query($conexion,$consulta);
    if(!$guardar){
            echo pg_last_error();
    }else{
            echo pg_last_notice($conexion);
    }
    //echo $consulta;
?>