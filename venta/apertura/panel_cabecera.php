<?php $id_oc = $_POST['id_oc']; 
include "../../conexion.php";
include "../../session.php";
$conexion = conexion::conectar();
if($id_oc == '0'){
$proveedores = pg_query($conexion,"SELECT * FROM caja WHERE c_estado = 'CERRADO';");
$prov = pg_fetch_all($proveedores);
?>
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="col-sm-12">
                SELECCIONE CAJA: 
                <select id="id_pro_cabecera" class="form-control select2">
                    <?php foreach ($prov as $p) {?>
                    <option value="<?php echo $p['caja_id'];?>">
                        <?php echo $p['caja_descri'];?>
                    </option>
                    <?php }?>
                </select>
            </div>
            INGRESE MONTO INICIAL <input type="number" id="id_minicial_cabecera" placeholder="MONTO INICIAL">
        </div>
    </div>
</div>
<div class="row">
    <button type="button" class="btn btn-danger" onclick="cancelar_cabecera();">CANCELAR</button>
    <button type="button" class="btn btn-primary" onclick="grabar_cabecera();">GRABAR</button>    
</div>
<?php }else{ 
$cabecera = pg_query($conexion, "SELECT * FROM v_apertura WHERE aper_cod = $id_oc;");
$cab = pg_fetch_all($cabecera); ?>
<b>Nro: </b><?php echo $cab[0]['aper_cod'];?><br>
<b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
<b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
<b>Hora: </b><?php echo $cab[0]['hora'];?><br>
<b>Estado: </b><?php echo $cab[0]['estado'];?><br>
<?php } ?>