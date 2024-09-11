<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_venta_factura;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>COD</th>
			<th>Fecha</th>
			<th>Tipo</th>
                        <th>N° Factura</th>
                        <th>Intervalo</th>
			<th>Estado</th>
                        <th>Cuotas</th>
                        <th>Timbrado</th>
                        <th>Sucursal</th>
                        <th>Cliente</th>
                        <th>Funcionario</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['fac_cod'];?></td>
			<td><?php echo $d['fecha'];?></td>
			<td><?php echo $d['fac_tipo'];?></td>
                        <td><?php echo $d['fac_conca']." ".$d['fac_nro'];?></td>
                        <td><?php echo $d['fac_intervalo'];?></td>
			<td><?php echo $d['fac_estado'];?></td>
                        <td><?php echo $d['fac_cuotas'];?></td>
                        <td><?php echo $d['tim_nro'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['cliente'];?></td>
                        <td><?php echo $d['auditoria2'];?></td>
			<td>
                            <?php if($d['fac_estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="grabar_confirmar(<?php echo $d['fac_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['fac_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['fac_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['fac_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <?php } ?>
                           
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>