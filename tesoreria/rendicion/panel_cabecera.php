<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$proveedores = pg_query($conexion,"SELECT * FROM v_proveedores WHERE estado = 'ACTIVO';");
$prov = pg_fetch_all($proveedores);

$asignacion = pg_query($conexion,"SELECT * FROM v_asignacion;");
$asig = pg_fetch_all($asignacion);


?>
<div class="row">
    <div class="card">
        <div class="card-header">
            FACTURA VENTA
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <label for="con_pedido_cabecera">¿CON FACTURA DE PAGO?</label>
                <input type="checkbox" style="width: 50px; height: 50px;" id="con_pedido_cabecera" checked="true">
                <dl></dl>
            <div class="col-sm-12">
                SELECCIONE ASIGNACIÓN:
                <select class="chosen-select" id="id_asig_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Asignacion</option>
                        <?php foreach ($asig as $a) {?>
                    <option value="<?php echo $a['asig_cod'];?>">
                        <?php echo "Código ".$a['asig_cod']." - Motivo ".$a['asig_motivo']." - Monto ".$a['asig_monto']." - Caja ".$a['caja_descri'];?>
                    </option>
                        <?php }?>
                </select>
            </div>
                <dl></dl>
                <div class="col-sm-12">
                SELECCIONE ASIGNACIÓN:
                <select class="chosen-select" id="id_pro_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Proveedor</option>
                        <?php foreach ($prov as $p) {?>
                    <option value="<?php echo $p['id_pro'];?>">
                        <?php echo "Código: ".$p['id_pro']." - Proveedor: ".$p['persona'];?>
                    </option>
                        <?php }?>
                </select>
            </div>
            <dl></dl>
                <label>SELECCIONE - DESCRIPCIÓN:..</label>
                <select id="id_descri_cabecera" >
                    <option>RENDICION</option>
                </select>
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
$cabecera = pg_query($conexion, "SELECT * FROM v_venta_factura WHERE fac_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['fac_cod'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Cliente: </b><?php echo $cab[0]['cliente'];?><br>
<b>Con Presupuesto: </b><?php echo $cab[0]['con_presu'];?><br>
<b>Estado: </b><?php echo $cab[0]['fac_estado'];?><br>
<b>Funcionario: </b><?php echo $cab[0]['auditoria2'];?><br>
<?php } ?>