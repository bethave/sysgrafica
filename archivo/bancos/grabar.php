<?php 
	include "../../conexion.php";
	include "../../session.php";
	$codigo = $_POST['codigo'];
	$descripcion = $_POST['descripcion'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $direc = $_POST['direc'];
	$operacion = $_POST['operacion'];
	$usuario = $_SESSION['usu_nombre']."/".conexion::get_client_ip();
	$conexion = conexion::conectar();
	$guardar = pg_query($conexion,"SELECT sp_banco($codigo, '$descripcion', '$tel', '$email', '$direc', '$usuario', $operacion);");
	if(!$guardar){
		echo pg_last_error()."_/_error";
	}else{
		echo pg_last_notice($conexion)."_/_success";
	}
?>