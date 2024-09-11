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
           NOTA CREDITO / DEBITO
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <label for="con_pedido_cabecera">CON FACTURA</label>
                <input type="checkbox" style="width: 50px; height: 50px;" id="con_pedido_cabecera" checked="">
            </div>
            <div class="col-sm-12">
                SELECCION TIPO DE NOTA
                <select id="id_tipo_cabecera">
                    <option>CREDITO</option>
                    <option>DEBITO</option>
                </select>
            </div>
            <dl></dl>
            <div class="col-sm-12">
                SELECCION MOTIVO DE LA NOTA
                <select id="id_mot_cabecera">
                    <option>DESCUENTO</option>
                    <option>DEVOLUCION</option>
                    <OPTION>RETRASO EN EL PAGO</OPTION>
                    <OPTION>ERROR EN FACTURA</OPTION>
                </select>
            </div>
            <dl></dl>
            <div class="col-sm-12">
                SELECCIONE EL PROVEEDOR:
                <select id="id_pro_cabecera" class="form-control select2">
                    <?php foreach ($prov as $p) {?>
                    <option value="<?php echo $p['id_pro'];?>">
                        <?php echo $p['persona'].")";?>
                    </option>
                    <?php }?>
                </select>
            </div >
             <div class="modal-body">
                 INGRESE NRO DE TIMBRADO<input class="form-control" type="text" id="id_timbrado_cabecera" autofocus="true" maxlength="8" title="VALIDO HASTA 8 DIGITOS" placeholder="8 DIGITOS">
                </div>
            <div class="modal-body">
                INGRESE FECHA FIN DE TIMBRADO<input class="form-control" type="date" id="id_timvto_cabecera" autofocus="true">
            </div>
            <div class="modal-body">
                INGRESE NRO DE NOTA<input class="form-control" type="text" id="id_cred_nro_cabecera" autofocus="true" maxlength="13" title="VALIDO HASTA 13 DIGITOS" placeholder="13 DIGITOS">
            </div>
            <div class="modal-body">
                INGRESE PORCENTAJE A APLICAR<input class="form-control" type="text" id="id_porc_cabecera" autofocus="true" title="INGRESE PORCENTAJE DE DESCUENTO" value="0">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <button type="button" class="btn btn-danger" onclick="cancelar_cabecera();">CANCELAR</button>
    <button type="button" class="btn btn-primary" onclick="grabar_cabecera();">GRABAR</button>    
</div>
<?php }else{ 
$cabecera = pg_query($conexion, "SELECT * FROM v_ncd_compra WHERE cred_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>ID: </b><?php echo $cab[0]['cred_cod'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Timbrado: </b><?php echo $cab[0]['cred_timnro'];?><br>
<b>Estado: </b><?php echo $cab[0]['estado'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Proveedor: </b><?php echo $cab[0]['proveedor'];?><br>
<b>Con Factura: </b><?php echo $cab[0]['con_fac'];?><br>
<?php } ?>