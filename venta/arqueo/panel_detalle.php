<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_oc = $_POST['id_oc'];
	$conexion = conexion::conectar();
	$cabecera = pg_query($conexion, "SELECT * FROM v_compra_orden WHERE id_co = $id_oc;");
        $cab = pg_fetch_all($cabecera);
	$detalles = pg_query($conexion, "SELECT * FROM v_compra_orden_detalle WHERE id_co = $id_oc;");
 	$det = pg_fetch_all($detalles);
	$items = pg_query($conexion, "SELECT * FROM items WHERE id_item NOT IN (SELECT id_item FROM compra_orden_detalle WHERE id_co = $id_oc);");
 	$ite = pg_fetch_all($items);
	$pedidos = pg_query($conexion, "SELECT * FROM v_compra_pedido WHERE estado = 'CONFIRMADO';");
 	$ped = pg_fetch_all($pedidos);
        $pedidos_detalles = pg_query($conexion, "SELECT * FROM v_compra_pedido_detalle WHERE id_ped IN (SELECT id_ped FROM compra_pedido WHERE estado = 'CONFIRMADO');");
 	$ped_det = pg_fetch_all($pedidos_detalles);
        $ped_det2 = null;
        foreach($ped_det as $pd){
            $ped_det2[$pd['id_ped']][$pd['id_item']]['id_ped'] = $pd['id_ped'];
            $ped_det2[$pd['id_ped']][$pd['id_item']]['id_item'] = $pd['id_item'];
            $ped_det2[$pd['id_ped']][$pd['id_item']]['item_descrip'] = $pd['item_descrip'];
            $ped_det2[$pd['id_ped']][$pd['id_item']]['precio'] = $pd['precio'];
            $ped_det2[$pd['id_ped']][$pd['id_item']]['cantidad'] = $pd['cantidad'];
            $ped_det2[$pd['id_ped']][$pd['id_item']]['iva'] = $pd['iva'];
        }
?>
<div class="row">
    <div class="card">
        <div class="card-header p-0">
            <b>DATOS DE LA CABECERA</b>
        </div>
        <div class="card-body">
            <input type="hidden" id="id_oc_detalle" value="<?php echo $cab[0]['id_co'];?>">
            <b>Nro: </b><?php echo $cab[0]['id_co'];?><br>
            <b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
            <b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
            <b>Proveedor: </b><?php echo $cab[0]['per_nombre']." ".$cab[0]['per_apellido']." (".$cab[0]['per_ruc'].")";?><br>
            <b>Con Pedido: </b><?php echo $cab[0]['con_pedido'];?><br>
            <b>Estado: </b><?php echo $cab[0]['estado'];?><br>
        </div>
    </div>
</div>
<?php if($cab[0]['con_pedido'] == 'SI'){ ?>
<div class="row">
    <div class="card col-sm-12">
        <div class="card-header p-0">
            <b>SELECCIONE LOS PEDIDOS</b>
        </div>
        <div class="card-body">
            <?php if(empty($ped)){?>
            <label style="color:red">NO HAY PEDIDOS DISPONIBLES</label>
            <?php }else{?>
                <?php foreach($ped as $p){?>
                    <div class="row" id="contenedor<?php echo $p['id_ped'];?>">
                        <div class="card">
                            <div class="card-header">
                                <input type="checkbox" style="width: 25px; height: 25px;" class="check_pedido" value="<?php echo $p['id_ped'];?>">&nbsp;&nbsp;
                                <b>Nro Pedido: </b><?php echo $p['id_ped'];?>&nbsp;&nbsp;
                                <b>Sucursal:</b><?php echo $p['suc_nombre'];?>&nbsp;&nbsp;
                                <b>Fecha:</b><?php echo $p['fecha'];?>&nbsp;&nbsp;
                                <a class="btn btn-info" data-toggle="collapse" data-parent="#contenedor<?php echo $p['id_ped'];?>" href="#pedido<?php echo $p['id_ped'];?>">
                                    Ver Detalles
                                </a>
                            </div>
                            <div class="card-body panel-collapse collapse in" id="pedido<?php echo $p['id_ped'];?>">
                                <?php foreach ($ped_det2 as $p2){?>
                                    <b>Item: </b><?php echo $ped_det2[$p['id_ped']]['item_descrip'];?><br>
                                    <b>Precio: </b><?php echo $ped_det2[$p['id_ped']]['precio'];?><br>
                                    <b>Cantidad: </b><?php echo $ped_det2[$p['id_ped']]['cantidad'];?><br>
                                    <b>Iva: </b><?php echo $ped_det2[$p['id_ped']]['iva'];?><br>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
        </div>
<?php } ?>
<div class="row">
    <button type="button" class="btn btn-primary" onclick="grabar_pedidos(<?php echo $cab[0]['id_co'];?>);">GRABAR PEDIDOS</button>
</div>
<div class="row">
    <div class="card col-sm-12">
        <div class="card-header p-0">
            <b>AGREGAR DETALLE</b>
        </div>
        <div class="card-body">
            <?php if(empty($ite)){ ?>
                <label style="color: red">YA NO HAY ITEMS DISPONIBLES PARA AÑADIR</label>
            <?php }else{ ?>
                <b>SELECCIONE EL ITEM</b><br>
                <select id="id_item_detalle" class="form-control col-sm-6 select2">
                    <?php foreach($ite as $i){ ?>
                    <option value="<?php echo $i['id_item'];?>"><?php echo $i['item_descrip'];?></option>
                    <?php } ?>
                </select><br>
                <b>INGRESE LA CANTIDAD</b>
                <input type="number" class="form-control col-sm-6" id="cantidad_detalle"><br>
                
                <button type="button" class="btn btn-block btn-success col-sm-4" onclick="agregar_detalle(<?php echo $cab[0]['id_co'];?>);">
                    Agregar Detalle<i class="fas fa-plus"></i>
                </button>
            <?php } ?>
        </div>
    </div>
</div>
<div class="row">
<?php if (empty($det)) { ?>
<label style="color: red">NO SE ENCUENTRAN DETALLES PARA ESTE PEDIDO</label>
<?php }else{ ?>
<table id="tabla_panel_pedido" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Item</th>
			<th>Cantidad</th>
			<th>Precio</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($det as $d){?>
                    <tr>
			<td><?php echo $d['item_descrip'];?></td>
			<td><?php echo $d['cantidad'];?></td>
			<td><?php echo $d['precio'];?></td>
			<td>
                            <button title="Editar" type="button" class="btn btn-warning" onclick="editar_detalle(<?php echo $d['id_co'];?>,<?php echo $d['id_item'];?>,<?php echo $d['cantidad'];?>)">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button title="Eliminar" type="button" class="btn btn-danger" onclick="eliminar_detalle(<?php echo $d['id_co'];?>,<?php echo $d['id_item'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>
<?php }?>
</div>