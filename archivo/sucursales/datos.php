<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM sucursales;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Código</th>
			<th>RUC</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Celular</th>
                        <th>Direccion</th>
                        <th>Ubicacion</th>
			<th>Estado</th>
                        <th>Imagen</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
			<tr title="<?php //echo $d['auditoria'];?>">
				<td><?php echo $d['id_suc'];?></td>
				<td><?php echo $d['suc_ruc'];?></td>
                                <td><?php echo $d['suc_nombre'];?></td>
                                <td><?php echo $d['suc_email'];?></td>
                                <td><?php echo $d['suc_celular'];?></td>
                                <td><?php echo $d['suc_direccion'];?></td>
                                <td><?php echo $d['suc_ubicacion'];?></td>
				<td><?php echo $d['estado'];?></td>
                                <td><?php echo $d['suc_imagen'];?></td>
				<td>
					<div class="btn-group">
					<?php if($d['estado']=="ACTIVO"){?>
						<button title="Inactivar" type="button" class="btn btn-danger" onclick="inactivar(<?php echo $d['id_suc'];?>,'<?php echo $d['suc_nombre'];?>')">
							<i class="fas fa-minus"></i>
						</button>
						<button title="Editar" type="button" class="btn btn-warning" onclick="editar(<?php echo $d['id_suc'];?>,'<?php echo $d['suc_ruc'];?>','<?php echo $d['suc_nombre'];?>','<?php echo $d['suc_email'];?>','<?php echo $d['suc_celular'];?>','<?php echo $d['suc_direccion'];?>','<?php echo $d['suc_ubicacion'];?>','<?php echo $d['suc_imagen'];?>')">
							<i class="fas fa-pen"></i>
						</button>
					<?php }?>
					</div>
				</td>
			</tr>
		<?php }?>
	</tbody>
</table>