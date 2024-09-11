<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$cuenta = pg_query($conexion,"SELECT * FROM tcuen_bank;");
$cuen = pg_fetch_all($cuenta);
?>

<div class="row">
    <div class="card">
        <div class="card-header">
            TRANSFERENCIA BANCARIA
        </div>
        <div class="card-body">
            <div class="col-sm-12">
            </div>
            <dl></dl>
            <label>INGRESE - TITULAR:..</label><input type="text" id="id_ti_cabecera"> 
            <dl></dl>
            <label>INGRESE - CUENTA DEL TITULAR:..</label><input type="text" id="id_cti_cabecera">
            <dl></dl>
            <label>INGRESE - BENEFICIARIO:..</label><input type="text" id="id_ben_cabecera">
            <dl></dl>
            <label>INGRESE - CUENTA DEL BENEFICIARIO:..</label><input type="number" id="id_ctb_cabecera">
            <dl></dl>
            <label>INGRESE - CONCEPTO DE TRANSFERENCIA:..</label><input type="text" id="id_concepto_cabecera">
            <dl></dl>
            <label>INGRESE - IMPORTE DE TRANSFERENCIA:..</label><input type="number" id="id_im_cabecera">
            <dl></dl>
            <div class="row">
            SELECCIONE CUENTA BANCARIA:
                <select class="chosen-select" id="id_cuen_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona una Cuenta</option>
                    <?php foreach ($cuen as $c) {?>
                    <option value="<?php echo $c['cuen_bank'];?>">
                    <?php echo "Cod: ".$c['cuen_bank'];?> - Cuenta Nro: <?php echo $c['cuen_nro'];?>
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
$cabecera = pg_query($conexion, "SELECT * FROM v_transferencia WHERE tb_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['tb_cod'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Estado: </b><?php echo $cab[0]['estado'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Funcionario: </b><?php echo $_SESSION['auditoria'];?><br>
<?php } ?>