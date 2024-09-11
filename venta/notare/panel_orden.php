<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_venta_remision;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>COD</th>
                        <th>N° Remision</th>
                        <th>N° Timbrado</th>
			<th>Fecha</th>
			<th>Motivo</th>
                        <th>Vehiculo</th>
                        <th>Chofer</th>
                        <th>Funcionario</th>
                        <th>Con Factura</th>
                        <th>Sucursal</th>
                        <th>Cliente</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['rem_cod'];?></td>
                        <td><?php echo $d['rem_conca']."-".$d['rem_nro'];?></td>
                        <td><?php echo $d['rtim_nro'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['rem_motivo'];?></td>
                        <td><?php echo $d['vehi_cod']."-".$d['vehi_chapa'];?></td>
                        <td><?php echo $d['chofer'];?></td>
                        <td><?php echo $d['auditoria2'];?></td>
                        <td><?php echo $d['con_fac'];?></td>
                        <td><?php echo $d['suc_salida'];?></td>
                        <td><?php echo $d['cliente'];?></td>
                        <td><?php echo $d['estado'];?></td>
			<td>
                            <?php if($d['estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="grabar_confirmar(<?php echo $d['rem_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['rem_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['rem_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['rem_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <?php } ?>
                            <?php if($d['estado']=='CONFIRMADO'){ ?>
                                <button title="imprimir" type="submit" class="btn btn-outline-warning" onclick="imprimir(<?php echo $d['rem_cod'];?>)">PRINT
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>