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
			<th>Nombre y Apellido</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['cli_id'];?>">
                                <a class="btn btn-info" data-toggle="collapse" data-parent="#accordion<?php echo $d['cli_id'];?>" href="#detalle<?php echo $d['cli_id'];?>">
                                    <?php echo $d['cli_id'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['persona'];?></td>
			<td><?php echo $d['cli_estado'];?></td>
			<td>
                            <?php if($d['cli_estado']=='ACTIVO'){ ?>
                            <button title="Editar" type="button" class="btn btn-warning" onclick="editar(<?php echo $d['cli_id']; ?>,'<?php echo $d['persona']; ?>')">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="inactivar(<?php echo $d['cli_id'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php } ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['cli_id']; ?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>