<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_ajuste;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Agregar&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_pedido" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Nro</th>
			<th>Sucursal</th>
			<th>Fecha</th>
                        <th>Motivo</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['ajus_cod'];?></td>
			<td><?php echo $d['suc_nombre'];?></td>
                        <td><?php echo $d['fecha'];?></td>
			<td><?php echo $d['mot_descri'];?></td>
			<td><?php echo $d['estado'];?></td>
			<td>
                            <?php if($d['estado']=='PENDIENTE'){ ?>
                            <button title="Confirmar" type="button" class="btn btn-success" onclick="confirmar(<?php echo $d['ajus_cod']; ?>)">
                                <i class="fas fa-check"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="anular_cabecera(<?php echo $d['ajus_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['ajus_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <?php }else{ ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['ajus_cod'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                            <?php } ?>
                            
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>