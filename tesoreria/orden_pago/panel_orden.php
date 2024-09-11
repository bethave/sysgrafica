<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_torden_pago;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Nro</th>
			<th>Funcionario</th>
			<th>Fecha</th>
			<th>Sucursal</th>
			<th>Proveedor</th>
                        <th>Forma de Pago</th>
                        <th>Banco</th>
                        <th>Carga Observación</th>
                        <th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['pag_cod'];?></td>
			<td><?php echo $d['auditoria'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
			<td><?php echo $d['proveedor'];?></td>
			<td><?php echo $d['pag_formapag'];?></td>
			<td><?php echo $d['ban_descri'];?></td>
                        <td><?php echo $d['pag_obs'];?></td>
			<td><?php echo $d['pag_estado'];?></td>
			<td>
                            <?php if($d['pag_estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="grabar_confirmar(<?php echo $d['pag_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['pag_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['pag_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['pag_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>