<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$entidad = pg_query($conexion,"SELECT * FROM entidad;");
$ent = pg_fetch_all($entidad);

$cuenta = pg_query($conexion,"SELECT * FROM tcuen_bank;");
$cuen = pg_fetch_all($cuenta);

?>

<div class="row">
    <div class="card">
        <div class="card-header">
            LIQUIDACIÓN CON TARJETA DE CRÉDITO
        </div>
        <div class="card-body">
            <label>INGRESE - NUMERO DE LIQUIDACION:..</label><input type="number" id="id_nro_cabecera"><!--  -->
            <DL></DL>
            <label>SELECCIONE - DESCRIPCION:..</label>
                <select id="id_des_cabecera" >
                    <option>TARJETA DE CRÉDITO</option>
                </select>
            <DL></DL>
            <div class="col-sm-12">
                SELECCIONE ENTIDAD:
                <select class="chosen-select" id="id_ent_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Entidad</option>
                        <?php foreach ($ent as $e) {?>
                    <option value="<?php echo $e['ent_cod'];?>">
                        <?php echo "Código ".$e['ent_cod']." - Entidad: ".$e['ent_descri'];?>
                    </option>
                        <?php }?>
                </select>
            </div>
            <dl></dl>
             <div class="col-sm-12">
                SELECCIONE CUENTA BANCARIA:
                <select class="chosen-select" id="id_cb_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Cuenta Bancaria</option>
                        <?php foreach ($cuen as $cu) {?>
                    <option value="<?php echo $cu['cuen_bank'];?>">
                        <?php echo "Código ".$cu['cuen_bank']." - N° Cuenta: ".$cu['cuen_nro'];?>
                    </option>
                        <?php }?>
                </select>
            </div>
            <DL></DL>
            <label>SELECCIONE - CONCEPTO:..</label>
                <select id="id_con_cabecera" >
                    <option>LIQUIDACION MENSUAL</option>
                </select>
            <DL></DL>
            <label>INGRESE - TOTAL DE LIQUIDACIÓN:..</label><input type="number" id="id_total_cabecera">
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