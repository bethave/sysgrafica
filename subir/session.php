<?php
session_start();
if(!isset($_SESSION['id_usu'])){
	$_SESSION['mensaje'] = "DEBES INICIAR SESION";
	header('Location:/sysgrafica/index.php');
}else{
	if($_SESSION['id_usu']==null || $_SESSION['id_usu']==""){
		$_SESSION['mensaje'] = "DEBES INICIAR SESION";
		header('Location:/sysgrafica/index.php');
	}else{
		$conexion = conexion::conectar();
		$rs1 = pg_query($conexion,"SELECT * FROM v_usuarios WHERE id_usu = ".$_SESSION['id_usu'].";");
		$rs2 = pg_fetch_all($rs1);
		$_SESSION['id_usu'] 		= $rs2[0]['id_usu'];
		$_SESSION['usu_nombre'] 	= $rs2[0]['usu_nombre'];
		$_SESSION['usu_imagen'] 	= $rs2[0]['usu_imagen'];
		$_SESSION['id_gru'] 		= $rs2[0]['id_gru'];
		$_SESSION['id_fun'] 		= $rs2[0]['id_fun'];
		$_SESSION['id_suc'] 		= $rs2[0]['id_suc'];
		$_SESSION['color_cabecera'] = $rs2[0]['cc_descrip'];
		$_SESSION['color_logo'] 	= $rs2[0]['cl_descrip'];
		$_SESSION['color_menu'] 	= $rs2[0]['cm_descrip'];
		$_SESSION['gru_descrip'] 	= $rs2[0]['gru_descrip'];
		$_SESSION['id_per'] 		= $rs2[0]['id_per'];
		$_SESSION['id_car'] 		= $rs2[0]['id_car'];
		$_SESSION['per_ci'] 		= $rs2[0]['per_ci'];
		$_SESSION['per_nombre'] 	= $rs2[0]['per_nombre'];
		$_SESSION['per_apellido'] 	= $rs2[0]['per_apellido'];
		$_SESSION['car_descrip'] 	= $rs2[0]['car_descrip'];
		$_SESSION['suc_nombre'] 	= $rs2[0]['suc_nombre'];
		$_SESSION['suc_direccion'] 	= $rs2[0]['suc_direccion'];
		$_SESSION['suc_email'] 		= $rs2[0]['suc_email'];
		$_SESSION['suc_ruc'] 		= $rs2[0]['suc_ruc'];
		$_SESSION['suc_celular'] 	= $rs2[0]['suc_celular'];
		$_SESSION['suc_ubicacion'] 	= $rs2[0]['suc_ubicacion'];
		$_SESSION['suc_imagen'] 	= $rs2[0]['suc_imagen'];
	}
}
?>