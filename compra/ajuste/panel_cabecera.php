<?php $ajus_cod = $_POST['ajus_cod']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($ajus_cod == '0'){
$sucursales = pg_query($conexion,"SELECT * FROM motivo_ajuste WHERE estado = 'ACTIVO';");
$suc = pg_fetch_all($sucursales);
?>
<div class="row">
    SELECCIONE MOTIVO:
    <select id="id_suc_cabecera">
        <?php foreach ($suc as $s) {?>
        <option value="<?php echo $s['mot_id'];?>">
            <?php echo $s['mot_descri'];?>
        </option>
        <?php }?>
    </select>
</div>
<div class="row">
    <button type="button" class="btn btn-danger" onclick="cancelar_cabecera();">CANCELAR</button>
    <button type="button" class="btn btn-primary" onclick="grabar_cabecera();">GRABAR</button>    
</div>
<?php }else{ 
$cabecera = pg_query($conexion, "SELECT * FROM v_ajuste WHERE ajus_cod = $ajus_cod;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['ajus_cod'];?><br>
<b>Motivo: </b><?php echo $cab[0]['mot_descri'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Estado: </b><?php echo $cab[0]['estado'];?><br>
<?php } ?>