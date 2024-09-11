<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$proveedores = pg_query($conexion,"SELECT * FROM v_proveedores WHERE estado = 'ACTIVO';");
$prov = pg_fetch_all($proveedores);
$vehiculos = pg_query($conexion,"SELECT * FROM v_vehiculo WHERE estado = 'ACTIVO';");
$vehi = pg_fetch_all($vehiculos);
$sucursal = pg_query($conexion,"SELECT * FROM sucursal2;");
$suc = pg_fetch_all($sucursal);

?>
<div class="row">
    <div class="card">
        <div class="card-header">
            ORDEN DE COMPRA
        </div>
        <dl></dl>
        <div class="card-body">
            <div class="col-sm-12">
                <label for="con_pedido_cabecera">CON FACTURA</label>
                <input type="checkbox" style="width: 50px; height: 50px;" id="con_pedido_cabecera" checked="">
            </div>
            <dl></dl>
            <div class="col-sm-12" style="width: 400px; height: 50px;">
                SELECCIONE EL MOTIVO:
                <select id="id_motivo">
                    <option>COMPRA</option>
                    <option>TRASLADO</option>
                </select>
            </div>
            <dl></dl>
            <div class="col-sm-12">
                SELECCIONE EL VEHICULO:
                <select id="id_vehi_cabecera" class="form-control select2" style="width: 414px; height: 50px;">
                    <?php foreach ($vehi as $p) {?>
                    <option value="<?php echo $p['vehi_cod'];?>">
                        <?php echo 'ChapaNro: '.$p['vehi_chapa']. ' - Chofer:'.$p['funcionario'];?>
                    </option>
                    <?php }?>
                </select>
            </div >
             <dl></dl>
            <div class="col-sm-12">
                SELECCIONE LA SUCURSAL DE LLEGADA:
                <select id="id_suc2_cabecera" class="form-control select2" style="width: 325px; height: 50px;">
                    <?php foreach ($suc as $su) {?>
                    <option value="<?php echo $su['id_suc2'];?>">
                        <?php echo $su['suc_descri'];?>
                    </option>
                    <?php }?>
                </select>
            </div >
            <dl></dl>
            <div class="col-sm-12">
                SELECCIONE EL PROVEEDOR:
                <select id="id_pro_cabecera" class="form-control select2" style="width: 400px; height: 50px;">
                    <?php foreach ($prov as $p) {?>
                    <option value="<?php echo $p['id_pro'];?>">
                        <?php echo $p['persona']." (".$p['per_ruc'].")";?>
                    </option>
                    <?php }?>
                </select>
            </div >
            <div class="modal-body">
                INGRESE NRO DE TIMBRADO<input class="form-control" type="text" id="id_tim_cabecera" autofocus="true" maxlength="8" title="VALIDO HASTA 8 DIGITOS" placeholder="8 DIGITOS" style="width: 200px; height: 50px;">
            </div>
            <div class="modal-body">
                 INGRESE VTO DE TIMBRADO<input class="form-control" type="date" id="id_vto_cabecera" autofocus="true"  title="VENCIMIENTO DEL TIMBRADO" style="width: 200px; height: 50px;">
            </div>
            <div class="modal-body">
                 INGRESE NRO DE NOTA REMISION<input class="form-control" type="text" id="id_nro_cabecera" autofocus="true" maxlength="13" title="VALIDO HASTA 13 DIGITOS" placeholder="13 DIGITOS" style="width: 200px; height: 50px;">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <button type="button" class="btn btn-danger" onclick="cancelar_cabecera();">CANCELAR</button>
    <button type="button" class="btn btn-primary" onclick="grabar_cabecera();">GRABAR</button>    
</div>
<?php }else{ 
$cabecera = pg_query($conexion, "SELECT * FROM v_remision_compra WHERE rem_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['rem_cod'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['salida'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Proveedor: </b><?php echo $cab[0]['proveedor'];?><br>
<b>Con Factura: </b><?php echo $cab[0]['con_factura'];?><br>
<b>Estado: </b><?php echo $cab[0]['estado'];?><br>
<?php } ?>