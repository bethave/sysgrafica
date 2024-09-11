<?php 
$codigo = $_POST['codigo'];
include "../../conexion.php";
$conexion = conexion::conectar();
$resultado = pg_query($conexion,"SELECT * FROM caja WHERE caja_id = $codigo;");
$r = pg_fetch_all($resultado);
if(!empty($r)){ ?>
    <b>Codigo: </b><br><?php echo $r[0]['caja_id'];?><br>
    <b>Descripción Caja: </b><br><?php echo $r[0]['caja_descri'];?><br>
    <b>Estado: </b><br><?php echo $r[0]['c_estado'];?><br>
    <b>Auditoria: </b><br><?php echo $r[0]['auditoria'];?><br>
<?php }else{ ?>
    <b>NO HAY RESULTADOS</b>
<?php } ?>