<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_venta_factura_reporte;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
                        <th>Tipo de Factura</th>
			<th>Estado</th>
                        <th>Cuotas</th>
                        <th>Apertura Nro</th>
                        <th>Timbrado Nro</th>
                        <th>Con Presupuesto</th>
                        <th>Sucursal</th>
                        <th>Cliente</th>
                        <th>Funcionario</th>
                        <th>Item</th>
                        <th>Descripción</th>
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
                        <td><?php echo $d['aper_cod'];?></td>
                        <td><?php echo $d['tim_nro'];?></td>
                        <td><?php echo $d['con_presu'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['cliente'];?></td>
                        <td><?php echo $d['auditoria2'];?></td>
                        <td><?php echo $d['id_item'];?></td>
                        <td><?php echo $d['item_descrip'];?></td>
			<td><?php echo $d['precio'];?></td>
                        <td><?php echo $d['iva'];?></td>
                        <td><?php echo $d['cantidad'];?></td>
                        <td><?php echo $d['monto'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
