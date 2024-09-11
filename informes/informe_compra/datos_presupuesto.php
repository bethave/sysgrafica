<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_presupuesto_reporte;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
                        <th>Estado</th>
			<th>Sucursal</th>
                        <th>Con Pedido</th>
                        <th>Proveedor</th>
                        <th>Item</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Monto</th>
                        <th>Iva</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['pre_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['pre_cod'];?>" href="#detalle<?php echo $d['pre_cod'];?>">
                                    <?php echo $d['pre_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['pre_estado'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['con_pedido'];?></td>
                        <td><?php echo $d['funcionario'];?></td>
                        <td><?php echo $d['item_descrip'];?></td>
                        <td><?php echo $d['dpre_preciounit'];?></td>
                        <td><?php echo $d['dpre_cantidad'];?></td>
			<td><?php echo $d['monto'];?></td>
                        <td><?php echo $d['iva'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
