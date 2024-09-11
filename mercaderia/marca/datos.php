<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM marcas;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Código</th>
			<th>Descripción</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
			<tr title="<?php //echo $d['auditoria'];?>">
				<td><?php echo $d['id_mar'];?></td>
				<td><?php echo $d['mar_descrip'];?></td>
				<td><?php echo $d['estado'];?></td>
				<td>
					<div class="btn-group">
					<?php if($d['estado']=="ACTIVO"){?>
						<button title="Anular" type="button" class="btn btn-danger" onclick="inactivar(<?php echo $d['id_mar'];?>,'<?php echo $d['mar_descrip'];?>')">
							<i class="fas fa-minus"></i>
						</button>
						<button title="Editar" type="button" class="btn btn-warning" onclick="editar(<?php echo $d['id_mar'];?>,'<?php echo $d['mar_descrip'];?>')">
							<i class="fas fa-pen"></i>
						</button>
					<?php }?>
                                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['id_mar'];?>)">
                                            <i class="fas fa-list"></i>
                                            </button>
					</div>
				</td>
			</tr>
		<?php }?>
	</tbody>
</table>