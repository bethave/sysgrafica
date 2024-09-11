<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_ncd_compra;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Nro</th>
			<th>TIPO</th>
			<th>FECHA</th>
			<th>MOTIVO</th>
                        <th>N° DE NOTA</th>
			<th>NRO TIMBRADO</th>
                        <th>VTO TIMBRADO</th>
			<th>SUCURSAL</th>
                        <th>FUNCIONARIO</th>
			<th>CON FACTURA?</th>
                        <th>PROVEEDOR</th>
                        <th>ESTADO</th>
                        <th>PORCENTAJE DE DESCUENTO</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['cred_cod'];?></td>
			<td><?php echo $d['cred_tipo'];?></td>
			<td><?php echo $d['fecha'];?></td>
			<td><?php echo $d['cred_motivo'];?></td>
                        <td><?php echo $d['cred_nro'];?></td>
			<td><?php echo $d['cred_timnro'];?></td>
                        <td><?php echo $d['cred_timvto'];?></td>
			<td><?php echo $_SESSION['suc_nombre'];?></td>
			<td><?php echo $_SESSION['per_nombre'];?></td>
			<td><?php echo $d['con_fac'];?></td>
                        <td><?php echo $d['proveedor'];?></td>
                        <td><?php echo $d['estado'];?></td>
                        <td><?php echo $d['porcentaje'];?></td>
			
			<td>
                            <?php if($d['estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="grabar_confirmar(<?php echo $d['cred_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['cred_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['cred_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['cred_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>