<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM repor_ordenp;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
			<th>Estado</th>
                        <th>Sucursal</th>
                        <th>Proveedor</th>
                        <th>Forma de Pago</th>
                        <th>Observación</th>
                        <th>Cuenta Bancaria</th>
                        <th>Funcionario</th>
                        <th>Con Orden de Compra?</th>
                        <th>Cod. Orden de Compra</th>
                        <th>Cod. Item</th>
                        <th>Item</th>
                        <th>Monto</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['pag_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['pag_cod'];?>" href="#detalle<?php echo $d['pag_cod'];?>">
                                    <?php echo $d['pag_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['pag_estado'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['proveedor'];?></td>
                        <td><?php echo $d['pag_formapag'];?></td>
                        <td><?php echo $d['pag_obs'];?></td>
                        <td><?php echo $d['cuen_bank']." - NRO: ".$d['cuen_nro'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        <td><?php echo $d['con_ordcompra'];?></td>
                        <td><?php echo $d['id_co'];?></td>
                        <td><?php echo $d['id_item'];?></td>
                        <td><?php echo $d['item_descrip'];?></td>
                        <td><?php echo $d['dop_monto'];?></td>
                    </tr>		
                    <?php }?>
	</tbody>
</table>
