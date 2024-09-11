<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_apertura;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
                        <th>Hora</th>
			<th>Estado</th>
                        <th>Monto Inicial</th>
                        <th>Sucursal</th>
                        <th>Caja</th>
                        <th>Funcionario</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['aper_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['aper_cod'];?>" href="#detalle<?php echo $d['aper_cod'];?>">
                                    <?php echo $d['aper_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['hora'];?></td>
                        <td><?php echo $d['estado'];?></td>
                        <td><?php echo $d['aper_minicial'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['caja_descri']."-".$d['c_estado'];?></td>
                        <td><?php echo $d['auditoria2'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
