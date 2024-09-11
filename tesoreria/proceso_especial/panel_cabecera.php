<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$cuenbank = pg_query($conexion,"SELECT * FROM v_cuenbank WHERE estado = 'ACTIVO';");
$cuen = pg_fetch_all($cuenbank);
?>
<div class="row">
    <div class="card">
        <div class="card-header">
            NOTA DE REMISION
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <label for="con_che_cabecera">CON CHEQUE</label>
                <input type="checkbox" style="width: 50px; height: 50px;" id="con_che_cabecera" checked="">
            </div>
            <div class="col-sm-12">
                <label for="con_ord_cabecera">CON ORDEN DE PAGO</label>
                <input type="checkbox" style="width: 50px; height: 50px;" id="con_ord_cabecera" checked="">
            </div>
            <dl></dl>
            <div class="col-sm-12">
                SELECCIONE CUENTA BANCARIA:
                <select class="chosen-select" id="id_cb_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Cuenta Bancaria</option>
                        <?php foreach ($cuen as $c) {?>
                    <option value="<?php echo $c['cuen_bank'];?>">
                        <?php echo "Código ".$c['cuen_bank']." - Cuenta NRO ".$c['cuen_nro']." - Banco ".$c['ban_descri'];?>
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
$cabecera = pg_query($conexion, "SELECT * FROM v_proc_especial WHERE proc_id = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['proc_id'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Funcionario: </b><?php echo $cab[0]['auditoria'];?><br>
<b>Con Cheque: </b><?php echo $cab[0]['con_cheque'];?><br>
<b>Con Orden: </b><?php echo $cab[0]['con_orden'];?><br>
<b>Estado: </b><?php echo $cab[0]['estado'];?><br>
<?php } ?>