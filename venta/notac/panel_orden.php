<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_venta_credito;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>COD</th>
                        <th>N° Nota</th>
                        <th>N° Timbrado</th>
			<th>TIPO</th>
			<th>FECHA</th>
			<th>MOTIVO</th>
			<th>SUCURSAL</th>
			<th>CON FACTURA</th>
                        <th>CLIENTE</th>
                        <th>ESTADO</th>
                        <th>FUNCIONARIO</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['cred_cod'];?></td>
                        <td><?php echo $d['cred_conca']." ".$d['cred_nro'];?></td>
                        <td><?php echo $d['ntim_nro'];?></td>
			<td><?php echo $d['tip_descri'];?></td>
			<td><?php echo $d['fecha'];?></td>
			<td><?php echo $d['mot_descri'];?></td>
			<td><?php echo $d['suc_nombre'];?></td>
			<td><?php echo $d['con_fac'];?></td>
			<td><?php echo $d['cliente'];?></td>
                        <td><?php echo $d['estado'];?></td>
                        <td><?php echo $d['auditoria2'];?></td>
			
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
                            <?php if($d['estado']=='CONFIRMADO'){ ?>
                                <button title="imprimir" type="submit" class="btn btn-outline-warning" onclick="imprimir(<?php echo $d['cred_cod'];?>)">PRINT
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>