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
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Direccion</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['ban_cod'];?>">
                                <a class="btn btn-info" data-toggle="collapse" data-parent="#accordion<?php echo $d['ban_cod'];?>" href="#detalle<?php echo $d['ban_cod'];?>">
                                    <?php echo $d['ban_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['ban_descri'];?></td>
                        <td><?php echo $d['ban_tel'];?></td>
                        <td><?php echo $d['ban_email'];?></td>
                        <td><?php echo $d['ban_direc'];?></td>
			<td><?php echo $d['estado'];?></td>
			<td>
                            <?php if($d['estado']=='ACTIVO'){ ?>
                            <button title="Editar" type="button" class="btn btn-warning" onclick="editar(<?php echo $d['ban_cod'];?>,'<?php echo $d['ban_descri'];?>','<?php echo $d['ban_tel'];?>','<?php echo $d['ban_email'];?>','<?php echo $d['ban_direc'];?>')">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="inactivar(<?php echo $d['ban_cod'];?>,'<?php echo $d['ban_descri'];?>')">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php } ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['ban_cod']; ?>)">
                                <i class="fas fa-list"></i>
                            </button>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>