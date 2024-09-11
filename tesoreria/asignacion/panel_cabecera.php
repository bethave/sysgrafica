<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$caja = pg_query($conexion,"SELECT * FROM caja WHERE c_estado = 'ABIERTO';");
$caj = pg_fetch_all($caja);
?>
<div class="row">
    <div class="card">
        <div class="card-header">
            ASIGNACION DE FONDO FIJO
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                SELECCIONE CAJA:
                <select class="chosen-select" id="id_caja_cabecera" autocomplete="off">
                    <option hidden selected>Selecciona Caja</option>
                        <?php foreach ($caj as $c) {?>
                    <option value="<?php echo $c['caja_id'];?>">
                        <?php echo "Código ".$c['caja_id']." - ".$c['caja_descri']." - ".$c['c_estado'];?>
                    </option>
                        <?php }?>
                </select>
            </div>
            <dl></dl>
            <label>SELECCIONE - MOTIVO:..</label>
                <select id="id_mot_cabecera" >
                    <option>ASIGNACION</option>
                </select>
            <DL></DL>
            <label>INGRESE - MONTO:..</label><input type="number" id="id_monto_cabecera">
        </div>
    </div>
</div>
<div class="row">
    <button type="button" class="btn btn-danger" onclick="cancelar_cabecera();">CANCELAR</button>
    <button type="button" class="btn btn-primary" onclick="grabar_cabecera();">GRABAR</button>    
</div>
<?php }else{ 
$cabecera = pg_query($conexion, "SELECT * FROM v_asignacion WHERE asig_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['asig_cod'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Estado: </b><?php echo $cab[0]['asig_estado'];?><br>
<b>Funcionario: </b><?php echo $cab[0]['auditoria'];?><br>
<?php } ?>