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
            FACTURA DE PAGO
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <label for="con_fc_cabecera">CON FACTURA COMPRA</label>
                <input type="checkbox" style="width: 50px; height: 50px;" id="con_fc_cabecera" checked="true">
                <dl></dl>
                
                <label>SELECCIONE - CONCEPTO:..</label>
                <select id="id_concepto_cabecera" >
                    <option>PAGO A PROVEEDORES</option>
                    <option>GASTOS</option>
                </select>
                <dl></dl>
                
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
        </div>
    </div>
</div>
<div class="row">
    <button type="button" class="btn btn-danger" onclick="cancelar_cabecera();">CANCELAR</button>
    <button type="button" class="btn btn-primary" onclick="grabar_cabecera();">GRABAR</button>    
</div>
<?php }else{ 
$cabecera = pg_query($conexion, "SELECT * FROM v_fac_pago WHERE facp_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['facp_cod'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Proveedor: </b><?php echo $cab[0]['persona'];?><br>
<b>Con Factura Compra: </b><?php echo $cab[0]['con_faccompra'];?><br>
<b>Estado: </b><?php echo $cab[0]['facp_estado'];?><br>
<b>Funcionario: </b><?php echo $cab[0]['auditoria'];?><br>
<?php } ?>