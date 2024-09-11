<?php
session_start();
if(isset($_SESSION['id_usu'])){
	session_destroy();
}
header('Location:/sysgrafica/index.php');
?>