<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_cierre;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
CERRAR&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Código</th>
			<th>Fecha Cierre</th>
			<th>Hora Cierre</th>
			<th>Estado</th>
			<th>Total Efectivo</th>
                        <th>Total Cheque</th>
                        <th>Total Tarjeta</th>
                        <th>Monto Total</th>
                        <th>Faltante</th>
                        <th>Sobrante</th>
                        <th>Sucursal</th>
                        <th>Caja</th>
                        <th>Apertura</th>
                        <th>Cajero</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['cie_cod'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['hora'];?></td>
                        <td><?php echo $d['cie_estado'];?></td>
			<td><?php echo $d['cie_totalefectivo'];?></td>
			<td><?php echo $d['cie_totalcheque'];?></td>
                        <td><?php echo $d['cie_totaltarjeta'];?></td>
                        <td><?php echo $d['cie_montototal'];?></td>
                        <td><?php echo $d['cie_faltante'];?></td>
			<td><?php echo $d['cie_sobrante'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['caja_id']." - ".$d['c_estado']." - ".$d['caja_descri'];?></td>
                        <td><?php echo $d['aper_cod']." - ".$d['estado']." - ".$d['aper_minicial'];?></td>
                        <td><?php echo $d['auditoria2'];?></td>
			<td>
                             <?php if($d['cie_estado']=='CERRADO'){ ?>
                                <button title="imprimir" type="submit" class="btn btn-outline-warning" onclick="imprimir(<?php echo $d['cie_cod'];?>)">PRINT
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>