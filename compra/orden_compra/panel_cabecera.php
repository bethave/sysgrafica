<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$proveedores = pg_query($conexion,"SELECT * FROM v_proveedores WHERE estado = 'ACTIVO';");
$prov = pg_fetch_all($proveedores);
?>
<div class="row">
    <div class="card">
        <div class="card-header">
            ORDEN DE COMPRA
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <label for="con_pedido_cabecera">CON PRESUPUESTO</label>
                <input type="checkbox" style="width: 50px; height: 50px;" id="con_pedido_cabecera" checked="true">
            </div>
            <div class="col-sm-12">
                SELECCIONE EL PROVEEDOR:
                <select id="id_pro_cabecera" class="form-control select2">
                    <?php foreach ($prov as $p) {?>
                    <option value="<?php echo $p['id_pro'];?>">
                        <?php echo $p['persona']." (".$p['per_ruc'].")";?>
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
$cabecera = pg_query($conexion, "SELECT * FROM v_compra_orden WHERE id_co = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['id_co'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Proveedor: </b><?php echo $cab[0]['per_nombre']." ".$cab[0]['per_apellido']." (".$cab[0]['per_ruc'].")";?><br>
<b>Con Presupuesto: </b><?php echo $cab[0]['con_presu'];?><br>
<b>Estado: </b><?php echo $cab[0]['estado'];?><br>
<?php } ?>