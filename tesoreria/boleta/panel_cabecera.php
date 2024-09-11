<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$tipo = pg_query($conexion,"SELECT * FROM tipo_documento;");
$tip = pg_fetch_all($tipo);

$chequera = pg_query($conexion,"SELECT * FROM tchequera");
$che = pg_fetch_all($chequera);

$cuenta = pg_query($conexion,"select * from tcuen_bank");
$cuen = pg_fetch_all($cuenta);

?>

<div class="row">
    <div class="card">
        <div class="card-header">
            BOLETA DE DEPÓSITO
        </div>
        <div class="card-body">
            <label>INGRESE - NÚMERO DE BOLETA:..</label><input type="number" id="id_nro_cabecera">
            <dl></dl>
            <div class="col-sm-12">
                SELECCIONE TIPO DE DOCUMENTO:
                <select class="chosen-select" id="id_td_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Tipo de Documento</option>
                        <?php foreach ($tip as $t) {?>
                    <option value="<?php echo $t['tip_cod'];?>">
                        <?php echo "Código ".$t['tip_cod']." - ".$t['tip_descri'];?>
                    </option>
                        <?php }?>
                </select>
            </div>
            <dl></dl>
            <label>SELECCIONE - TIPO DE OPERACIÓN:..</label>
                <select id="id_to_cabecera" >
                    <option>DEPOSITO</option>
                </select>
            <DL></DL>
            <div class="col-sm-12">
            SELECCIONE CHEQUERA:
                <select class="chosen-select" id="id_ch_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Chequera</option>
                        <?php foreach ($che as $ch) {?>
                    <option value="<?php echo $ch['che_cod'];?>">
                        <?php echo "Código ".$ch['che_cod']." - ".$ch['che_nrocuenta'];?>
                    </option>
                        <?php }?>
                </select>
            </div>
            <dl></dl>
            <label>INGRESE - IMPORTE:..</label><input type="number" id="id_imp_cabecera">
            <dl></dl>
            
            <div class="col-sm-12">
            SELECCIONE CUENTA BANCARIA:
                <select class="chosen-select" id="id_cb_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Cuenta</option>
                        <?php foreach ($cuen as $cu) {?>
                    <option value="<?php echo $cu['cuen_bank'];?>">
                        <?php echo "Código ".$cu['cuen_bank']." - ".$cu['cuen_nro'];?>
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