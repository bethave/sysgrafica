<?php 
	include "../../conexion.php";
	include "../../session.php";
	$codigo = $_POST['codigo'];
        $marca = $_POST['marca'];
        $ti = $_POST['ti'];
        $tpi = $_POST['tpi'];
        $descripcion = $_POST['descripcion'];
        $compra = $_POST['compra'];
        $venta = $_POST['venta'];
        $um = $_POST['um'];
        $proce = $_POST['proce'];
        $img = $_POST['img'];
	$operacion = $_POST['operacion'];
	$usuario = $_SESSION['usu_nombre']."/".conexion::get_client_ip();
	$conexion = conexion::conectar();
	$guardar = pg_query($conexion,"SELECT sp_items($codigo, $marca, $tpi, $ti, '$descripcion', $compra, $venta, $um, $proce, '$img', $operacion);");
	if(!$guardar){
		echo pg_last_error()."_/_error";
	}else{
		echo pg_last_notice($conexion)."_/_success";
	}
?>