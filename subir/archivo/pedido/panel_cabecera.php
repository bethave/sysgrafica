<?php $id_ped = $_POST['id_ped']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_ped == '0'){
$sucursales = pg_query($conexion,"SELECT * FROM sucursales WHERE estado = 'ACTIVO';");
$suc = pg_fetch_all($sucursales);
?>
<div class="row">
    SELECCIONE LA SUCURSAL:
    <select id="id_suc_cabecera">
        <?php foreach ($suc as $s) {?>
        <option value="<?php echo $s['id_suc'];?>">
            <?php echo $s['suc_nombre'];?>
        </option>
        <?php }?>
    </select>
</div>
<div class="row">
    <button type="button" class="btn btn-danger" onclick="cancelar_cabecera();">CANCELAR</button>
    <button type="button" class="btn btn-primary" onclick="grabar_cabecera();">GRABAR</button>    
</div>
<?php }else{ 
$cabecera = pg_query($conexion, "SELECT * FROM v_compra_pedido WHERE id_ped = $id_ped;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['id_ped'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Estado: </b><?php echo $cab[0]['estado'];?><br>
<?php } ?>