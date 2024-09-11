<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_cierre_reporte;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
                        <th>Hora</th>
			<th>Estado</th>
                        <th>Monto Efectivo</th>
                        <th>Monto Cheque</th>
                        <th>Monto Tarjeta</th>
                        <th>Monto Total</th>
                        <th>Faltante</th>
                        <th>Sobrante</th>
                        <th>Denominación</th>
                        <th>Sucursal</th>
                        <th>Caja</th>
                        <th>Apertura</th>
                        <th>Funcionario</th>
                        <th>Arqueo Nro</th>
                        <th>Recaudación Nro</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['cie_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['cie_cod'];?>" href="#detalle<?php echo $d['cie_cod'];?>">
                                    <?php echo $d['cie_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['hora'];?></td>
                        <td><?php echo $d['cie_estado'];?></td>
                        <td><?php echo $d['cie_totalefectivo'];?></td>
                        <td><?php echo $d['cie_totalcheque'];?></td>
                        <td><?php echo $d['cie_totaltarjeta'];?></td>
                        <td><?php echo $d['cie_montototal'];?></td>
                        <td><?php echo $d['cie_faltante'];?></td>
                        <td><?php echo $d['cie_sobrante'];?></td>
                        <td><?php echo $d['den_tipo'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['caja_descri']."-".$d['c_estado'];?></td>
                        <td><?php echo $d['aper_cod']."-".$d['aper_minicial'];?></td>
                        <td><?php echo $d['auditoria2'];?></td>
                        <td><?php echo $d['arq_cod'];?></td>
                        <td><?php echo $d['rec_cod'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>
