<?php 
$codigo = $_POST['codigo'];
include "../../conexion.php";
$conexion = conexion::conectar();
$resultado = pg_query($conexion,"SELECT * FROM v_proveedores WHERE id_pro = $codigo;");
$r = pg_fetch_all($resultado);
if(!empty($r)){ ?>
    <b>Codigo Persona: </b><br><?php echo $r[0]['id_per'];?><br>
    <b>Nombre y Apellido: </b><br><?php echo $r[0]['persona'];?><br>
    <b>Estado: </b><br><?php echo $r[0]['estado'];?><br>
<?php }else{ ?>
    <b>NO HAY RESULTADOS</b>
<?php } ?>