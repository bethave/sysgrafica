<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_timbrado;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
                        <th>Timbrado Nroº</th>
			<th>Nroº Expedición</th>
                        <th>Nroº Establecimiento</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha fin</th>
                        <th>Nroº Desde</th>
                        <th>Nroº Hasta</th>
                        <th>Ultimo Utilizado</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['tim_cod'];?>">
                                <a class="btn btn-dark" data-toggle="collapse" data-parent="#accordion<?php echo $d['tim_cod'];?>" href="#detalle<?php echo $d['tim_cod'];?>">
                                    <?php echo $d['tim_cod'];?>
                                </a>
                               
                            </div>
                        </td>
                        <td class="text-center"><?php echo $d['tim_nro'];?></td>
                        <td class="text-center"><?php echo $d['tim_pexpedicion'];?></td>
                        <td class="text-center"><?php echo $d['tim_establecimiento'];?></td>
                        <td class="text-center"><?php echo $d['tfecha_inicio'];?></td>
                        <td class="text-center"><?php echo $d['tfecha_fin'];?></td>
                        <td class="text-center"><?php echo $d['tdesde_nro'];?></td>
                        <td class="text-center"><?php echo $d['thasta_nro'];?></td>
                        <td class="text-center"><?php echo $d['tnro_ultimo'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
