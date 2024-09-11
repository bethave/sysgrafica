<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_deposito;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
                        <th>Nombre</th>
			<th>Estado</th>
                        <th>Nroº Celular</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['id_dep'];?>">
                                <a class="btn btn-dark" data-toggle="collapse" data-parent="#accordion<?php echo $d['id_dep'];?>" href="#detalle<?php echo $d['id_dep'];?>">
                                    <?php echo $d['id_dep'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['estado'];?></td>
                        <td><?php echo $d['suc_celular'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
