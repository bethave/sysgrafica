<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_liqtar;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>NRO</th>
			<th>Fecha</th>
                        <th>Descripcion</th>
                        <th>Sucursal</th>
                        <th>Entidad</th>
                        <th>Cuenta Bancaria</th>
                        <th>Concepto</th>
                        <th>Total</th>
                        <th>Funcionario</th>
                        <th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['liq_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['liq_cod'];?>" href="#detalle<?php echo $d['liq_cod'];?>">
                                    <?php echo $d['liq_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['liq_nro'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['liq_descri'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo "Cod: ".$d['ent_cod']." - Descripcion: ".$d['ent_descri'];?></td>
                        <td><?php echo "Cod: ".$d['cuen_bank']." - NRO: ".$d['cuen_nro'];?></td>
                        <td><?php echo $d['liq_concepto'];?></td>
                        <td><?php echo $d['liq_total'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        <td><?php echo $d['estado'];?></td>
                        </tr>		
                    <?php }?>
	</tbody>
</table>
