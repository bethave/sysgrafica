<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_otrosdc;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Nro</th>
			<th>SUCURSAL</th>
                        <th>FECHA</th>
			<th>NUMERO DE COMPROBANTE</th>
                        <th>TIPO</th>
                        <TH>MOTIVO</TH>
                        <TH>ESTADO</TH>
                        <th>CUENTA BANCARIA</th>
                        <th>FUNCIONARIO</th>
                        <TH>CON BANCO</TH>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['otr_cod'];?></td>
			<td><?php echo $d['suc_nombre'];?></td>
			<td><?php echo $d['fecha'];?></td>
			<td><?php echo $d['otr_nro'];?></td>
			<td><?php echo $d['otr_tipo'];?></td>
                        <td><?php echo $d['otr_motivo'];?></td>
                        <td><?php echo $d['otr_estado'];?></td>
			<td><?php echo $d['cuen_bank']." - Cuenta NRO ".$d['cuen_nro'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
			<td><?php echo $d['con_ban'];?></td>
			<td>
                            <?php if($d['otr_estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="grabar_confirmar(<?php echo $d['otr_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['otr_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['otr_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['otr_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>