<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_cliente;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
                        <th>Estado</th>
			<th>Nombre y Apellido</th>
                        <th>Nroº Celular</th>
                        <th>Direccion</th>
                        <th>Email</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['cli_id'];?>">
                                <a class="btn btn-dark" data-toggle="collapse" data-parent="#accordion<?php echo $d['cli_id'];?>" href="#detalle<?php echo $d['cli_id'];?>">
                                    <?php echo $d['cli_id'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['cli_estado'];?></td>
                        <td><?php echo $d['persona'];?></td>
                        <td><?php echo $d['per_celular'];?></td>
                        <td><?php echo $d['per_direccion'];?></td>
			<td><?php echo $d['per_email'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
