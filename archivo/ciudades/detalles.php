<?php 
$codigo = $_POST['codigo'];
include "../../conexion.php";
$conexion = conexion::conectar();
$resultado = pg_query($conexion,"SELECT * FROM v_ciudades WHERE id_ciu = $codigo;");
$r = pg_fetch_all($resultado);
if(!empty($r)){ ?>
    <b>Codigo: </b><br><?php echo $r[0]['id_ciu'];?><br>
    <b>Ciudad: </b><br><?php echo $r[0]['ciu_descrip'];?><br>
    <b>País: </b><br><?php echo $r[0]['pais'];?><br>
    <b>Estado: </b><br><?php echo $r[0]['estado'];?><br>
    <b>Auditoría: </b><br><?php echo $r[0]['auditoria'];?><br>
<?php }else{ ?>
    <b>NO HAY RESULTADOS</b>
<?php } ?>