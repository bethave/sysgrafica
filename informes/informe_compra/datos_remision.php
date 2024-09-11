<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_remision_reporte;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Motivo</th>
                        <th>Fecha</th>
			<th>Estado</th>
                        <th>Vehiculo Chapa</th>
                        <th>Posee Factura</th>
                        <th>Sucursal Llegada</th>
                        <th>Sucursal Salida</th>
                        <th>Proveedor</th>
                        <th>Item</th>
                        <th>Cantidad</th>
                        <th>Monto</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['rem_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['rem_cod'];?>" href="#detalle<?php echo $d['rem_cod'];?>">
                                    <?php echo $d['rem_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['rem_motivo'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['estado'];?></td>
                        <td><?php echo $d['vehi_chapa'];?></td>
                        <td><?php echo $d['con_factura'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['suc_salida'];?></td>
                        <td><?php echo $d['proveedor'];?></td>
			<td><?php echo $d['item_descrip'];?></td>
                        <td><?php echo $d['cantidad'];?></td>
                        <td><?php echo $d['monto'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
