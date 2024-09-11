<?php 
	include "../../conexion.php";
	include "../../session.php";
	$codigo = $_POST['codigo'];
	$descripcion = $_POST['descripcion'];
	$operacion = $_POST['operacion'];
	$usuario = $_SESSION['usu_nombre']."/".conexion::get_client_ip();
	$conexion = conexion::conectar();
	$guardar = pg_query($conexion,"SELECT sp_caja($codigo, '$descripcion', '$usuario', $operacion);");
	if(!$guardar){
		echo pg_last_error()."_/_error";
	}else{
		echo pg_last_notice($conexion)."_/_success";
	}
?>