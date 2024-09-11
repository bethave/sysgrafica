<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_ajuste_reporte;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
                        <th>Estado</th>
			<th>Motivo</th>
                        <th>Sucursal</th>
                        <th>Item Nro</th>
                        <th>Item Descripcion</th>
                        <th>Cantidad</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['ajus_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['ajus_cod'];?>" href="#detalle<?php echo $d['ajus_cod'];?>">
                                    <?php echo $d['ajus_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['estado'];?></td>
                        <td><?php echo $d['mot_descri'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['id_item'];?></td>
                        <td><?php echo $d['item_descrip'];?></td>
                        <td><?php echo $d['dajus_cantidad'];?></td>
			
                    </tr>
		<?php }?>
	</tbody>
</table>
