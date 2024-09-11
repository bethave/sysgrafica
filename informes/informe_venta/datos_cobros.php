<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_cobros_reporte;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
                        <th>Hora</th>
			<th>Importe</th>
                        <th>Estado</th>
                        <th>Forma de Cobro</th>
                        <th>Nro Comprobante</th>
                        <th>Nro Apertura</th>
                        <th>Cliente</th>
                        <th>Nro Timbrado</th>
                        <th>Con Factura</th>
                        <th>Sucursal</th>
                        <th>Banco</th>
                        <th>Funcionario</th>
                        <th>Cuenta Nro</th>
                        <th>Factura Nro</th>
                        <th>Monto Total</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['cobro_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['cobro_cod'];?>" href="#detalle<?php echo $d['cobro_cod'];?>">
                                    <?php echo $d['cobro_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['hora'];?></td>
                        <td><?php echo $d['cobro_importe'];?></td>
                        <td><?php echo $d['cobro_estado'];?></td>
                        <td><?php echo $d['fc_descri'];?></td>
                        <td><?php echo $d['cobro_nrocomprobante'];?></td>
                        <td><?php echo $d['aper_cod'];?></td>
                        <td><?php echo $d['cliente'];?></td>
                        <td><?php echo $d['tim_nro'];?></td>
                        <td><?php echo $d['con_factura'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['ban_descri'];?></td>
                        <td><?php echo $d['auditoria2'];?></td>
                        <td><?php echo $d['cuen_nro'];?></td>
                        <td><?php echo $d['fac_cod'];?></td>
                        <td><?php echo $d['montototal'];?></td>
                    </tr>
		<?php }?>
	</tbody>
</table>