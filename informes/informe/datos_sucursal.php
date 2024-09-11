<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM sucursales;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
                        <th>RUC</th>
			<th>Nombre</th>
                        <th>Email</th>
                        <th>Celular</th>
                        <th>Direccion</th>
                        <th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['id_suc'];?>">
                                <a class="btn btn-dark" data-toggle="collapse" data-parent="#accordion<?php echo $d['id_suc'];?>" href="#detalle<?php echo $d['id_suc'];?>">
                                    <?php echo $d['id_suc'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['suc_ruc'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['suc_email'];?></td>
                        <td><?php echo $d['suc_celular'];?></td>
			<td><?php echo $d['suc_direccion'];?></td>
                        <td><?php echo $d['estado'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
