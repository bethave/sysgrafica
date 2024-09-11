<?php
  include "../../conexion.php";
  include "../../session.php";
  $_SESSION['id_pag'] = '30';
  include "../../permiso.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FERRETERIA KAMBA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/sysgrafica/iconos/kamba.png" type="png">
    <link rel="stylesheet" href="/sysgrafica/estilo/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/descarga/font-google.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/toastr/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <?php include ("../../cabecera.php"); ?>
      <?php include ("../../menu.php"); ?>
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">ITEMS</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active">ARCHIVO</li>
                  <li class="breadcrumb-item active">ITEMS</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <section class="content">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-block btn-success col-sm-2" data-toggle="modal" data-target="#modal-agregar" onclick="agregar();">
                      Agregar&nbsp;<i class="fas fa-plus"></i>
                    </button>
                    <input type="hidden" id="btn-modal-editar" data-toggle="modal" data-target="#modal-editar">
                    <input type="hidden" id="btn-modal-activar" data-toggle="modal" data-target="#modal-activar">
                    <input type="hidden" id="btn-modal-inactivar" data-toggle="modal" data-target="#modal-inactivar">
                    <input type="hidden" id="btn-modal-detalle" data-toggle="modal" data-target="#modal-detalle">
                </div>
                <div class="card-body" id="div_tabla">

                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modal-agregar">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Agregar</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
<!--                 <input class="form-control" type="text" id="descripcion_agregar" placeholder="Ciudad"><br>-->
<!--                 <input class="form-control" type="text" id="pais_agregar" placeholder="Pais"><br>-->
                  <label>Seleccione una Marca</label>
                  <select id="marca_agregar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_marca = pg_query($conexion, "SELECT * FROM marcas;");
                        $marca = pg_fetch_all($r_marca);
                      ?>
                      <?php foreach($marca as $c){ ?>
                      <option value="<?php echo $c['id_mar']; ?>"><?php echo $c['mar_descrip']; ?></option>
                      <?php } ?>
                  </select>
                  <label>Seleccione Tipo Impuesto</label>
                  <select id="ti_agregar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_ti = pg_query($conexion, "SELECT * FROM tipo_impuesto;");
                        $ti = pg_fetch_all($r_ti);
                      ?>
                      <?php foreach($ti as $tp){ ?>
                      <option value="<?php echo $tp['id_ti']; ?>"><?php echo $tp['ti_descrip']; ?></option>
                      <?php } ?>
                  </select>
                  <label>Seleccione Tipo Item</label>
                  <select id="tpi_agregar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_tpi = pg_query($conexion, "SELECT * FROM tipo_item;");
                        $tpi = pg_fetch_all($r_tpi);
                      ?>
                      <?php foreach($tpi as $t){ ?>
                      <option value="<?php echo $t['id_tpi']; ?>"><?php echo $t['tpi_descrip']; ?></option>
                      <?php } ?>
                  </select>
                  <dl></dl>
                  <input class="form-control" type="text" id="descripcion_agregar" autofocus="true" placeholder="Nueva Descripcion"><br>
                  <input class="form-control" min="1" type="number" id="compra_agregar" autofocus="true" placeholder="Nuevo Precio Compra"><br>
                  <input class="form-control" min="1" type="number" id="venta_agregar" autofocus="true" placeholder="Nuevo Precio Venta"><br>
                  <label>Seleccione Unidad Medida</label>
                  <select id="um_agregar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_um = pg_query($conexion, "SELECT * FROM unidad_medida;");
                        $um= pg_fetch_all($r_um);
                      ?>
                      <?php foreach($um as $u){ ?>
                      <option value="<?php echo $u['um_id']; ?>"><?php echo $u['um_descri']; ?></option>
                      <?php } ?>
                  </select>
                  <label>Seleccione Procedencia</label>
                  <select id="proce_agregar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_proce = pg_query($conexion, "SELECT * FROM procedencia;");
                        $proce = pg_fetch_all($r_proce);
                      ?>
                      <?php foreach($proce as $pr){ ?>
                      <option value="<?php echo $pr['proce_id']; ?>"><?php echo $pr['proce_descri']; ?></option>
                      <?php } ?>
                  </select>
                  <label>IMAGEN</label>
                  <form action="index.php" method="POST"/>
                        Nombre de Imagen: <input name="imagen" id="imagen" type="file"/>
                  </form>
                  <label>Agrega una Imagen</label>
                  <input class="form-control" type="text" id="img_agregar" autofocus="true" value=""><br>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cerrar_agregar">Cerrar</button>
                  <button type="button" class="btn btn-primary" onclick="grabar('1');">Grabar</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modal-editar">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Editar</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
<!--                  <input class="form-control" type="text" id="descripcion_editar" value="" autofocus="true" placeholder="Nueva Ciudad">
                  <input type="hidden" id="descripcion_anterior_editar" value="">
