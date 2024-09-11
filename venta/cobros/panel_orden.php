<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_cobros;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Nro</th>
			<th>Fecha</th>
                        <th>Hora</th>
                        <th>Apertura De Caja</th>
                        <th>Cliente</th>
                        <th>Funcionario</th>
                        <th>Sucursal</th>
                        <th>Con Cuenta Cobrar</th>
                        <th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['cobro_cod'];?></td>
			<td><?php echo $d['fecha'];?></td>
			<td><?php echo $d['hora'];?></td>
			<td><?php echo "COD: ".$d['aper_cod']." - Caja: ".$d['caja_id']." - Estado: ".$d['estado'];?></td>
                        <td><?php echo $d['cliente'];?></td>
                        <td><?php echo $d['auditoria2'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['con_factura'];?></td>
                        <td><?php echo $d['cobro_estado'];?></td>
			<td>
                            <?php if($d['cobro_estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="grabar_confirmar(<?php echo $d['cobro_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['cobro_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['cobro_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['cobro_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <?php } ?>
                            <?php if($d['cobro_estado']=='CONFIRMADO'){ ?>
                                <button title="imprimir" type="submit" class="btn btn-outline-warning" onclick="imprimir(<?php echo $d['cobro_cod'];?>)">PRINT
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>