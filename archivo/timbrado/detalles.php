<?php 
$codigo = $_POST['codigo'];
include "../../conexion.php";
$conexion = conexion::conectar();
$resultado = pg_query($conexion,"SELECT * FROM cargos WHERE id_car = $codigo;");
$r = pg_fetch_all($resultado);
if(!empty($r)){ ?>
    <b>Codigo: </b><br><?php echo $r[0]['id_car'];?><br>
    <b>Descripción Cargo: </b><br><?php echo $r[0]['car_descrip'];?><br>
    <b>Estado: </b><br><?php echo $r[0]['estado'];?><br>
<?php }else{ ?>
    <b>NO HAY RESULTADOS</b>
<?php } ?>