-->                  <input type="hidden" id="codigo_editar" value="">
                     
                 <label>Seleccione una Marca</label>
                  <select id="marca_anterior_editar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_marca = pg_query($conexion, "SELECT * FROM marcas;");
                        $marca = pg_fetch_all($r_marca);
                      ?>
                      <?php foreach($marca as $c){ ?>
                      <option value="<?php echo $c['id_mar']; ?>"><?php echo $c['mar_descrip']; ?></option>
                      <?php } ?>
                  </select>
                  <label>Seleccione Tipo Impuesto</label>
                  <select id="ti_anterior_editar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_ti = pg_query($conexion, "SELECT * FROM tipo_impuesto;");
                        $ti = pg_fetch_all($r_ti);
                      ?>
                      <?php foreach($ti as $tp){ ?>
                      <option value="<?php echo $tp['id_ti']; ?>"><?php echo $tp['ti_descrip']; ?></option>
                      <?php } ?>
                  </select>
                  <label>Seleccione Tipo Item</label>
                  <select id="tpi_anterior_editar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_tpi = pg_query($conexion, "SELECT * FROM tipo_item;");
                        $tpi = pg_fetch_all($r_tpi);
                      ?>
                      <?php foreach($tpi as $t){ ?>
                      <option value="<?php echo $t['id_tpi']; ?>"><?php echo $t['tpi_descrip']; ?></option>
                      <?php } ?>
                  </select>
                  <dl></dl>
                  <input class="form-control" type="text" id="descripcion_editar" autofocus="true" placeholder="Nueva Descripcion"><br>
                  <input type="hidden" id="descripcion_editar_editar" value="">
                  <input class="form-control" type="number" id="compra_editar" autofocus="true" placeholder="Nuevo Precio Compra"><br>
                  <input type="hidden" id="compra_anterior_editar" value="">
                  <input class="form-control" type="number" id="venta_editar" autofocus="true" placeholder="Nuevo Precio Venta"><br>
                  <input type="hidden" id="venta_anterior_editar" value="">
                  <label>Seleccione Unidad Medida</label>
                  <select id="um_anterior_editar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_um = pg_query($conexion, "SELECT * FROM unidad_medida;");
                        $um= pg_fetch_all($r_um);
                      ?>
                      <?php foreach($um as $u){ ?>
                      <option value="<?php echo $u['um_id']; ?>"><?php echo $u['um_descri']; ?></option>
                      <?php } ?>
                  </select>
                  <label>Seleccione Procedencia</label>
                  <select id="proce_anterior_editar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_proce = pg_query($conexion, "SELECT * FROM procedencia;");
                        $proce = pg_fetch_all($r_proce);
                      ?>
                      <?php foreach($proce as $pr){ ?>
                      <option value="<?php echo $pr['proce_id']; ?>"><?php echo $pr['proce_descri']; ?></option>
                      <?php } ?>
                  </select>
                  <label>IMAGEN</label>
                  <form action="index.php" method="POST"/>
                        Nombre de Imagen: <input name="imagen" id="imagen" type="file"/>
                  </form>
                  <label>Agrega una Imagen</label>
                  <input class="form-control" type="text" id="img_editar" autofocus="true" value=""><br>
                  <input type="hidden" id="img_anterior_editar" value="">
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cerrar_editar">Cerrar</button>
                  <button type="button" class="btn btn-primary" onclick="grabar('2');">Grabar</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modal-inactivar">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <i class="fas fa-minus btn-danger"></i>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input type="hidden" id="codigo_inactivar" value="">
                  <h4 id="pregunta_inactivar">¿ESTAS SEGURO DE ANULAR?</h4>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_cerrar_inactivar">NO</button>
                  <button type="button" class="btn btn-success" onclick="grabar('3');">SI</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modal-detalle">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <i class="fas fa-minus btn-danger"></i>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <div class="modal-body">
                        <div id="detalle-persona">
                        </div>
                  </div>
                </div>
            </div>
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <strong>Todos los derechos reservados &copy; 2022 <a href="#">SYGESVEN</a></strong>
      </footer>
    </div>
    <script src="/sysgrafica/estilo/plugins/jquery/jquery.min.js"></script>
    <script src="/sysgrafica/estilo/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script> $.widget.bridge('uibutton', $.ui.button) </script>
    <script src="/sysgrafica/estilo/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/sysgrafica/estilo/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="/sysgrafica/estilo/dist/js/adminlte.js"></script>
    <script src="/sysgrafica/iconos/fontawesome.js"></script>
    <script src="/sysgrafica/estilo/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/sysgrafica/estilo/plugins/datatables/dataTables.bootstrap4.js"></script>
    <script src="/sysgrafica/estilo/plugins/fastclick/fastclick.js"></script>
    <script src="/sysgrafica/estilo/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="/sysgrafica/estilo/plugins/toastr/toastr.min.js"></script>
    <script src="funciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <?php include "../../mensaje.php";?>
  </body>
</html>