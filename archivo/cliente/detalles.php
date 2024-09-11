<?php 
$codigo = $_POST['codigo'];
include "../../conexion.php";
$conexion = conexion::conectar();
$resultado = pg_query($conexion,"SELECT * FROM v_cliente WHERE cli_id = $codigo;");
$r = pg_fetch_all($resultado);
if(!empty($r)){ ?>
    <b>Codigo Persona: </b><br><?php echo $r[0]['id_per'];?><br>
    <b>Nombre y Apellido: </b><br><?php echo $r[0]['persona'];?><br>
    <b>Estado: </b><br><?php echo $r[0]['cli_estado'];?><br>
<?php }else{ ?>
    <b>NO HAY RESULTADOS</b>
<?php } ?>