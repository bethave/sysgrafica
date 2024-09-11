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
            OTROS DÉBITOS Y CRÉDITOS
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <label for="con_pedido_cabecera">CON BANCO</label>
                <input type="checkbox" style="width: 50px; height: 50px;" id="con_pedido_cabecera" checked="">
            </div>
            <dl></dl>
            <label>INGRESE - NÚMERO OTROS D/C:..</label><input type="number" id="id_nro_cabecera">
            <dl></dl>
            <label>SELECCIONE - TIPO:..</label>
                <select id="id_tp_cabecera" >
                    <option>CREDITO</option>
                    <option>DEBITO</option>
                </select>
            <DL></DL>
            <label>SELECCIONE - MOTIVO:..</label>
                <select id="id_mot_cabecera" >
                    <option>PRESTAMOS</option>
                </select>
            <DL></DL>
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