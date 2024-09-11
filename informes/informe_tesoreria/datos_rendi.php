<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM repor_rendicion;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
                        <th>Asignacion Cod.</th>
			<th>Proveedor</th>
			<th>Sucursal</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Descripcion</th>
                        <th>Funcionario</th>
                        <th>Con Factura de Pago</th>
                        <th>Cod. Factura de Pago</th>
                        <th>Concepto</th>
                        <th>Total</th>
                        <th>IVA</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['ren_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['ren_cod'];?>" href="#detalle<?php echo $d['ren_cod'];?>">
                                    <?php echo $d['ren_cod'];?>
                                </a>
                               
                            </div>
                        </td>
                        <td><?php echo "Cod: ".$d['asig_cod']." - Motivo: ".$d['asig_motivo'];?></td>
                        <td><?php echo $d['proveedor'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['ren_estado'];?></td>
                        <td><?php echo $d['ren_descri'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        <td><?php echo $d['con_asig'];?></td>
                        <td><?php echo $d['facp_cod'];?></td>
                        <td><?php echo $d['facp_concepto'];?></td>
                        <td><?php echo $d['dr_total'];?></td>
                        <td><?php echo $d['dr_iva'];?></td>
                        </tr>		
                    <?php }?>
	</tbody>
</table>
