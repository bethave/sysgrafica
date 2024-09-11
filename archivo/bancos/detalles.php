<?php 
$codigo = $_POST['codigo'];
include "../../conexion.php";
$conexion = conexion::conectar();
$resultado = pg_query($conexion,"SELECT * FROM banco WHERE ban_cod = $codigo;");
$r = pg_fetch_all($resultado);
if(!empty($r)){ ?>
    <b>Codigo: </b><br><?php echo $r[0]['ban_cod'];?><br>
    <b>Descripción Banco: </b><br><?php echo $r[0]['ban_descri'];?><br>
    <b>Teléfono Banco: </b><br><?php echo $r[0]['ban_tel'];?><br>
    <b>Email Banco: </b><br><?php echo $r[0]['ban_email'];?><br>
    <b>Direccion Banco: </b><br><?php echo $r[0]['ban_direc'];?><br>
    <b>Estado: </b><br><?php echo $r[0]['estado'];?><br>
<?php }else{ ?>
    <b>NO HAY RESULTADOS</b>
<?php } ?>