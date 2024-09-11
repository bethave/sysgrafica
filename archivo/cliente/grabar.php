<?php 
	include "../../conexion.php";
	include "../../session.php";
	$codigo = $_POST['codigo'];
        $pais = $_POST['pais'];
	$operacion = $_POST['operacion'];
	$usuario = $_SESSION['usu_nombre']."/".conexion::get_client_ip();
	$conexion = conexion::conectar();
	$guardar = pg_query($conexion,"SELECT sp_cliente($codigo, $pais, '$usuario', $operacion);");
	if(!$guardar){
		echo pg_last_error()."_/_error";
	}else{
		echo pg_last_notice($conexion)."_/_success";
	}
?>