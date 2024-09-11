<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_transferencia;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>CÓDIGO</th>
			<th>SUCURSAL</th>
			<th>FECHA</th>
			<th>ESTADO</th>
			<th>TITULAR</th>
			<th>CUENTA BANCARIA - TITULAR</th>
			<th>BENEFICIARIO</th>
                        <TH>CUENTA BANCARIA - BENEFICIARIO</TH>
                        <TH>CONCEPTO</TH>
                        <TH>IMPORTE</TH>
                        <th>CUENTA BANCARIA</th>
                        <TH>FUNCIONARIO</TH>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['tb_cod'];?></td>
			<td><?php echo $d['id_suc'];?>-<?php echo $d['suc_nombre'];?></td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['tb_estado'];?></td>
			<td><?php echo $d['tb_titular'];?></td>
			<td><?php echo $d['tb_cta_titular'];?></td>
			<td><?php echo $d['tb_beneficiario'];?></td>
			<td><?php echo $d['tb_cta_beneficiario'];?></td>
                        <td><?php echo $d['tb_concepto'];?></td>
                        <td><?php echo $d['tb_importe'];?></td>
                        <td><?php echo $d['cuen_bank'];?></td>
                        <td><?php echo $d['auditoria'];?></td>		
			<td>
                            <?php if($d['tb_estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="grabar_confirmar(<?php echo $d['tb_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['tb_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="imprimir" type="submit" class="btn btn-outline-warning" onclick="imprimir(<?php echo $d['tb_cod'];?>)">PRINT
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>