<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$proveedores = pg_query($conexion,"SELECT * FROM v_cliente WHERE cli_estado = 'ACTIVO';");
$prov = pg_fetch_all($proveedores);
?>
<div class="row">
    <div class="card">
        <div class="card-header">
            PRESUPUESTO DEL CLIENTE
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <label for="con_pedido_cabecera">CON PEDIDO</label>
                <input type="checkbox" style="width: 50px; height: 50px;" id="con_pedido_cabecera" checked="">
            </div>
            <div class="col-sm-12">
                SELECCIONE EL CLIENTE:
                <select id="id_pro_cabecera" class="form-control select2">
                    <?php foreach ($prov as $p) {?>
                    <option value="<?php echo $p['cli_id'];?>">
                        <?php echo $p['persona'];?>
                    </option>
                    <?php }?>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <button type="button" class="btn btn-danger" onclick="cancelar_cabecera();">CANCELAR</button>
    <button type="button" class="btn btn-primary" onclick="grabar_cabecera();">GRABAR</button>    
</div>
<?php }else{ 
$cabecera = pg_query($conexion, "SELECT * FROM v_venta_presupuesto WHERE pre_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['pre_cod'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Cliente: </b><?php echo $cab[0]['cliente'];?><br>
<b>Con Pedido: </b><?php echo $cab[0]['con_pedido'];?><br>
<b>Estado: </b><?php echo $cab[0]['pre_estado'];?><br>
<?php } ?>