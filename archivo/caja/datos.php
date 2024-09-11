<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM caja;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Caja Descripcion</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['caja_id'];?>">
                                <a class="btn btn-info" data-toggle="collapse" data-parent="#accordion<?php echo $d['caja_id'];?>" href="#detalle<?php echo $d['caja_id'];?>">
                                    <?php echo $d['caja_id'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['caja_descri'];?></td>
			<td><?php echo $d['c_estado'];?></td>
			<td>
                            <?php if($d['c_estado']=='ABIERTO'){ ?>
                            <button title="Editar" type="button" class="btn btn-warning" onclick="editar(<?php echo $d['caja_id'];?>,'<?php echo $d['caja_descri'];?>','<?php echo $d['c_estado'];?>')">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="inactivar(<?php echo $d['caja_id'];?>,'<?php echo $d['caja_descri'];?>')">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php } ?>
                            <?php if($d['c_estado']=='CERRADO'){ ?>
                            <button title="Editar" type="button" class="btn btn-warning" onclick="editar(<?php echo $d['caja_id'];?>,'<?php echo $d['caja_descri'];?>','<?php echo $d['c_estado'];?>')">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="inactivar(<?php echo $d['caja_id'];?>,'<?php echo $d['caja_descri'];?>')">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php } ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['caja_id']; ?>)">
                                <i class="fas fa-list"></i>
                            </button>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>
