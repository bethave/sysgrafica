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
			<th>Sucursal</th>
                        <th>Celular</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['id_dep'];?>">
                                <a class="btn btn-info" data-toggle="collapse" data-parent="#accordion<?php echo $d['id_dep'];?>" href="#detalle<?php echo $d['id_dep'];?>">
                                    <?php echo $d['id_dep'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['suc_celular'];?></td>
			<td><?php echo $d['estado'];?></td>
			<td>
                            <?php if($d['estado']=='ACTIVO'){ ?>
                            <button title="Editar" type="button" class="btn btn-warning" onclick="editar(<?php echo $d['id_dep'];?>)">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="inactivar(<?php echo $d['id_dep'];?>,'<?php echo $d['suc_nombre'];?>')">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php } ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['id_dep']; ?>)">
                                <i class="fas fa-list"></i>
                            </button>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>