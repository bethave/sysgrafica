<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM marcas;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['id_mar'];?>">
                                <a class="btn btn-dark" data-toggle="collapse" data-parent="#accordion<?php echo $d['id_mar'];?>" href="#detalle<?php echo $d['id_mar'];?>">
                                    <?php echo $d['id_mar'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['mar_descrip'];?></td>
                        <td><?php echo $d['estado'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
