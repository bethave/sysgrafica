<?php 
$codigo = $_POST['codigo'];
include "../../conexion.php";
$conexion = conexion::conectar();
$resultado = pg_query($conexion,"SELECT * FROM v_items WHERE id_item = $codigo;");
$r = pg_fetch_all($resultado);
if(!empty($r)){ ?>
<table id="tabla_items" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
                        <th>Descripción</th>
                        <th>Marcas</th>
                        <th>Tipo Item</th>
                        <th>Tipo de Impuesto</th>
		</tr>
                <tr>
                    <td><?php echo $r[0]['id_item'];?></td>
                    <td><?php echo $r[0]['item_descrip'];?></td>
                    <td><?php echo $r[0]['mar_descrip'];?></td>
                    <td><?php echo $r[0]['tpi_descrip'];?></td>
                    <td><?php echo $r[0]['ti_descrip'];?></td>
                </tr>
	</thead>
<table id="tabla_items" class="table table-bordered table-striped">
    <thead>
        <tr>
			<th>Unidad de Medida</th>
                        <th>Procedencia</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
		</tr>
                <tr>
                    <td><?php echo $r[0]['um_descri'];?></td>
                    <td><?php echo $r[0]['proce_descri'];?></td>
                    <td><?php echo $r[0]['precio_compra'];?></td>
                    <td><?php echo $r[0]['precio_venta'];?></td>
                </tr>
    </thead>
</table>
<table id="tabla_items" class="table table-bordered table-striped">
    <thead>
            <tr>
                <th>Imagen del Producto</th>
            </tr>
            <tr>
                <td><img src="<?php echo $r[0]['itm_imagen'];?>" border='0' width='600' height='600' ></td>
            </tr>
    </thead>
</table>
<?php }else{ ?>
    <b>NO HAY RESULTADOS</b>
<?php } ?>