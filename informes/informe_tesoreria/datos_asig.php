<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_asignacion;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
			<th>Sucursal</th>
                        <th>Caja</th>
                        <th>Estado</th>
                        <th>Motivo</th>
                        <th>Monto de Asignacion</th>
                        <th>Funcionario</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['asig_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['asig_cod'];?>" href="#detalle<?php echo $d['asig_cod'];?>">
                                    <?php echo $d['asig_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo "Cod: ".$d['caja_id']." - Descripcion: ".$d['caja_descri']." - Estado: ".$d['c_estado'];?></td>
                        <td><?php echo $d['asig_estado'];?></td>
                        <td><?php echo $d['asig_motivo'];?></td>
                        <td><?php echo $d['asig_monto'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        </tr>		
                    <?php }?>
	</tbody>
</table>
