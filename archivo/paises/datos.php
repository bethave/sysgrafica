<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM paises;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Código</th>
			<th>Descripción</th>
                        <th>Gentilicio</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
			<tr title="<?php //echo $d['auditoria'];?>">
				<td><?php echo $d['id_pais'];?></td>
				<td><?php echo $d['pais_descrip'];?></td>
                                <td><?php echo $d['gentilicio'];?></td>
				<td><?php echo $d['estado'];?></td>
				<td>
					<div class="btn-group">
					<?php if($d['estado']=="ACTIVO"){?>
						<button title="Inactivar" type="button" class="btn btn-danger" onclick="inactivar(<?php echo $d['id_pais'];?>,'<?php echo $d['pais_descrip'];?>')">
							<i class="fas fa-minus"></i>
						</button>
						<button title="Editar" type="button" class="btn btn-warning" onclick="editar(<?php echo $d['id_pais'];?>,'<?php echo $d['pais_descrip'];?>')">
							<i class="fas fa-pen"></i>
						</button>
					<?php }else{?>
						<button title="Activar" type="button" class="btn btn-success" onclick="activar(<?php echo $d['id_pais'];?>,'<?php echo $d['pais_descrip'];?>')">
							<i class="fas fa-check"></i>
						</button>
					<?php }?>
					</div>
				</td>
			</tr>
		<?php }?>
	</tbody>
</table>