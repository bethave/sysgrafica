<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM repor_fac_pago;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
			<th>Estado</th>
                        <th>Concepto</th>
                        <th>Sucursal</th>
                        <th>Proveedor</th>
                        <th>Funcionario</th>
                        <th>Con Factura Compra?</th>
                        <th>Cod. Factura Compra</th>
                        <th>Cod. Item</th>
                        <th>Item</th>
                        <th>Monto</th>
                        <th>Iva</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['facp_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['facp_cod'];?>" href="#detalle<?php echo $d['facp_cod'];?>">
                                    <?php echo $d['facp_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['facp_estado'];?></td>
                        <td><?php echo $d['facp_concepto'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['proveedor'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        <td><?php echo $d['con_faccompra'];?></td>
                        <td><?php echo $d['fac_cod'];?></td>
                        <td><?php echo $d['id_item'];?></td>
                        <td><?php echo $d['item_descrip'];?></td>
                        <td><?php echo $d['dfp_monto'];?></td>
                        <td><?php echo $d['dfp_iva'];?></td>
                    </tr>		
                    <?php }?>
	</tbody>
</table>
