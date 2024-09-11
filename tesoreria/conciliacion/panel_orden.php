<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_conciliacion;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
			<th>Estado</th>
			<th>Boleta de Depósito</th>
			<th>Cuenta Bancaria</th>
			<th>Chequera</th>
                        <th>Liquidación con Tarjeta</th>
                        <th>Otros Créditos/Débitos</th>
                        <th>Sucursal</th>
                        <th>Funcionario</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['con_cod'];?></td>
			<td><?php echo $d['fecha'];?></td>
			<td><?php echo $d['con_estado'];?></td>
			<td><?php echo $d['bdep_cod']." - Importe ".$d['bdep_importe'];?></td>
			<td><?php echo "Código: ".$d['cuen_bank']." - N° Cuenta: ".$d['cuen_nro'];?></td>
			<td><?php echo $d['che_cod']." - N° Cuenta ".$d['che_nrocuenta'];?></td>
			<td><?php echo $d['liq_cod']." - N° ".$d['liq_nro']." - Concepto ".$d['liq_concepto'];?></td>
                        <td><?php echo $d['otr_cod']." - Tipo ".$d['otr_tipo']." - Motivo ".$d['otr_motivo'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
			
			<td>
                            <?php if($d['con_estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="grabar_confirmar(<?php echo $d['con_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['con_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="imprimir" type="submit" class="btn btn-outline-warning" onclick="imprimir(<?php echo $d['con_cod'];?>)">PRINT
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>