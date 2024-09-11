<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_venta_credito_reporte;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Tipo de Nota</th>
                        <th>Fecha</th>
			<th>Motivo</th>
                        <th>Nro Timbrado</th>
                        <th>Sucursal</th>
                        <th>Con Factura</th>
                        <th>Cliente</th>
                        <th>Estado</th>
                        <th>Funcionario</th>
                        <th>Item</th>
                        <th>Descripcion</th>
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
			<td><?php echo $d['tip_descri'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['mot_descri'];?></td>
                        <td><?php echo $d['tim_nro'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['con_fac'];?></td>
                        <td><?php echo $d['cliente'];?></td>
                        <td><?php echo $d['estado'];?></td>
                        <td><?php echo $d['auditoria2'];?></td>
                        <td><?php echo $d['id_item'];?></td>
                        <td><?php echo $d['item_descrip'];?></td>
                        <td><?php echo $d['precio'];?></td>
                        <td><?php echo $d['cantidad'];?></td>
                        <td><?php echo $d['iva'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
