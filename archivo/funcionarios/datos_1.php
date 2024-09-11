<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_funcionario;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Código Persona</th>
                        <th>Persona</th>
			<th>Codigo Cargo</th>
			<th>Cargo</th>
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
                                        <li class="nav-item"><a class="nav-link active" href="#btnc<?php echo $d['id_fun'];?>" data-toggle="tab">Codigo</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#btnd<?php echo $d['id_fun'];?>" data-toggle="tab">Detalle</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="btnc<?php echo $d['id_fun'];?>">
                                            <?php echo $d['id_fun'];?>
                                        </div>
                                        <div class="tab-pane" id="btnd<?php echo $d['id_fun'];?>">
                                            <b>Codigo Persona: </b><br><?php echo $d['id_per'];?><br>
                                            <b>Persona: </b><br><?php echo $d['persona'];?><br>
                                            <b>Codigo Cargo: </b><br><?php echo $d['id_car'];?><br>
                                            <b>Gargo: </b><br><?php echo $d['car_descrip'];?><br>
                                            <b>Estado: </b><br><?php echo $d['estado'];?><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
			<td>
                            
                            <div id="detalle<?php echo $d['id_fun'];?>" class="panel-collapse collapse in">
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </td>
			<td>
                            <?php echo $d['persona'];?>
                            <?php echo $d['car_descrip'];?>
                        </td>
			<td><?php echo $d['estado'];?></td>
			<td>
                            <?php if($d['estado']=='ACTIVO'){ ?>
                            <button title="Editar" type="button" class="btn btn-warning" onclick="editar(<?php echo $d['id_fun'];?>)">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button title="Inactivar" type="button" class="btn btn-danger" onclick="inactivar(<?php echo $d['id_fun'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="Activar" type="button" class="btn btn-success" onclick="activar(<?php echo $d['id_fun']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['id_fun']; ?>)">
                                <i class="fas fa-list"></i>
                            </button>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>