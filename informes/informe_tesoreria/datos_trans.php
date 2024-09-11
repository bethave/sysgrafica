<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM repor_transf;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Sucursal</th>
			<th>Fecha</th>
                        <th>Estado</th>
                        <th>Titular</th>
                        <th>Cuenta del Titular</th>
                        <th>Beneficiario</th>
                        <th>Cuenta del Beneficiario</th>
                        <th>Concepto</th>
                        <th>Importe</th>
                        <th>Cuenta Bancaria</th>
                        <th>Funcionario</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['tb_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['tb_cod'];?>" href="#detalle<?php echo $d['tb_cod'];?>">
                                    <?php echo $d['tb_cod'];?>
                                </a>
                               
                            </div>
                        </td>
			<td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['tb_estado'];?></td>
                        <td><?php echo $d['tb_titular'];?></td>
                        <td><?php echo $d['tb_cta_titular'];?></td>
                        <td><?php echo $d['tb_beneficiario'];?></td>
                        <td><?php echo $d['tb_cta_beneficiario'];?></td>
                        <td><?php echo $d['tb_concepto'];?></td>
                        <td><?php echo $d['tb_importe'];?></td>
                        <td><?php echo "Cod: ".$d['cuen_bank']." - NRO: ".$d['cuen_nro'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        </tr>		
                    <?php }?>
	</tbody>
</table>
