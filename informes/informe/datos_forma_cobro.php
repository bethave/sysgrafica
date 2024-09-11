<?php
	include "../../conexion.php";
	$conexion = conexion::conectar(); 
	$resultado = pg_query($conexion, "SELECT * FROM forma_cobro;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
                        <th>Descripcion</th>
			<th>Estado</th>
                        <th>Tipo Forma Cobro</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['fc_id'];?>">
                                <a class="btn btn-dark" data-toggle="collapse" data-parent="#accordion<?php echo $d['fc_id'];?>" href="#detalle<?php echo $d['fc_id'];?>">
                                    <?php echo $d['fc_id'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['fc_descri'];?></td>
                        <td><?php echo $d['estado'];?></td>
                        <td><?php echo $d['fc_tipo'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
