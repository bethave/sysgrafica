<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_itemstock;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
                        <th>Marca</th>
			<th>Tipo Item</th>
                        <th>Tipo Impuesto</th>
                        <th>Descripcion</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Estado</th>
                        <th>Unidad Medida</th>
                        <th>Procedencia</th>
                        <th>Sucursal</th>
                        <th>Cantidad Disponible</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['id_item'];?>">
                                <a class="btn btn-dark" data-toggle="collapse" data-parent="#accordion<?php echo $d['id_item'];?>" href="#detalle<?php echo $d['id_item'];?>">
                                    <?php echo $d['id_item'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['mar_descrip'];?></td>
                        <td><?php echo $d['tpi_descrip'];?></td>
                        <td><?php echo $d['ti_descrip'];?></td>
                        <td><?php echo $d['item_descrip'];?></td>
			<td><?php echo $d['precio_compra'];?></td>
                        <td><?php echo $d['precio_venta'];?></td>
                        <td><?php echo $d['estado'];?></td>
                        <td><?php echo $d['um_descri'];?></td>
                        <td><?php echo $d['proce_descri'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td class="text-center"><?php echo $d['cantidad'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
