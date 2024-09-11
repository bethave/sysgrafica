<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$denominacion = pg_query($conexion,"SELECT * FROM denominaciones WHERE den_estado = 'ACTIVO';");
$den = pg_fetch_all($denominacion);

$caja = pg_query($conexion,"SELECT * FROM caja WHERE c_estado = 'ABIERTO';");
$caj = pg_fetch_all($caja);

$apertura = pg_query($conexion,"SELECT * FROM v_apertura WHERE estado = 'ABIERTO';");
$aper = pg_fetch_all($apertura);

?>
<div class="row">
    <div class="card"></div>
            <dl></dl>
            <div class="col-sm-12">
                SELECCIONE APERTURA:
                <select id="id_aper_cabecera" class="form-control select2" style="width: 450px; height: 450px;">
                    <?php foreach ($aper as $ape) {?>
                    <option value="<?php echo $ape['aper_cod'];?>">
                        <?php echo "Apertura cod ".$ape['aper_cod']." - estado ".$ape['estado']." - ".$ape['caja_descri']." - ".$ape['aper_minicial'];?>
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
$cabecera = pg_query($conexion, "SELECT * FROM v_cierre WHERE cie_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['cie_cod'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Hora: </b><?php echo $cab[0]['hora'];?><br>
<b>Estado: </b><?php echo $cab[0]['cie_estado'];?><br>
<?php } ?>