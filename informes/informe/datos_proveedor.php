<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_proveedores;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
                        <th>Estado</th>
			<th>Nombre y Apellido</th>
                        <th>C.I.Nroº</th>
                        <th>RUC</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['id_pro'];?>">
                                <a class="btn btn-dark" data-toggle="collapse" data-parent="#accordion<?php echo $d['id_pro'];?>" href="#detalle<?php echo $d['id_pro'];?>">
                                    <?php echo $d['id_pro'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['estado'];?></td>
                        <td><?php echo $d['persona'];?></td>
                        <td><?php echo $d['per_ci'];?></td>
                        <td><?php echo $d['per_ruc'];?></td>
			
                    </tr>
		<?php }?>
	</tbody>
</table>
