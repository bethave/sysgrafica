<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_factura_compra;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Código</th>
                        <th>N° de Factura</th>
			<th>Tipo de Factura</th>
			<th>Estado</th>
			<th>Cuotas</th>
                        <th>Nro Timbrado</th>
                        <th>Fecha Inicio Timbrado</th>
                        <th>Fecha fin Timbrado</th>
			<th>Sucursal</th>
                        <th>Proveedor</th>
                        <th>Funcionario</th>
                        <th>Intervalo</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['fac_cod'];?></td>
			<td><?php echo $d['fac_nro'];?></td>
			<td><?php echo $d['tip_descri'];?></td>
			<td><?php echo $d['fac_estado'];?></td>
                        <td><?php echo $d['fac_cuotas'];?></td>
                        <td><?php echo $d['fac_timnro'];?></td>
                        <td><?php echo $d['fac_inicio'];?></td>
                        <td><?php echo $d['fac_vto'];?></td>
			<td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['proveedor'];?></td>
                        <td><?php echo $_SESSION['usu_nombre'];?></td>
                        <td><?php echo $d['intervalo'];?></td>
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