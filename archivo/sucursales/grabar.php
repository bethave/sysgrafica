<?php 
	include "../../conexion.php";
	include "../../session.php";
	$codigo = $_POST['codigo'];
        $ruc = $_POST['ruc'];
	$descripcion = $_POST['descripcion'];
        $email = $_POST['email'];
        $celular = $_POST['celular'];
        $direc = $_POST['direc'];
        $ubi = $_POST['ubi'];
        $imagen = $_POST['imagen'];
	$operacion = $_POST['operacion'];
	$usuario = $_SESSION['usu_nombre']."/".conexion::get_client_ip();
	$conexion = conexion::conectar();
	$guardar = pg_query($conexion,"SELECT sp_sucursales($codigo, '$ruc', '$descripcion', '$email',  '$celular',  '$direc',  '$ubi', '$usuario', '$imagen', $operacion);");
	if(!$guardar){
		echo pg_last_error()."_/_error";
	}else{
		echo pg_last_notice($conexion)."_/_success";
	}
?>