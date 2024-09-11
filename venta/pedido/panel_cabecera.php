<?php $id_ped = $_POST['id_ped']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_ped == '0'){
$sucursales = pg_query($conexion,"SELECT * FROM v_cliente WHERE cli_estado = 'ACTIVO';");
$suc = pg_fetch_all($sucursales);
?>
<div class="row">
    SELECCIONE CLIENTE:
    <select class="chosen-select" id="id_suc_cabecera" autocomplete="off">
        <option hidden selected>Selecciona un Cliente</option>
        <?php foreach ($suc as $s) {?>
        <option value="<?php echo $s['cli_id'];?>">
            <?php echo $s['persona'];?>
        </option>
        <?php }?>
    </select>
    
</div>
<div class="row">
    <button type="button" class="btn btn-danger" onclick="cancelar_cabecera();">CANCELAR</button>
    <button type="button" class="btn btn-primary" onclick="grabar_cabecera();">GRABAR</button>    
</div>
<?php }else{ 
$cabecera = pg_query($conexion, "SELECT * FROM v_venta_pedido WHERE id_ped = $id_ped;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['id_ped'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Estado: </b><?php echo $cab[0]['estado'];?><br>
<b>Cliente: </b><?php echo $cab[0]['cliente'];?><br>
<b>Funcionario:</b><?php echo $_SESSION['per_nombre'];?> <?php echo $_SESSION['per_apellido'];?><br>
<?php } ?>