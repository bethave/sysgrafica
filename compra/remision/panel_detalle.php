<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_oc = $_POST['id_oc'];
	$conexion = conexion::conectar();
	$cabecera = pg_query($conexion, "SELECT * FROM v_remision_compra WHERE rem_cod = $id_oc;");
        $cab = pg_fetch_all($cabecera);
	$detalles = pg_query($conexion, "SELECT * FROM v_compra_remision_detalle WHERE rem_cod = $id_oc;");
 	$det = pg_fetch_all($detalles);
	$items = pg_query($conexion, "SELECT * FROM items WHERE id_item NOT IN (SELECT id_item FROM compra_remision_detalle WHERE rem_cod = $id_oc);");
 	$ite = pg_fetch_all($items);
	$pedidos = pg_query($conexion, "SELECT * FROM v_factura_compra ;");
 	$ped = pg_fetch_all($pedidos);
        $pedidos_detalles = pg_query($conexion, "SELECT * FROM v_factura_compra_detalle WHERE fac_cod IN (SELECT fac_cod FROM factura_compra);");
 	$ped_det = pg_fetch_all($pedidos_detalles);
        $ped_det2 = null;
        foreach($ped_det as $pd){
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['fac_cod'] = $pd['fac_cod'];
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['id_item'] = $pd['id_item'];
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['item_descrip'] = $pd['item_descrip'];
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['det_precio'] = $pd['det_precio'];
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['iva'] = $pd['iva'];
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['cantidad'] = $pd['cantidad'];
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['monto'] = $pd['monto'];
        }
?>
<div class="row">
    <div class="card">
        <div class="card-header p-0">
            <b>DATOS DE LA CABECERA</b>
        </div>
        <div class="card-body">
            <input type="hidden" id="id_oc_detalle" value="<?php echo $cab[0]['rem_cod'];?>">
            <b>Nro: </b><?php echo $cab[0]['rem_cod'];?><br>
            <b>Sucursal Salida: </b><?php echo $cab[0]['salida'];?><br>
            <b>Sucursal Destino: </b><?php echo $cab[0]['llegada'];?><br>
            <b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
            <b>Proveedor: </b><?php echo $cab[0]['proveedor'];?><br>
            <b>Con Factura: </b><?php echo $cab[0]['con_factura'];?><br>
            <b>Estado: </b><?php echo $cab[0]['estado'];?><br>
        </div>
    </div>
</div>
<?php if($cab[0]['con_factura'] == 'SI'){ ?>
<div class="row">
    <div class="card col-sm-12">
        <div class="card-header p-0">
            <b>SELECCIONE LAS FACTURAS</b>
        </div>
        <div class="card-body">
            <?php if(empty($ped)){?>
            <label style="color:red">NO HAY FACTURAS DISPONIBLES</label>
            <?php }else{?>
                <?php foreach($ped as $p){?>
                    <div class="row" id="contenedor<?php echo $p['fac_cod'];?>">
                        <div class="card">
                            <div class="card-header">
                                <input type="checkbox" style="width: 25px; height: 25px;" class="check_pedido" value="<?php echo $p['fac_cod'];?>">&nbsp;&nbsp;
                                <b>Nro Factura: </b><?php echo $p['fac_cod'];?>&nbsp;&nbsp;
                                <b>Sucursal:</b><?php echo $p['suc_nombre'];?>&nbsp;&nbsp;
                                <b>Fecha:</b><?php echo $p['fecha'];?>&nbsp;&nbsp;
                                <a class="btn btn-info" data-toggle="collapse" data-parent="#contenedor<?php echo $p['fac_cod'];?>" href="#pedido<?php echo $p['fac_cod'];?>">
                                    Ver Detalles
                                </a>
                            </div>
                            <div class="card-body panel-collapse collapse in" id="pedido<?php echo $p['fac_cod'];?>">
                                <?php foreach ($ped_det2 as $p2){?>
                                    <b>Item: </b><?php echo $ped_det2[$p['fac_cod']][$pd['id_item']]['item_descrip'];?><br>
                                    <b>Precio: </b><?php echo $ped_det2[$p['fac_cod']][$pd['id_item']]['det_precio'];?><br>
                                    <b>IVA: </b><?php echo $ped_det2[$p['fac_cod']][$pd['id_item']]['iva'];?><br>
                                    <b>Cantidad: </b><?php echo $ped_det2[$p['fac_cod']][$pd['id_item']]['cantidad'];?><br>
                                    <b>Monto: </b><?php echo $ped_det2[$p['fac_cod']][$pd['id_item']]['monto'];?><br>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
        </div>
<?php } ?>
<div class="row">
    <button type="button" class="btn btn-primary" onclick="grabar_pedidos(<?php echo $cab[0]['rem_cod'];?>);">GRABAR REMISION</button>
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
                
                <button type="button" class="btn btn-block btn-success col-sm-4" onclick="agregar_detalle(<?php echo $cab[0]['rem_cod'];?>);">
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
                        <th>Cod. Item</th>
                        <th>Item</th>
			<th>Cantidad</th>
                        <th>Monto</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($det as $d){?>
                    <tr>
			<td><?php echo $d['id_item'];?></td>
                        <td><?php echo $d['item_descrip'];?></td>
			<td><?php echo $d['cantidad'];?></td>
			<td><?php echo $d['monto'];?></td>
			<td>
                            <button title="Editar" type="button" class="btn btn-warning" onclick="editar_detalle(<?php echo $d['rem_cod'];?>,<?php echo $d['id_item'];?>,<?php echo $d['cantidad'];?>)">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button title="Eliminar" type="button" class="btn btn-danger" onclick="eliminar_detalle(<?php echo $d['rem_cod'];?>,<?php echo $d['id_item'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>
<?php }?>
</div>