<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_orden_reporte;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Cod</th>
			<th>Fecha</th>
                        <th>Estado</th>
                        <th>Sucursal</th>
			<th>Con Presupuesto</th>
                        <th>Proveedor</th>
                        <th>Item</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Monto</th>
                        <th>Iva</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['id_co'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['id_co'];?>" href="#detalle<?php echo $d['id_co'];?>">
                                    <?php echo $d['id_co'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['estado'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['con_presu'];?></td>
                        <td><?php echo $d['proveedor'];?></td>
                        <td><?php echo $d['item_descrip'];?></td>
                        <td><?php echo $d['d_cantidad'];?></td>
                        <td><?php echo $d['precio'];?></td>
                        <td><?php echo $d['monto'];?></td>
                        <td><?php echo $d['iva'];?></td>
			
                    </tr>
		<?php }?>
	</tbody>
</table>
