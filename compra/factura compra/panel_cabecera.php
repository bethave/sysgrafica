<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$proveedores = pg_query($conexion,"SELECT * FROM v_proveedores WHERE estado = 'ACTIVO';");
$prov = pg_fetch_all($proveedores);

$tipo_fac = pg_query($conexion,"SELECT * FROM tipo_factura;");
$tipo = pg_fetch_all($tipo_fac);
?>
<div class="row">
    <div class="card">
        <div class="card-header">
            FACTURA COMPRA
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <label for="con_pedido_cabecera">CON ORDEN DE COMPRA</label>
                <input type="checkbox" style="width: 50px; height: 30px;" id="con_pedido_cabecera" disabled>
                <dl></dl>
                <div class="col-sm-6">
                SELECCIONE TIPO DE FACTURA:
                <select id="id_tf_cabecera" class="form-control select2" >
                    <?php foreach ($tipo as $t) {?>
                    <option value="<?php echo $t['tip_fac'];?>">
                        <?php echo $t['tip_descri'];?>
                    </option>
                    <?php }?>
                </select>
            </div>
                <dl></dl>
                <label>INSERTE CUOTAS:.. </label><input type="number" style="width: 50px; height: 30px;" id="id_cuota_cabecera" value="1">
            <dl></dl>
            <label>INSERTE INTERVALO:.. </label><input type="number" min="0" style="width: 50px; height: 30px;" id="id_intervalo_cabecera" value="1">
            <dl></dl>
            <label>INSERTE TIMBRADO N°:..</label><input type="text" style="width: 150px; height: 30px;" id="id_tim_cabecera" maxlength="8" value="" title="Sólo se permite agregar 8 digitos">
            <dl></dl>
            <label>INSERTE N° DE FACTURA:..</label><input type="text" style="width: 150px; height: 30px;" id="id_nf_cabecera" maxlength="13" value="" title="Sólo se permite agregar 13 digitos">
            <dl></dl>
            <label>INSERTE FECHA DE INICIO VIGENCIA DE TIMBRADO:..</label><input type="date" style="width: 150px; height: 30px;" id="id_inicio_cabecera" maxlength="8" value="" title="Ingrese Fecha Inicio">
            <dl></dl>
            <label>INSERTE FECHA DE FIN DE VIGENCIA TIMBRADO:..</label><input type="date" style="width: 150px; height: 30px;" id="id_fin_cabecera" maxlength="8" value="" title="Ingrese Fecha Fin">
            <dl></dl>
            </div>
            <div class="col-sm-10">
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
$cabecera = pg_query($conexion, "SELECT * FROM v_factura_compra WHERE fac_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['fac_cod'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Proveedor: </b><?php echo $cab[0]['proveedor'];?><br>
<b>Con Pedido: </b><?php echo $cab[0]['con_orden'];?><br>
<b>Estado: </b><?php echo $cab[0]['fac_estado'];?><br>
<?php } ?>