<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_remision_compra;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Cod.</th>
                        <th>NRO</th>
                        <th>Timbrado N°</th>
                        <th>Timbrado VTO</th>
                        <th>Motivo</th>
                        <th>Sucursal Salida</th>
                        <th>Sucursal Llegada</th>
			<th>Fecha</th>
			<th>Proveedor</th>
			<th>Con Factura</th>
                        <th>Vehiculo</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['rem_cod'];?></td>
                        <td><?php echo $d['rem_nro'];?></td>
                        <td><?php echo $d['rem_timnro'];?></td>
                        <td><?php echo $d['rem_timvto'];?></td>
                        <td><?php echo $d['rem_motivo'];?></td>
			<td><?php echo $_SESSION['suc_nombre'];?></td>
                        <td><?php echo $d['llegada'];?></td>
			<td><?php echo $d['fecha'];?></td>
			<td><?php echo $d['proveedor'];?></td>
			<td><?php echo $d['con_factura'];?></td>
                        <td><?php echo $d['vehi_cod']." - ".$d['vehi_chapa']." - ".$d['funcionario'];?></td>
			<td><?php echo $d['estado'];?></td>
			<td>
                            <?php if($d['estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="grabar_confirmar(<?php echo $d['rem_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['rem_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['rem_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['rem_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>