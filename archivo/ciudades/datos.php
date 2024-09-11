<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_ciudades;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Ciudad</th>
			<th>Pais</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['id_ciu'];?>">
                                <a class="btn btn-info" data-toggle="collapse" data-parent="#accordion<?php echo $d['id_ciu'];?>" href="#detalle<?php echo $d['id_ciu'];?>">
                                    <?php echo $d['id_ciu'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['ciu_descrip'];?></td>
			<td><?php echo $d['pais'];?></td>
			<td><?php echo $d['estado'];?></td>
			<td>
                            <?php if($d['estado']=='ACTIVO'){ ?>
                            <button title="Editar" type="button" class="btn btn-warning" onclick="editar(<?php echo $d['id_ciu'];?>)">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button title="Inactivar" type="button" class="btn btn-danger" onclick="inactivar(<?php echo $d['id_ciu'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="Activar" type="button" class="btn btn-success" onclick="activar(<?php echo $d['id_ciu']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['id_ciu']; ?>)">
                                <i class="fas fa-list"></i>
                            </button>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>