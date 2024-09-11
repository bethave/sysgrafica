<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_conciliacion;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
			<th>Estado</th>
                        <th>Boleta de Deposito</th>
                        <th>Cuenta Bancaria</th>
                        <th>Chequera</th>
                        <th>Liquidación</th>
                        <th>Otros Deb/Cred</th>
                        <th>Sucursal</th>
                        <th>Funcionario</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['con_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['con_cod'];?>" href="#detalle<?php echo $d['con_cod'];?>">
                                    <?php echo $d['con_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['con_estado'];?></td>
                        <td><?php echo "Cod: ".$d['bdep_cod']." - Importe: ".$d['bdep_importe'];?></td>
                        <td><?php echo "Cod: ".$d['cuen_bank']." - Nro: ".$d['cuen_nro'];?></td>
                        <td><?php echo "Cod: ".$d['che_cod']." - Cuenta: ".$d['che_nrocuenta'];?></td>
                        <td><?php echo "Cod: ".$d['liq_cod']." - Nro: ".$d['liq_nro']." - Concepto: ".$d['liq_concepto'];?></td>
                        <td><?php echo "Cod: ".$d['otr_cod']." - Tipo: ".$d['otr_tipo']." - Motivo: ".$d['otr_motivo'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        </tr>		
                    <?php }?>
	</tbody>
</table>
