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
			<th>CI</th>
			<th>Persona</th>
			<th>Tipo de Persona</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div class="card">
                                <div class="card-header p-0">
                                    <ul class="nav nav-pills ml-auto p-2">
                                        <li class="nav-item"><a class="nav-link active" href="#btnc<?php echo $d['id_per'];?>" data-toggle="tab">Codigo</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#btnd<?php echo $d['id_per'];?>" data-toggle="tab">Detalle</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="btnc<?php echo $d['id_per'];?>">
                                            <?php echo $d['id_per'];?>
                                        </div>
                                        <div class="tab-pane" id="btnd<?php echo $d['id_per'];?>">
                                            <b>RUC: </b><br><?php echo $d['per_ruc'];?><br>
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
                            </div>
                        </td>
			<td>
                            <?php echo $d['per_ci'];?>
                            <div id="detalle<?php echo $d['id_per'];?>" class="panel-collapse collapse in">
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </td>
			<td>
                            <?php echo $d['persona'];?>
                        </td>
			<td><?php echo $d['tper_descrip'];?></td>
			<td><?php echo $d['estado'];?></td>
			<td>
                            <?php if($d['estado']=='ACTIVO'){ ?>
                            <button title="Editar" type="button" class="btn btn-warning" onclick="editar()">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button title="Inactivar" type="button" class="btn btn-danger" onclick="inactivar(<?php echo $d['id_per'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="Activar" type="button" class="btn btn-success" onclick="activar(<?php echo $d['id_per']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['id_per']; ?>)">
                                <i class="fas fa-list"></i>
                            </button>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>