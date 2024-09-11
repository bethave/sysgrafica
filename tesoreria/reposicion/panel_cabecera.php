<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$asignacion = pg_query($conexion,"SELECT * FROM tasignacion_ff;");
$asig = pg_fetch_all($asignacion);

?>

<div class="row">
    <div class="card">
        <div class="card-header">
            REPOSICIÓN DE FONDO FIJO
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                SELECCIONE ASIGNACIÓN:
                <select class="chosen-select" id="id_asig_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Asignación</option>
                        <?php foreach ($asig as $a) {?>
                    <option value="<?php echo $a['asig_cod'];?>">
                        <?php echo "Código ".$a['asig_cod']." - Motivo: ".$a['asig_motivo'];?>
                    </option>
                        <?php }?>
                </select>
            </div>
            <dl></dl>
            <label>INGRESE - MONTO:..</label><input type="number" id="id_monto_cabecera">   
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