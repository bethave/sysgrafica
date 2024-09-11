<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_reposicion;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Nro</th>
			<th>SUCURSAL</th>
			<th>FECHA</th>
			<th>ASIGNACIÓN N°</th>
			<th>MONTO DE REPOSICIÓN</th>
			<th>FUNCIONARIO</th>
                        <TH>ESTADO</TH>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['rep_cod'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
			<td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['asig_cod']." - Motivo ".$d['asig_motivo'];?></td>
                        <td><?php echo $d['rep_monto'];?></td>
                        <td><?php echo $d['auditoria'];?></td>
                        <td><?php echo $d['estado'];?></td>
			<td>
                            <?php if($d['estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="grabar_confirmar(<?php echo $d['rep_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['rep_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="imprimir" type="submit" class="btn btn-outline-warning" onclick="imprimir(<?php echo $d['rep_cod'];?>)">PRINT
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>