<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_entrega_cheq;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Concepto</th>
			<th>Fecha de Entrega</th>
                        <th>Proveedor</th>
                        <th>Sucursal</th>
                        <th>Cod. Cheque</th>
                        <th>Nro Cuenta Cheque</th>
                        <th>Funcionario</th>
                        <th>Estado</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['en_che_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['en_che_cod'];?>" href="#detalle<?php echo $d['en_che_cod'];?>">
                                    <?php echo $d['en_che_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['en_che_concepto'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['proveedor'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['che_cod'];?></td>
                        <td><?php echo $d['che_nrocuenta'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        <td><?php echo $d['estado'];?></td>
                    </tr>		
                    <?php }?>
	</tbody>
</table>
