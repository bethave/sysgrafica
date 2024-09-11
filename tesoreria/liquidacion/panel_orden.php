<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_liqtar;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>CODIGO</th>
			<th>NUMERO</th>
			<th>FECHA</th>
			<th>DESCRIPCION</th>
			<th>SUCURSAL</th>
			<th>ENTIDAD</th>
			<th>N° CUENTA BANCARIA</th>
                        <th>CONCEPTO</th>
                        <TH>TOTAL</TH>
                        <TH>FUNCIONARIO</TH>
                        <TH>ESTADO</TH>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['liq_cod'];?></td>
                        <td><?php echo $d['liq_nro'];?></td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['liq_descri'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['ent_cod']." - Entidad: ".$d['ent_cod'];?></td>
                        <td><?php echo $d['cuen_bank']." - N° Cuenta: ".$d['cuen_nro'];?></td>
                        <td><?php echo $d['liq_concepto'];?></td>
                        <td><?php echo $d['liq_total'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        <td><?php echo $d['estado'];?></td>
			
			<td>
                            <?php if($d['estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="grabar_confirmar(<?php echo $d['liq_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['liq_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="imprimir" type="submit" class="btn btn-outline-warning" onclick="imprimir(<?php echo $d['liq_cod'];?>)">PRINT
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>