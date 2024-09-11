<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_reposicion;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Sucursal</th>
			<th>Fecha</th>
                        <th>Datos de Asignacion</th>
                        <th>Monto de Reposición</th>
                        <th>Funcionario</th>
                        <th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['rep_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['rep_cod'];?>" href="#detalle<?php echo $d['rep_cod'];?>">
                                    <?php echo $d['rep_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo "Cod: ".$d['asig_cod']." - Motivo: ".$d['asig_motivo'];?></td>
                        <td><?php echo $d['rep_monto'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        <td><?php echo $d['estado'];?></td>
                        </tr>		
                    <?php }?>
	</tbody>
</table>
