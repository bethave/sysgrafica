<?php 
$codigo = $_POST['codigo'];
include "../../conexion.php";
$conexion = conexion::conectar();
$resultado = pg_query($conexion,"SELECT * FROM unidad_medida WHERE um_id = $codigo;");
$r = pg_fetch_all($resultado);
if(!empty($r)){ ?>
    <b>Codigo: </b><br><?php echo $r[0]['um_id'];?><br>
    <b>Descripción Cargo: </b><br><?php echo $r[0]['um_descri'];?><br>
    <b>Estado: </b><br><?php echo $r[0]['estado'];?><br>
<?php }else{ ?>
    <b>NO HAY RESULTADOS</b>
<?php } ?>