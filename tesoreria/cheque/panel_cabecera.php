<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$proveedores = pg_query($conexion,"SELECT * FROM v_proveedores WHERE estado = 'ACTIVO';");
$prov = pg_fetch_all($proveedores);
$chequera = pg_query($conexion,"SELECT * FROM tchequera WHERE che_estado = 'ACTIVO';");
$cheq = pg_fetch_all($chequera);
?>

<div class="row">
    <div class="card">
        <div class="card-header">
            ENTREGA DE CHEQUES
        </div>
        <div class="card-body">
            <label>SELECCIONE - CONCEPTO:..</label>
                <select id="id_con_cabecera" >
                    <option>PAGO A PROVEEDORES</option>
                </select>
            <dl></dl>
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
            <dl></dl>
                <div class="col-sm-12">
                SELECCIONE CHEQUERA:
                <select class="chosen-select" id="id_cheq_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Chequera</option>
                        <?php foreach ($cheq as $c) {?>
                    <option value="<?php echo $c['che_cod'];?>">
                        <?php echo "Código ".$c['che_cod']." - Cuenta NRO ".$c['che_nrocuenta'];?>
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