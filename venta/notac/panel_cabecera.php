<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$proveedores = pg_query($conexion,"SELECT * FROM v_cliente WHERE cli_estado = 'ACTIVO';");
$prov = pg_fetch_all($proveedores);
$timbrado = pg_query($conexion,"SELECT * FROM timbrado;");
$tim = pg_fetch_all($timbrado);
$motivo = pg_query($conexion,"SELECT * FROM motivo_credito;");
$mot = pg_fetch_all($motivo);
$tipo = pg_query($conexion,"SELECT * FROM tipo_nota;");
$tip = pg_fetch_all($tipo);
?>

<div class="row">
    <div class="card">
        <div class="card-header">
            NOTA DE CREDITO/DEBITO
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <label for="con_pedido_cabecera">CON FACTURA</label>
                <input type="checkbox" style="width: 50px; height: 50px;" id="con_pedido_cabecera" checked="">
            </div>
            
            <div class="col-sm-12">
                SELECCIONE EL CLIENTE:
                <br>
                <select id="id_pro_cabecera" class="form-control select2">
                    <?php foreach ($prov as $p) {?>
                    <option value="<?php echo $p['cli_id'];?>">
                        <?php echo $p['persona'];?>
                    </option>
                    <?php }?>
                </select>
            </div>
            <dl></dl>
               <div class="col-sm-12">
                SELECCIONE EL TIPO DE NOTA:
                <br>
                <select id="id_tipo_cabecera" class="form-control select2">
                    <?php foreach ($tip as $ti) {?>
                    <option value="<?php echo $ti['tip_cod'];?>">
                        <?php echo $ti['tip_descri'];?>
                    </option>
                    <?php }?>
                </select>
            </div>
            <dl></dl>
                <div class="col-sm-12">
                SELECCIONE EL MOTIVO:
                <br>
                <select id="id_motivo_cabecera" class="form-control select2">
                    <?php foreach ($mot as $m) {?>
                    <option value="<?php echo $m['mot_cod'];?>">
                        <?php echo $m['mot_descri'];?>
                    </option>
                    <?php }?>
                </select>
            </div>
            <dl></dl>
        </div>
    </div>
</div>

<div class="row">
    <button type="button" class="btn btn-danger" onclick="cancelar_cabecera();">CANCELAR</button>
    <button type="button" class="btn btn-primary" onclick="grabar_cabecera();">GRABAR</button>    
</div>
<?php }else{ 
$cabecera = pg_query($conexion, "SELECT * FROM v_venta_credito WHERE cred_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['cred_cod'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Timbrado: </b><?php echo $cab[0]['tim_nro'];?><br>
<b>Estado: </b><?php echo $cab[0]['estado'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Cliente: </b><?php echo $cab[0]['cliente'];?><br>
<b>Con Factura: </b><?php echo $cab[0]['con_fac'];?><br>
<b>Funcionario: </b><?php echo $_SESSION['per_nombre'];?><br>
<?php } ?>