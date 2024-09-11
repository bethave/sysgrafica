<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$boleta = pg_query($conexion,"SELECT * FROM tboleta_dep;");
$bol = pg_fetch_all($boleta);

$cuenta = pg_query($conexion,"SELECT * FROM tcuen_bank;");
$cuen= pg_fetch_all($cuenta);

$chequera = pg_query($conexion,"SELECT * FROM tchequera;");
$che = pg_fetch_all($chequera);

$liqui = pg_query($conexion,"SELECT * FROM tliq_tarj;");
$liq = pg_fetch_all($liqui);

$otros = pg_query($conexion,"SELECT * FROM totros_dc;");
$otr = pg_fetch_all($otros);
?>

<div class="row">
    <div class="card">
        <div class="card-header">
            CONCILIACIÓN BANCARIA
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                SELECCIONE BOLETA DE DEPOSITO:
                <select class="chosen-select" id="id_bd_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Boleta de Depósito</option>
                        <?php foreach ($bol as $b) {?>
                    <option value="<?php echo $b['bdep_cod'];?>">
                        <?php echo "Código ".$b['bdep_cod']." - Importe ".$b['bdep_importe'];?>
                    </option>
                        <?php }?>
                </select>
            </div>
            <dl></dl>
            <div class="col-sm-12">
                SELECCIONE CUENTA BANCARIA:
                <select class="chosen-select" id="id_cb_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Cuenta Bancaria</option>
                        <?php foreach ($cuen as $c) {?>
                    <option value="<?php echo $c['cuen_bank'];?>">
                        <?php echo "Código ".$c['cuen_bank']." - N° ".$c['cuen_nro'];?>
                    </option>
                        <?php }?>
                </select>
            </div>
            <dl></dl>
            <div class="col-sm-12">
                SELECCIONE CHEQUERA:
                <select class="chosen-select" id="id_ch_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Chequera</option>
                        <?php foreach ($che as $h) {?>
                    <option value="<?php echo $h['che_cod'];?>">
                        <?php echo "Código ".$h['che_cod']." - N° Cuenta ".$h['che_nrocuenta'];?>
                    </option>
                        <?php }?>
                </select>
            </div>
            <dl></dl>
            <div class="col-sm-12">
                SELECCIONE LIQUIDACIÓN CON TARJETA DE CRÉDITO:
                <select class="chosen-select" id="id_liq_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Liquidación con Tarjeta de Crédito</option>
                        <?php foreach ($liq as $l) {?>
                    <option value="<?php echo $l['liq_cod'];?>">
                        <?php echo "Código ".$l['liq_cod']." - N° ".$l['liq_nro']." - Concepto ".$l['liq_concepto'];?>
                    </option>
                        <?php }?>
                </select>
            </div>
            <dl></dl>
            <div class="col-sm-12">
                SELECCIONE OTROS DÉBITOS Y CRÉDITOS:
                <select class="chosen-select" id="id_cd_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Otros Débitos/Créditos</option>
                        <?php foreach ($otr as $o) {?>
                    <option value="<?php echo $o['otr_cod'];?>">
                        <?php echo "Código ".$o['otr_cod']." - Tipo ".$o['otr_tipo']." - Motivo ".$o['otr_motivo'];?>
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