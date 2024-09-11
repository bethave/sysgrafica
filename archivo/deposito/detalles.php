<?php 
$codigo = $_POST['codigo'];
include "../../conexion.php";
$conexion = conexion::conectar();
$resultado = pg_query($conexion,"SELECT * FROM v_deposito WHERE id_dep = $codigo;");
$r = pg_fetch_all($resultado);
if(!empty($r)){ ?>
    <b>Codigo Sucursal: </b><br><?php echo $r[0]['id_suc'];?><br>
    <b>Nombre Sucursal: </b><br><?php echo $r[0]['suc_nombre'];?><br>
    <b>Estado: </b><br><?php echo $r[0]['estado'];?><br>
<?php }else{ ?>
    <b>NO HAY RESULTADOS</b>
<?php } ?>