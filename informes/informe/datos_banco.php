<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM banco;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
                        <th>Descripcion</th>
			<th>Telefono</th>
                        <th>Email</th>
                        <th>Direccion</th>
                        <th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['ban_cod'];?>">
                                <a class="btn btn-dark" data-toggle="collapse" data-parent="#accordion<?php echo $d['ban_cod'];?>" href="#detalle<?php echo $d['ban_cod'];?>">
                                    <?php echo $d['ban_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['ban_descri'];?></td>
                        <td><?php echo $d['ban_tel'];?></td>
                        <td><?php echo $d['ban_email'];?></td>
                        <td><?php echo $d['ban_direc'];?></td>
                        <td><?php echo $d['estado'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
