<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$proveedores = pg_query($conexion,"SELECT * FROM v_cliente WHERE cli_estado = 'ACTIVO';");
$prov = pg_fetch_all($proveedores);
$timbrado = pg_query($conexion,"SELECT * FROM timbrado;");
$tim= pg_fetch_all($timbrado);
$vehiculo = pg_query($conexion,"SELECT * FROM v_vehiculo where estado = 'ACTIVO';");
$vehi= pg_fetch_all($vehiculo);
$sucursal = pg_query($conexion,"SELECT * FROM sucursales;");
$sc= pg_fetch_all($sucursal);
?>
<div class="row">
    <div class="card">
        <div class="card-header">
            NOTA DE REMISION
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <label for="con_pedido_cabecera">CON FACTURA</label>
                <input type="checkbox" style="width: 50px; height: 50px;" id="con_pedido_cabecera" checked="">
            </div>
            <div class="col-sm-12">
                SELECCIONE MOTIVO
                <select id="id_mot_cabecera" class="form-control select2" style="width: 425px; height: 50px;">
                    <option>VENTA</option>
                </select>
            </div>
            <dl></dl>
            <div class="col-sm-12">
                SELECCIONE VEHICULO:
                <select id="id_vehi_cabecera" class="form-control select2" style="width: 407px; height: 50px;">
                    <?php foreach ($vehi as $v) {?>
                    <option value="<?php echo $v['vehi_cod'];?>">
                        <?php echo "Chapa N°: ".$v['vehi_chapa']." - Chofer: ".$v['funcionario'];?>
                    </option>
                    <?php }?>
                </select>
            </div>
            <dl></dl>
            <div class="col-sm-12">
                SELECCIONE EL CLIENTE:
                <select id="id_pro_cabecera" class="form-control select2" style="width: 400px; height: 50px;">
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
$cabecera = pg_query($conexion, "SELECT * FROM v_venta_remision WHERE rem_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['rem_cod'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_salida'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Funcionario: </b><?php echo $cab[0]['auditoria2'];?><br>
<b>Con Factura: </b><?php echo $cab[0]['con_fac'];?><br>
<b>Estado: </b><?php echo $cab[0]['estado'];?><br>
<?php } ?>