<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_asignacion;");
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
			<th>Sucursal</th>
			<th>Caja</th>
                        <th>Estado</th>
                        <th>Motivo</th>
			<th>Monto a Asignar</th>
                        <th>Funcionario</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['asig_cod'];?></td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['caja_id']." - ".$d['caja_descri']." - ".$d['c_estado'];?></td>
                        <td><?php echo $d['asig_estado'];?></td>
                        <td><?php echo $d['asig_motivo'];?></td>
                        <td><?php echo $d['asig_monto'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        
			<td>
                            <?php if($d['asig_estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="grabar_confirmar(<?php echo $d['asig_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['asig_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['asig_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="imprimir" type="submit" class="btn btn-outline-warning" onclick="imprimir(<?php echo $d['asig_cod'];?>)">PRINT
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>