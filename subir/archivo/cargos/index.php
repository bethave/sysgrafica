<?php
  include "../../conexion.php";
  include "../../session.php";
  $_SESSION['id_pag'] = '3';
  include "../../permiso.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SYSGRAFICA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/sysgrafica/iconos/icono_cdt_azul.png" type="png">
    <link rel="stylesheet" href="/sysgrafica/estilo/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/descarga/font-google.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/toastr/toastr.min.css">
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
                <h1 class="m-0 text-dark">CARGOS</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active">ARCHIVO</li>
                  <li class="breadcrumb-item active">CARGOS</li>
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
                  <input class="form-control" type="text" id="descripcion_agregar" autofocus="true" placeholder="Nuevo Cargo">
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
                  <input class="form-control" type="text" id="descripcion_editar" value="" autofocus="true">
                  <input type="hidden" id="descripcion_anterior_editar" value="">
                  <input type="hidden" id="codigo_editar" value="">
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cerrar_editar">Cerrar</button>
                  <button type="button" class="btn btn-primary" onclick="grabar('2');">Grabar</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modal-activar">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <i class="fas fa-check btn-success"></i>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input type="hidden" id="codigo_activar" value="">
                  <h4 id="pregunta_activar">¿ESTAS SEGURO DE ACTIVAR?</h4>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_cerrar_activar">NO</button>
                  <button type="button" class="btn btn-success" onclick="grabar('3');">SI</button>
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
                  <h4 id="pregunta_inactivar">¿ESTAS SEGURO DE INACTIVAR?</h4>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_cerrar_inactivar">NO</button>
                  <button type="button" class="btn btn-success" onclick="grabar('4');">SI</button>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <strong>Copyright &copy; 2019 <a href="#">SYSGRAFICA</a></strong>
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
    <?php include "../../mensaje.php";?>
  </body>
</html>