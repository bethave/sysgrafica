<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_bdep;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>NRO</th>
			<th>Fecha</th>
                        <th>Sucursal</th>
                        <th>Tipo de Documento</th>
                        <th>Tipo de Operación</th>
                        <th>Estado</th>
                        <th>Chequera</th>
                        <th>Importe</th>
                        <th>Cuenta Bancaria</th>
                        <th>Funcionario</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['bdep_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['bdep_cod'];?>" href="#detalle<?php echo $d['bdep_cod'];?>">
                                    <?php echo $d['bdep_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['bdep_nro'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo "Cod: ".$d['tip_cod']." - Descripcion: ".$d['tip_descri'];?></td>
                        <td><?php echo $d['bdep_tipoope'];?></td>
                        <td><?php echo $d['bdep_estado'];?></td>
                        <td><?php echo "Cod: ".$d['che_cod']." - Nro Cuenta: ".$d['che_nrocuenta'];?></td>
                        <td><?php echo $d['bdep_importe'];?></td>
                        <td><?php echo "Cod: ".$d['cuen_bank']." - NRO: ".$d['cuen_nro'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        </tr>		
                    <?php }?>
	</tbody>
</table>
