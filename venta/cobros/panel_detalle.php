<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_oc = $_POST['id_oc'];
	$conexion = conexion::conectar();
	$cabecera = pg_query($conexion, "SELECT * FROM v_cobros WHERE cobro_cod = $id_oc;");
        $cab = pg_fetch_all($cabecera);
	$detalles = pg_query($conexion, "SELECT * FROM v_cobros_reporte WHERE cobro_cod = $id_oc;");
 	$det = pg_fetch_all($detalles);
	$items = pg_query($conexion, "SELECT * FROM venta_factura WHERE fac_cod NOT IN (SELECT fac_cod FROM venta_cobros_detalle WHERE cobro_cod = $id_oc);");
 	$ite = pg_fetch_all($items);
	$pedidos = pg_query($conexion, "SELECT * FROM v_venta_factura WHERE fac_estado = 'ORDENADO';");
 	$ped = pg_fetch_all($pedidos);
        $pedidos_detalles = pg_query($conexion, "SELECT * FROM v_venta_factura_detale WHERE fac_cod IN (SELECT fac_cod FROM venta_factura WHERE fac_estado = 'ORDENADO');");
 	$ped_det = pg_fetch_all($pedidos_detalles);
        $factura = pg_query($conexion, "SELECT * FROM v_venta_factura_reporte;");
 	$factrep = pg_fetch_all($factura);
        $cuenta = pg_query($conexion, "SELECT * FROM v_cuenta_cobrar where estado='PENDIENTE' ;");
 	$cbr = pg_fetch_all($cuenta);
        $forma = pg_query($conexion, "SELECT * FROM forma_cobro WHERE estado = 'ACTIVO';");
 	$form = pg_fetch_all($forma);
        $banco = pg_query($conexion, "SELECT * FROM banco WHERE estado = 'ACTIVO';");
 	$ban = pg_fetch_all($banco);
        $ped_det2 = null;
        foreach($ped_det as $pd){
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['fac_cod'] = $pd['fac_cod'];
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['id_item'] = $pd['id_item'];
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['item_descrip'] = $pd['item_descrip'];
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['precio'] = $pd['precio'];
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['cantidad'] = $pd['cantidad'];
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['iva'] = $pd['iva'];
            $ped_det2[$pd['fac_cod']][$pd['id_item']]['monto'] = $pd['monto'];
        }
?>
<div class="row">
    <div class="card">
        <div class="card-header p-0">
            <b>DATOS DE LA CABECERA</b>
        </div>
        <div class="card-body">
            <input type="hidden" id="id_oc_detalle" value="<?php echo $cab[0]['cobro_cod'];?>">
            <b>Nro: </b><?php echo $cab[0]['cobro_cod'];?><br>
            <b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
            <b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
            <b>Funionario: </b><?php echo $cab[0]['auditoria2'];?><br>
            <b>Con Factura: </b><?php echo $cab[0]['con_factura'];?><br>
            <b>Estado: </b><?php echo $cab[0]['cobro_estado'];?><br>
        </div>
    </div>
</div>
<?php if($cab[0]['con_factura'] == 'SI'){ ?>
<!--<div class="row">
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
                                    <b>Item: </b><?php echo $ped_det2[$pd['fac_cod']][$pd['id_item']]['item_descrip'] = $pd['item_descrip'];?><br>
                                    <b>Precio: </b><?php echo $ped_det2[$pd['fac_cod']][$pd['id_item']]['precio'] = $pd['precio'];?><br>
                                    <b>Cantidad: </b><?php echo $ped_det2[$pd['fac_cod']][$pd['id_item']]['cantidad'] = $pd['cantidad'];?><br>
                                    <b>IVA: </b><?php echo $ped_det2[$pd['fac_cod']][$pd['id_item']]['iva'] = $pd['iva'];?><br>
                                    <b>MONTO: </b><?php echo $ped_det2[$pd['fac_cod']][$pd['id_item']]['monto'] = $pd['monto'];?><br>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
        </div>
<?php } ?>
<div class="row">
    <button type="button" class="btn btn-primary" onclick="grabar_pedidos(<?php echo $cab[0]['cobro_cod'];?>);">GRABAR FACTURA</button>
