<?php
	include "../../conexion.php";
	include "../../session.php";
        $id_suc = $_SESSION['id_suc'];
	$conexion = conexion::conectar();
	$resultado = pg_query($conexion, "SELECT * FROM v_apertura;");
 	$datos = pg_fetch_all($resultado);
?>
<button type="button" class="btn btn-block btn-success col-sm-2" onclick="agregar();">
Apertura&nbsp;<i class="fas fa-plus"></i>
</button>
<table id="tabla_panel_orden" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Nro</th>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Estado</th>
                        <th>Monto Inicial</th>
                        <th>Sucursal</th>
                        <th>Caja Nro</th>
                        <th>Funcionario</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datos as $d){?>
                    <tr>
			<td><?php echo $d['aper_cod'];?></td>
                        <td><?php echo $d['fecha'];?></td>
                        <td><?php echo $d['hora'];?></td>
                        <td><?php echo $d['c_estado'];?></td>
                        <td><?php echo $d['aper_minicial'];?></td>
                        <td><?php echo $d['suc_nombre'];?></td>
			<td><?php echo $d['caja_id']." - ".$d['caja_descri']." - ".$d['c_estado'];?></td>
			<td><?php echo $_SESSION['per_nombre']." - ".$_SESSION['per_apellido'];?></td>
			
			<td>
                            <?php if($d['c_estado']=='ABIERTO'){ ?>
                            
                            <button title="imprimir" type="submit" class="btn btn-outline-warning" onclick="imprimir(<?php echo $d['aper_cod'];?>)">PRINT
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                            <?php if($d['c_estado']=='CERRADO'){ ?>
                            
                            <button title="imprimir" type="submit" class="btn btn-outline-warning" onclick="imprimir(<?php echo $d['aper_cod'];?>)">PRINT
                                <i class="fas fa-check"></i>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
		<?php }?>
	</tbody>
</table>