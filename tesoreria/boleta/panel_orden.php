<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_bdep;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>CÓDIGO</th>
			<th>NRO</th>
			<th>FECHA</th>
			<th>SUCURSAL</th>
			<th>TIPO DOCUMENTO</th>
			<th>TIPO DE OPERACION</th>
                        <th>ESTADO</th>
                        <TH>CHEQUERA N°</TH>
                        <TH>IMPORTE</TH>
                        <TH>CUENTA BANCARIA</TH>
                        <TH>FUNCIONARIO</TH>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['bdep_cod'];?></td>
                        <td><?php echo $d['bdep_nro'];?></td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['tip_cod']." - Tipo ".$d['tip_descri'];?></td>
                        <td><?php echo $d['bdep_tipoope'];?></td>
                        <td><?php echo $d['bdep_estado'];?></td>
                        <td><?php echo $d['che_cod']." - NRO ".$d['che_nrocuenta'];?></td>
                        <td><?php echo $d['bdep_importe'];?></td>
                        <td><?php echo $d['cuen_bank']." - Cuenta NRO ".$d['cuen_nro'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        
			<td>
                            <?php if($d['bdep_estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="grabar_confirmar(<?php echo $d['bdep_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['bdep_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['bdep_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="imprimir" type="submit" class="btn btn-outline-warning" onclick="imprimir(<?php echo $d['bdep_cod'];?>)">PRINT
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>