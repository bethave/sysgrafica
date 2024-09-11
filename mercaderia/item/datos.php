<?php
	include "../../conexion.php";
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_items;");
 	$datos = pg_fetch_all($resultado);
?>
<table id="tabla_cargos" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
                        <th>Marca</th>
                        <th>Tipo Impuesto</th>
                        <th>Tipo Item</th>
                        <th>Descripción</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Unidad Medida</th>
                        <th>Procedencia</th>
			<th>Estado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td>
                            <div id="accordion<?php echo $d['id_item'];?>">
                                <a class="btn btn-info" data-toggle="collapse" data-parent="#accordion<?php echo $d['id_item'];?>" href="#detalle<?php echo $d['id_item'];?>">
                                    <?php echo $d['id_item'];?>
                                </a>
                               
                            </div>
                        </td>
                        <td><?php echo $d['mar_descrip'];?>
                        <td><?php echo $d['ti_descrip'];?>
                        <td><?php echo $d['tpi_descrip'];?>
                        <td><?php echo $d['item_descrip'];?>
                        <td><?php echo $d['precio_compra'];?>
                        <td><?php echo $d['precio_venta'];?>
                        <td><?php echo $d['um_descri'];?>
                        <td><?php echo $d['proce_descri'];?>
			<td><?php echo $d['estado'];?></td>
			<td>
                            <?php if($d['estado']=='ACTIVO'){ ?>
                            <button title="Editar" type="button" class="btn btn-warning" onclick="editar(<?php echo $d['id_item'];?>,<?php echo $d['id_mar'];?>,<?php echo $d['id_tpi'];?>,<?php echo $d['id_ti'];?>,'<?php echo $d['item_descrip'];?>',<?php echo $d['precio_compra'];?>,<?php echo $d['precio_venta'];?>,<?php echo $d['um_id'];?>,<?php echo $d['proce_id'];?>,'<?php echo $d['itm_imagen'];?>')">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button title="Anular" type="button" class="btn btn-danger" onclick="inactivar(<?php echo $d['id_item'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <?php } ?>
                            <button title="Detalles" type="button" class="btn btn-info" onclick="detalles(<?php echo $d['id_item'];?>)">
                                <i class="fas fa-list"></i>
                            </button>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>