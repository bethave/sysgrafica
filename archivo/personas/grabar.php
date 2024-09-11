<?php 
    include "../../conexion.php";
    include "../../session.php";
    $codigo = $_POST['codigo'];
    $ccper_ruc = $_POST['per_ruc'];
    $ccper_nombre = $_POST['per_nombre'];
    $ccper_apellido = $_POST['per_apellido'];
    $ccper_celular = $_POST['per_celular'];
    $ccper_email = $_POST['per_email'];
    $ccper_direccion = $_POST['per_direccion'];
    $ccid_ciu = $_POST['id_ciu'];
    $ccid_gen = $_POST['id_gen'];
    $ccid_tper = $_POST['id_tper'];
    $operacion = $_POST['operacion'];
    $usuario = $_SESSION['usu_nombre']."/".conexion::get_client_ip();
    $conexion = conexion::conectar();
    $guardar = pg_query($conexion,"SELECT sp_personas($codigo, '$ccper_ruc', '$ccper_nombre', '$ccper_apellido', '$ccper_celular', '$ccper_email', '$ccper_direccion', $ccid_ciu, $ccid_gen, $ccid_tper, '$usuario', $operacion);");
    if(!$guardar){
            echo pg_last_error()."_/_error";
    }else{
            echo pg_last_notice($conexion)."_/_success";
    }
?>