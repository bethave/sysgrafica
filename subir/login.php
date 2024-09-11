<?php
require "conexion.php";
$conexion = conexion::conectar();
session_start();
if(isset($_POST['usuario']) && isset($_POST['contrasena'])){
	$usuario = trim($_POST['usuario']);
	$contrasena = trim($_POST['contrasena']);
	$rs1 = pg_query($conexion,"SELECT * FROM v_usuarios WHERE usu_nombre = '".addslashes($usuario)."' AND estado = 'ACTIVO'");
	$rs2 = pg_fetch_all($rs1);
	if(!empty($rs2)){
		if($rs2[0]['usu_contrasena']==md5($contrasena)){
			$rs1 = pg_query($conexion,"UPDATE usuarios SET ultima_sesion = '".conexion::get_client_ip()." '||now() WHERE id_usu = ".$rs2[0]['id_usu'].";");
			$_SESSION['id_usu'] 		= $rs2[0]['id_usu'];
			header('Location:/sysgrafica/inicio.php');
		}else{
			$_SESSION['mensaje'] = 'VERIFIQUE LOS DATOS INGRESADOS';
			header('Location:/sysgrafica/index.php');
		}
	}else{
		$_SESSION['mensaje'] = 'VERIFIQUE LOS DATOS INGRESADOS';
		header('Location:/sysgrafica/index.php');
	}
}else{
	$_SESSION['mensaje'] = 'VERIFIQUE LOS DATOS INGRESADOS';
	header('Location:/sysgrafica/index.php');
}
?>