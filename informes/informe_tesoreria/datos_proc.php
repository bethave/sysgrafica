<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM repor_proceso;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
			<th>Sucursal</th>
                        <th>Cod. Cuenta Bancaria</th>
                        <th>Cuenta Bancaria NRO</th>
                        <th>Funcionario</th>
                        <th>Con Cheque</th>
                        <th>Con Orden</th>
                        <th>Estado</th>
                        <th>Chequera</th>
                        <th>Orden de Pago</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['proc_id'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['proc_id'];?>" href="#detalle<?php echo $d['proc_id'];?>">
                                    <?php echo $d['proc_id'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['cuen_bank'];?></td>
                        <td><?php echo $d['cuen_nro'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        <td><?php echo $d['con_cheque'];?></td>
                        <td><?php echo $d['con_orden'];?></td>
                        <td><?php echo $d['estado'];?></td>
                        <td><?php echo "Cod: ".$d['che_cod']." - Cuenta Nro: ".$d['che_nrocuenta'];?></td>
                        <td><?php echo "Cod: ".$d['pag_cod']." - Forma de Pago: ".$d['pag_formapag'];?></td>
                    </tr>		
                    <?php }?>
	</tbody>
</table>
