<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_factura_reporte;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
                        <th>Tipo Factura</th>
			<th>Estado</th>
                        <th>Cuotas</th>
                        <th>Timbrado Nro</th>
                        <th>Vencimiento Timbrado</th>
                        <th>Posee Orden</th>
                        <th>Sucursal</th>
                        <th>Proveedor</th>
                        <th>Cuotas</th>
                        <th>Item</th>
                        <th>Precio</th>
                        <th>Iva</th>
                        <th>Cantidad</th>
                        <th>Monto</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['fac_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['fac_cod'];?>" href="#detalle<?php echo $d['fac_cod'];?>">
                                    <?php echo $d['fac_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['fac_tipo'];?></td>
                        <td><?php echo $d['fac_estado'];?></td>
                        <td><?php echo $d['fac_cuotas'];?></td>
                        <td><?php echo $d['fac_timnro'];?></td>
                        <td><?php echo $d['fac_vto'];?></td>
                        <td><?php echo $d['con_orden'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['proveedor'];?></td>
                        <td><?php echo $d['fac_cuotas'];?></td>
                        <td><?php echo $d['item_descrip'];?></td>
                        <td><?php echo $d['det_precio'];?></td>
                        <td><?php echo $d['iva'];?></td>
                        <td><?php echo $d['cantidad'];?></td>
                        <td><?php echo $d['monto'];?></td>
                    </tr>
		<?php }?>
                    
	</tbody>
</table>
