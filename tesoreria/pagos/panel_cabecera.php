<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$cliente = pg_query($conexion,"SELECT * FROM v_cliente WHERE cli_estado = 'ACTIVO';");
$cli = pg_fetch_all($cliente);
$aper = pg_query($conexion,"SELECT * FROM v_proveedores WHERE estado = 'ACTIVO';");
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
            <div class="col-sm-12">
                SELECCIONE PROVEEDOR:
                <select id="id_pro_cabecera" class="form-control select2" style="width: 500px;">
                    <?php foreach ($ape as $ap) {?>
                    <option value="<?php echo $ap['id_pro'];?>">
                        <?php echo "Cod ".$ap['id_pro']." - Prov. ".$ap['persona'];?>
                    </option>
                    <?php }?>
                </select>
            </div>
            <dl></dl>
           
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
$cabecera = pg_query($conexion, "SELECT * FROM v_pagos WHERE pago_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['pago_cod'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['pago_fecha'];?><br>
<b>Proveedor: </b><?php echo $cab[0]['cliente'];?><br>
<b>Estado: </b><?php echo $cab[0]['pago_estado'];?><br>
<?php } ?>