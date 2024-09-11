<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_personas;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Código</th>
			<th>CI o RUC</th>
			<th>Nombre y Apellido</th>
			<th>Tipo de Persona</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['id_per'];?>">
                                <a class="btn btn-info" data-toggle="collapse" data-parent="#accordion<?php echo $d['id_per'];?>" href="#detalle<?php echo $d['id_per'];?>">
                                    <?php echo $d['id_per'];?>
                                </a>
                                <div id="detalle<?php echo $d['id_per'];?>" class="panel-collapse collapse in">
                                    <div class="card-body">
                                        <b>CI o RUC: </b><br><?php echo $d['per_ruc'];?><br>
                                        <b>Nombre y Apellido: </b><br><?php echo $d['persona'];?><br>
                                        <b>Numero de Celular: </b><br><?php echo $d['per_celular'];?><br>
                                        <b>Correo: </b><br><?php echo $d['per_email'];?><br>
                                        <b>Direccion: </b><br><?php echo $d['per_direccion'];?><br>
                                        <b>Ciudad: </b><br><?php echo $d['ciu_descrip'];?><br>
                                        <b>Genero: </b><br><?php echo $d['gen_descrip'];?><br>
                                        <b>Pais: </b><br><?php echo $d['pais_descrip'];?><br>
                                        <b>Gentilicio: </b><br><?php echo $d['gentilicio'];?><br>
                                    </div>
                                </div>
                            </div>
                        </td>
			<td><?php echo $d['per_ruc'];?></td>
			<td><?php echo $d['persona'];?></td>
			<td><?php echo $d['tper_descrip'];?></td>
			<td><?php echo $d['estado'];?></td>
			<td>
                            <?php if($d['estado']=='ACTIVO'){ ?>
                            <!--<button title="Editar" type="button" class="btn btn-warning" onclick="editar(<?php echo $d['id_per'];?>,'<?php echo $d['per_ruc'];?>','<?php echo $d['per_nombre'];?>','<?php echo $d['per_apellido'];?>','<?php echo $d['per_celular'];?>','<?php echo $d['per_email'];?>','<?php echo $d['per_direccion'];?>',<?php echo $d['id_ciu'];?>,<?php echo $d['id_gen'];?>,<?php echo $d['id_tper'];?>)">
				<i class="fas fa-pen"></i>
                            </button>-->
                            <button title="Inactivar" type="button" class="btn btn-danger" onclick="inactivar(<?php echo $d['id_per'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <?php } ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['id_per']; ?>)">
                                <i class="fas fa-list"></i>
                            </button>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>