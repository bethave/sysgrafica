<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_funcionario;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
                        <th>Nombre y apellido</th>
			<th>Cargo</th>
                        <th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['id_fun'];?>">
                                <a class="btn btn-dark" data-toggle="collapse" data-parent="#accordion<?php echo $d['id_fun'];?>" href="#detalle<?php echo $d['id_fun'];?>">
                                    <?php echo $d['id_fun'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['persona'];?></td>
                        <td><?php echo $d['car_descrip'];?></td>
                        <td><?php echo $d['estado'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
