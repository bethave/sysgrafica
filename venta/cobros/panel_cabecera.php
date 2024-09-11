<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$cliente = pg_query($conexion,"SELECT * FROM v_cliente WHERE cli_estado = 'ACTIVO';");
$cli = pg_fetch_all($cliente);
$aper = pg_query($conexion,"SELECT * FROM v_apertura WHERE estado = 'ABIERTO';");
$ape = pg_fetch_all($aper);
$timbrado = pg_query($conexion,"SELECT * FROM timbrado;");
$tim = pg_fetch_all($timbrado);
?>
<div class="row">
    <div class="card">
        <div class="card-header">
            COBRANZAS
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <label for="con_pedido_cabecera">CON CUENTA A COBRAR</label>
                <input type="checkbox" style="width: 50px; height: 50px;" id="con_pedido_cabecera" checked="true">
                <dl></dl>
            <div class="col-sm-12">
                SELECCIONE APERTURA:
                <select id="id_aper_cabecera" class="form-control select2" style="width: 500px;">
                    <?php foreach ($ape as $ap) {?>
                    <option value="<?php echo $ap['aper_cod'];?>">
                        <?php echo "Cod Apertura ".$ap['aper_cod']." - Descripcion ".$ap['caja_descri'];?>
                    </option>
                    <?php }?>
                </select>
            </div>
            <dl></dl>
            <div class="col-sm-12">
                SELECCIONE CLIENTE:
                <select id="id_cli_cabecera" class="form-control select2" style="width: 500px;">
                    <?php foreach ($cli as $cl) {?>
                    <option value="<?php echo $cl['cli_id'];?>">
                        <?php echo "Cliente ".$cl['cli_id']." - ".$cl['persona'];?>
                    </option>
                    <?php }?>
                </select>
            </div>
            <dl></dl>
        </div>
    </div>
</div>
    </div>
<div class="row">
    <button type="button" class="btn btn-danger" onclick="cancelar_cabecera();">CANCELAR</button>
    <button type="button" class="btn btn-primary" onclick="grabar_cabecera();">GRABAR</button>    
</div>
<?php }else{ 
$cabecera = pg_query($conexion, "SELECT * FROM v_cobros WHERE cobro_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['cobro_cod'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Cliente: </b><?php echo $cab[0]['cliente'];?><br>
<b>Con Factura: </b><?php echo $cab[0]['con_factura'];?><br>
<b>Estado: </b><?php echo $cab[0]['cobro_estado'];?><br>
<?php } ?>