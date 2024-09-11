<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_ncd_reporte;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Tipo</th>
                        <th>Fecha</th>
			<th>Motivo</th>
                        <th>Timbrado Nro</th>
                        <th>Timbrado Vto</th>
                        <th>Sucursal</th>
                        <th>Proveedor</th>
                        <th>Posee Factura</th>
                        <th>Estado</th>
                        <th>Item</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Iva</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['cred_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['cred_cod'];?>" href="#detalle<?php echo $d['cred_cod'];?>">
                                    <?php echo $d['cred_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['cred_tipo'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['cred_motivo'];?></td>
                        <td><?php echo $d['cred_timnro'];?></td>
                        <td><?php echo $d['cred_timvto'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['proveedor'];?></td>
                        <td><?php echo $d['con_fac'];?></td>
			<td><?php echo $d['estado'];?></td>
                        <td><?php echo $d['item_descrip'];?></td>
                        <td><?php echo $d['ncd_precio'];?></td>
                        <td><?php echo $d['ncd_cantidad'];?></td>
                        <td><?php echo $d['iva'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
