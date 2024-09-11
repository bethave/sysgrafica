<?php 
$codigo = $_POST['codigo'];
include "../../conexion.php";
$conexion = conexion::conectar();
$resultado = pg_query($conexion,"SELECT * FROM v_personas WHERE id_per = $codigo;");
$r = pg_fetch_all($resultado);
if(!empty($r)){ ?>
    <b>Nombre y Apellido: </b><br><?php echo $r[0]['persona'];?><br>
    <b>RUC o CI: </b><br><?php echo $r[0]['per_ruc'];?><br>
    <b>Numero de Celular: </b><br><?php echo $r[0]['per_celular'];?><br>
    <b>Correo: </b><br><?php echo $r[0]['per_email'];?><br>
    <b>Direccion: </b><br><?php echo $r[0]['per_direccion'];?><br>
    <b>Ciudad: </b><br><?php echo $r[0]['ciu_descrip'];?><br>
    <b>Genero: </b><br><?php echo $r[0]['gen_descrip'];?><br>
    <b>Pais: </b><br><?php echo $r[0]['pais_descrip'];?><br>
    <b>Gentilicio: </b><br><?php echo $r[0]['gentilicio'];?><br>
    <b>Estado: </b><br><?php echo $r[0]['auditoria'];?><br>
<?php }else{ ?>
    <b>NO HAY RESULTADOS</b>
<?php } ?>