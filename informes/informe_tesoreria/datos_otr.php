<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM repor_otrdc;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Sucursal</th>
                        <th>Fecha</th>
                        <th>Nro</th>
                        <th>Tipo</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                        <th>Cuenta Bancaria</th>
                        <th>Funcionario</th>
                        <th>Con Banco?</th>
                        <th>Datos - Banco</th>
                        <th>Cuenta Nro</th>
                        <th>Monto</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['otr_cod'];?>">
                                <a class="btn btn-warning" data-toggle="collapse" data-parent="#accordion<?php echo $d['otr_cod'];?>" href="#detalle<?php echo $d['otr_cod'];?>">
                                    <?php echo $d['otr_cod'];?>
                                </a>
                               
                            </div>
                        </td>}
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['otr_nro'];?></td><!-- comment -->
                        <td><?php echo $d['otr_tipo'];?></td>
                        <td><?php echo $d['otr_motivo'];?></td>
                        <td><?php echo $d['otr_estado'];?></td>
                        <td><?php echo "Cod: ".$d['cuen_bank']." - Nro: ".$d['cuen_nro'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        <td><?php echo $d['con_ban'];?></td>
                        <td><?php echo "Cod: ".$d['ban_cod']." - Descripcion: ".$d['ban_descri'];?></td>
                        <td><?php echo $d['dodc_cuenta'];?></td>
                        <td><?php echo $d['dodc_monto'];?></td>
                        </tr>		
                    <?php }?>
	</tbody>
</table>
