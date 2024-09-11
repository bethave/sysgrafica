<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_oc = $_POST['id_oc'];
	$conexion = conexion::conectar();
	$cabecera = pg_query($conexion, "SELECT * FROM v_fac_pago WHERE facp_cod = $id_oc;");
        $cab = pg_fetch_all($cabecera);
	$detalles = pg_query($conexion, "SELECT * FROM v_detalle_facp WHERE facp_cod = $id_oc;");
 	$det = pg_fetch_all($detalles);
	$items = pg_query($conexion, "SELECT * FROM factura_compra WHERE fac_cod NOT IN (SELECT fac_cod FROM tdetalle_facp WHERE facp_cod = $id_oc);");
 	$ite = pg_fetch_all($items);
	$pedidos = pg_query($conexion, "SELECT * FROM v_factura_compra WHERE fac_estado = 'ORDENADO';");
 	$ped = pg_fetch_all($pedidos);
        $pedidos_detalles = pg_query($conexion, "SELECT * FROM v_factura_compra_detalle WHERE fac_cod IN (SELECT fac_cod FROM factura_compra WHERE fac_estado = 'ORDENADO');");
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
            <input type="hidden" id="id_oc_detalle" value="<?php echo $cab[0]['facp_cod'];?>">
            <b>Nro: </b><?php echo $cab[0]['facp_cod'];?><br>
            <b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
            <b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
            <b>Funcionario: </b><?php echo $cab[0]['auditoria'].")";?><br>
            <b>Proveedor: </b><?php echo $cab[0]['proveedor'];?><br>
            <b>Con FACTURA COMPRA: </b><?php echo $cab[0]['con_faccompra'];?><br>
            <b>Estado: </b><?php echo $cab[0]['facp_estado'];?><br>
        </div>
    </div>
</div>
<?php if($cab[0]['con_faccompra'] == 'SI'){ ?>
<div class="row">
    <div class="card col-sm-12">
        <div class="card-header p-0">
            <b>SELECCIONE FACTURA COMPRA</b>
        </div>
        <div class="card-body">
            <?php if(empty($ped)){?>
            <label style="color:red">NO HAY FACTURA COMPRA DISPONIBLES</label>
            <?php }else{?>
                <?php foreach($ped as $p){?>
                    <div class="row" id="contenedor<?php echo $p['fac_cod'];?>">
                        <div class="card">
                            <div class="card-header">
                                <input type="checkbox" style="width: 25px; height: 25px;" class="check_pedido" value="<?php echo $p['fac_cod'];?>">&nbsp;&nbsp;
                                <b>Nro Factura Compra: </b><?php echo $p['fac_cod'];?>&nbsp;&nbsp;
                                <b>Sucursal:</b><?php echo $p['suc_nombre'];?>&nbsp;&nbsp;
                                <b>Fecha:</b><?php echo $p['fecha'];?>&nbsp;&nbsp;
                                <a class="btn btn-info" data-toggle="collapse" data-parent="#contenedor<?php echo $p['fac_cod'];?>" href="#pedido<?php echo $p['fac_cod'];?>">
                                    Ver Detalles
                                </a>
                            </div>
                            <div class="card-body panel-collapse collapse in" id="pedido<?php echo $p['fac_cod'];?>">
                                <?php foreach ($ped_det2 as $p2){?>
                                    <b>Item: </b><?php echo $ped_det2[$p['fac_cod']][$pd['id_item']]['item_descrip'] = $pd['item_descrip'];?><br>
                                    <b>Precio: </b><?php echo $ped_det2[$p['fac_cod']][$pd['id_item']]['det_precio'] = $pd['det_precio'];?><br>
                                    <b>Cantidad: </b><?php echo $ped_det2[$p['fac_cod']][$pd['id_item']]['cantidad'] = $pd['cantidad'];?><br>
                                    <b>Monto: </b><?php echo $ped_det2[$p['fac_cod']][$pd['id_item']]['monto'] = $pd['monto'];?><br>
                                    <b>IVA: </b><?php echo $ped_det2[$p['fac_cod']][$pd['id_item']]['iva'] = $pd['iva'];?><br>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
        </div>
    </div> 
    </div> 
<?php } ?>
<div class="row">
    <button type="button" class="btn btn-primary" onclick="grabar_pedidos(<?php echo $cab[0]['facp_cod'];?>);">GRABAR FACTURA DE COMPRA</button>
</div>
<div class="row">
    <div class="card col-sm-12">
        <!--<div class="card-header p-0">
            <b>AGREGAR DETALLE</b>
        </div>-->
        <div >
</div>
<div class="row">
<?php if (empty($det)) { ?>
<label style="color: red">NO SE ENCUENTRAN DETALLES PARA ESTA FACTURA</label>
<?php }else{ ?>
<table id="tabla_panel_pedido" class="table table-bordered table-striped">
	<thead>
		<tr>
                        <th>Cod. Factura de Pago</th>
                        <th>Cod. Factura de Compra</th>
                        <th>Cod. y Artículo</th>
                        <th>Monto Total</th>
                        <th>IVA</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($det as $d){?>
                    <tr>
			<td><?php echo $d['facp_cod'];?></td>
                        <td><?php echo $d['fac_cod'];?></td>
                        <td><?php echo $d['id_item'];?> - <?php echo $d['item_descrip'];?></td>
                        <td><?php echo $d['dfp_monto'];?></td>
                        <td><?php echo $d['dfp_iva'];?></td>
			<td>
                            <button title="Eliminar" type="button" class="btn btn-danger" onclick="eliminar_detalle(<?php echo $d['facp_cod'];?>,<?php echo $d['fac_cod'];?>,<?php echo $d['id_item'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>
<?php }?>
</div>