<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$proveedores = pg_query($conexion,"SELECT * FROM v_proveedores WHERE estado = 'ACTIVO';");
$prov = pg_fetch_all($proveedores);
$cuenbank = pg_query($conexion,"SELECT * FROM v_cuenbank WHERE estado = 'ACTIVO';");
$cuen = pg_fetch_all($cuenbank);
?>
<div class="row">
    <div class="card">
        <div class="card-header">
            ORDENES DE PAGO
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <label for="con_oc_cabecera">CON ORDEN DE COMPRA</label>
                <input type="checkbox" style="width: 50px; height: 50px;" id="con_oc_cabecera" checked="">
            </div>
            <div class="col-sm-12">
                SELECCIONE EL PROVEEDOR:
                <select class="chosen-select" id="id_pro_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona un Proveedor</option>
                        <?php foreach ($prov as $p) {?>
                    <option value="<?php echo $p['id_pro'];?>">
                        <?php echo $p['persona'];?>
                    </option>
                        <?php }?>
                </select>
            </div>
            <dl></dl>
            <label>SELECCIONE - FORMA DE PAGO:..</label>
                <select id="id_fp_cabecera" >
                    <option>EFECTIVO</option>
                    <option>TARJETA</option>
                    <option>CHEQUE</option>
                </select>
                <dl></dl>
                <label>OBSERVACION...</label><input type="text" style="width: 300px; height: 30px;" id="id_obs_cabecera" value="">
            <dl></dl>
                <div class="col-sm-12">
                SELECCIONE CUENTA BANCARIA:
                <select class="chosen-select" id="id_cb_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Cuenta Bancaria</option>
                        <?php foreach ($cuen as $c) {?>
                    <option value="<?php echo $c['cuen_bank'];?>">
                        <?php echo "Código ".$c['cuen_bank']." - Cuenta NRO ".$c['cuen_nro']." - Banco ".$c['ban_descri'];?>
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