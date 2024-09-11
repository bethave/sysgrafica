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
                        <th>Descripcion</th>
			<th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['caja_id'];?>">
                                <a class="btn btn-dark" data-toggle="collapse" data-parent="#accordion<?php echo $d['caja_id'];?>" href="#detalle<?php echo $d['caja_id'];?>">
                                    <?php echo $d['caja_id'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['caja_descri'];?></td>
                        <td><?php echo $d['c_estado'];?></td>
                    </tr>
		
                <?php }?>    
	</tbody>
</table>
