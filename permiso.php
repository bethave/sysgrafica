<?php
	$conexion = conexion::conectar();
	$rs1 = pg_query($conexion,"SELECT * FROM v_permisos WHERE id_gru = ".$_SESSION['id_gru']." AND id_pag = ".$_SESSION['id_pag']." AND id_ac = 1 AND pe_estado = 'ACTIVO';");
	$rs2 = pg_fetch_all($rs1);
	if(empty($rs2)){
		$_SESSION['mensaje'] = "NO POSEE PERMISOS PARA LA PAGINA";
		$_SESSION['tipo_mensaje'] = "error";
		header('Location:/sysgrafica/inicio.php');
	}else{
		$_SESSION['mensaje'] = '';
		$_SESSION['id_mod'] = $rs2[0]['id_mod'];
	}
?>