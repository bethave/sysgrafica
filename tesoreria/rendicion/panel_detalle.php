<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_oc = $_POST['id_oc'];
	$conexion = conexion::conectar();
	$cabecera = pg_query($conexion, "SELECT * FROM v_rendicion WHERE ren_cod = $id_oc;");
        $cab = pg_fetch_all($cabecera);
	$detalles = pg_query($conexion, "SELECT * FROM repor_rendicion WHERE ren_cod = $id_oc;");
 	$det = pg_fetch_all($detalles);
	$items = pg_query($conexion, "SELECT * FROM tfac_pago WHERE facp_cod NOT IN (SELECT facp_cod FROM tdet_rendicionff WHERE ren_cod = $id_oc);");
 	$ite = pg_fetch_all($items);
	$pedidos = pg_query($conexion, "SELECT * FROM v_fac_pago WHERE facp_estado = 'PAGADO';");
 	$ped = pg_fetch_all($pedidos);
        $pedidos_detalles = pg_query($conexion, "SELECT * FROM v_detalle_facp  WHERE facp_cod IN (SELECT facp_cod FROM tfac_pago WHERE facp_estado = 'PAGADO');");
 	$ped_det = pg_fetch_all($pedidos_detalles);
        $ped_det2 = null;
        foreach($ped_det as $pd){
            $ped_det2[$pd['facp_cod']][$pd['fac_cod']][$pd['id_item']]['facp_cod'] = $pd['facp_cod'];
            $ped_det2[$pd['facp_cod']][$pd['fac_cod']][$pd['id_item']]['id_item'] = $pd['id_item'];
            $ped_det2[$pd['facp_cod']][$pd['fac_cod']][$pd['id_item']]['item_descrip'] = $pd['item_descrip'];
            $ped_det2[$pd['facp_cod']][$pd['fac_cod']][$pd['id_item']]['dfp_monto'] = $pd['dfp_monto'];
            $ped_det2[$pd['facp_cod']][$pd['fac_cod']][$pd['id_item']]['dfp_iva'] = $pd['dfp_iva'];
        }
?>
<div class="row">
    <div class="card">
        <div class="card-header p-0">
            <b>DATOS DE LA CABECERA</b>
        </div>
        <div class="card-body">
            <input type="hidden" id="id_oc_detalle" value="<?php echo $cab[0]['ren_cod'];?>">
            <b>Nro: </b><?php echo $cab[0]['ren_cod'];?><br>
            <b>Sucursal: </b><?php echo $cab[0]['suc_nombre'];?><br>
            <b>Fecha: </b><?php echo $cab[0]['fecha'];?><br>
            <b>Funcionario: </b><?php echo $cab[0]['auditoria'].")";?><br>
            <b>Con Factura Compra: </b><?php echo $cab[0]['con_asig'];?><br>
            <b>Estado: </b><?php echo $cab[0]['ren_estado'];?><br>
        </div>
    </div>
</div>
<?php if($cab[0]['con_asig'] == 'SI'){ ?>
<div class="row">
    <div class="card col-sm-12">
        <div class="card-header p-0">
            <b>SELECCIONE FACTURA PAGO</b>
        </div>
        <div class="card-body">
            <?php if(empty($ped)){?>
            <label style="color:red">NO HAY FACTURA DISPONIBLES</label>
            <?php }else{?>
                <?php foreach($ped as $p){?>
                    <div class="row" id="contenedor<?php echo $p['facp_cod'];?>">
                        <div class="card">
                            <div class="card-header">
                                <input type="checkbox" style="width: 25px; height: 25px;" class="check_pedido" value="<?php echo $p['facp_cod'];?>">&nbsp;&nbsp;
                                <b>Nro Cuenta: </b><?php echo $p['facp_cod'];?>&nbsp;&nbsp;
                                <b>Sucursal:</b><?php echo $p['suc_nombre'];?>&nbsp;&nbsp;
                                <b>Fecha:</b><?php echo $p['fecha'];?>&nbsp;&nbsp;
                                <a class="btn btn-info" data-toggle="collapse" data-parent="#contenedor<?php echo $p['facp_cod'];?>" href="#pedido<?php echo $p['facp_cod'];?>">
                                    Ver Detalles
                                </a>
                            </div>
                            <div class="card-body panel-collapse collapse in" id="pedido<?php echo $p['facp_cod'];?>">
                                <?php foreach ($ped_det2 as $p2){?>
                                    <b>Item: </b><?php echo $ped_det2[$p['facp_cod']][$pd['fac_cod']][$pd['id_item']]['item_descrip'];?><br>
                                    <b>Monto: </b><?php echo $ped_det2[$p['facp_cod']][$pd['fac_cod']][$pd['id_item']]['dfp_monto'];?><br>
                                    <b>IVA: </b><?php echo $ped_det2[$p['facp_cod']][$pd['fac_cod']][$pd['id_item']]['dfp_iva'];?><br>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
        </div>
<?php } ?>
<div class="row">
    <button type="button" class="btn btn-primary" onclick="grabar_pedidos(<?php echo $cab[0]['ren_cod'];?>);">GRABAR FACTURA DE PAGO</button>
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
                <!--<b>SELECCIONE EL ITEM</b><br>
                <select id="id_item_detalle" class="form-control col-sm-6 select2">
                    <?php foreach($ite as $i){ ?>
                    <option value="<?php echo $i['id_item'];?>"><?php echo $i['item_descrip'];?></option>
                    <?php } ?>
                </select><br>-->
                <!--<b>INGRESE MONTO DE RENDICION</b>
                <input type="number" class="form-control col-sm-6" id="cantidad_detalle"><br>
                
                <button type="button" class="btn btn-block btn-success col-sm-4" onclick="agregar_detalle(<?php echo $cab[0]['fac_cod'];?>);">
                    Agregar Detalle<i class="fas fa-plus"></i>
                </button>-->
            <?php } ?>
        </div>
    </div>
</div>
<div class="row">
<?php if (empty($det)) { ?>
<label style="color: red">NO SE ENCUENTRAN DETALLES PARA ESTA RENDICION</label>
<?php }else{ ?>
<table id="tabla_panel_pedido" class="table table-bordered table-striped">
	<thead>
		<tr>
                        <th>Código de Rendicion</th>
                        <th>Código de Factura</th>
			<th>Monto de Rendicion</th>
                        <th>Total de IVA</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($det as $d){?>
                    <tr>
			<td><?php echo $d['ren_cod'];?></td>
                        <td><?php echo $d['facp_cod'];?></td>
                        <td><?php echo $d['dr_total'];?></td>
			<td><?php echo $d['dr_iva'];?></td>
			<td>
                            <button title="Editar" type="button" class="btn btn-warning" onclick="editar_detalle(<?php echo $d['ren_cod'];?>,<?php echo $d['facp_cod'];?>,<?php echo $d['dr_monto'];?>,<?php echo $d['dr_iva'];?>)">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button title="Eliminar" type="button" class="btn btn-danger" onclick="eliminar_detalle(<?php echo $d['ren_cod'];?>,<?php echo $d['facp_cod'];?>)">
                                <i class="fas fa-minus"></i>
                            </button>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>
<?php }?>
</div>