</div>-->
<div class="row">
    <div class="card col-sm-12">
        <div class="card-header p-0">
            <b>AGREGAR DETALLE</b>
        </div>
        <div class="card-body">
            <?php if(empty($cbr)){ ?>
                <label style="color: red">NO HAY CUENTAS A COBRAR DISPONIBLES</label>
            <?php }else{ ?>
                <br><b>SELECCIONE EL CUENTA A COBRAR</b><br>
                <select id="id_cuenta" class="form-control col-sm-6 select2">
                    <?php foreach($cbr as $c){ ?>
                    <option value="<?php echo $c['cuen_nro'];?>">Código: <?php echo $c['cuen_nro'];?> - Cod_factura:  <?php echo $c['fac_cod'];?> - Estado: <?php echo $c['estado'];?> - Monto: <?php echo $c['cuen_monto'];?></option>
                    <?php } ?>
                </select><br>
                <b>SELECCIONE EL FORMA DE PAGO</b><br>
                <select id="id_forma" class="form-control col-sm-6 select2">
                    <?php foreach($form as $f){ ?>
                    <option value="<?php echo $f['fc_id'];?>">Código: <?php echo $f['fc_id'];?> - Forma:  <?php echo $f['fc_descri'];?> - Tipo: <?php echo $f['fc_tipo'];?></option>
                    <?php } ?>
                </select><br>
                <b>SELECCIONE EL BANCO</b><br>
                <select id="id_ban" class="form-control col-sm-6 select2">
                    <?php foreach($ban as $b){ ?>
                    <option value="<?php echo $b['ban_cod'];?>">Código: <?php echo $b['ban_cod'];?> - Descripción: <?php echo $b['ban_descri'
                        . ''];?></option>
                    <?php } ?>
                </select><br>
                <b>INGRESE MONTO A PAGAR</b>
                <input type="number" class="form-control col-sm-6" id="monto_detalle"><br>
                <dl></dl>
                <button type="button" class="btn btn-block btn-success col-sm-4" onclick="agregar_detalle(<?php echo $cab[0]['cobro_cod'];?>);">
                    Agregar Detalle<i class="fas fa-plus"></i>
                </button>
            <?php } ?>
        </div>
    </div>
</div>
<div class="row">
<?php if (empty($det)) { ?>
<label style="color: red">NO SE ENCUENTRAN DETALLES PARA ESTE COBRO</label>
<?php }else{ ?>
<table id="tabla_panel_pedido" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Nro Cobro</th>
			<th>Cuenta Nro</th>
			<th>Factura Nro</th>
                        <th>Forma de Cobro</th>
                        <th>Banco</th>
                        <th>Monto Total</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($det as $d){?>
                    <tr>
			<td><?php echo $d['cobro_cod'];?></td>
                        <td><?php echo $d['cuen_nro'];?></td>
			<td>Código: <?php echo $d['fac_cod'];?> - Cuotas: <?php echo $d['fac_cuotas'];?></td>
			<td><?php echo $d['fc_id'];?> - Descripción: <?php echo $d['fc_descri'];?> - Tipo: <?php echo $d['fc_tipo'];?></td>
                        <td><?php echo $d['ban_cod'];?> - Descripción: <?php echo $d['ban_descri'];?></td>
                        <td><?php echo $d['montototal'];?></td>
			<td>
                            <button title="Editar" type="button" class="btn btn-warning" onclick="editar_detalle(<?php echo $d['cobro_cod'];?>,<?php echo $d['cuen_nro'];?>,<?php echo $d['fac_cod'];?>,<?php echo $d['fc_id'];?>,<?php echo $d['ban_cod'];?>,<?php echo $d['montototal'];?>)">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button title="Eliminar" type="button" class="btn btn-danger" onclick="eliminar_detalle(<?php echo $d['cobro_cod'];?>,<?php echo $d['cuen_nro'];?>,<?php echo $d['fac_cod'];?>,<?php echo $d['fc_id'];?>,<?php echo $d['ban_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>
<?php }?>
</div>