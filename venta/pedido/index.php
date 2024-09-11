<?php
  include "../../conexion.php";
  include "../../session.php";
  $_SESSION['id_pag'] = '42';
  include "../../permiso.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FASCY SHOP S.A</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/sysgrafica/iconos/fascy2.png" type="png">
    <link rel="stylesheet" href="/sysgrafica/estilo/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/descarga/font-google.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/select2/css/select2.min.css">
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
                <h1 class="m-0 text-dark">PEDIDO VENTA</h1>
                <input type="hidden" id="btn-modal-editar-detalle" data-toggle="modal" data-target="#modal-editar-detalle">
                <input type="hidden" id="btn-modal-confirmar" data-toggle="modal" data-target="#modal-confirmar">
                <input type="hidden" id="btn-modal-anular" data-toggle="modal" data-target="#modal-anular">
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active">VENTA</li>
                  <li class="breadcrumb-item active">PEDIDO</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <section class="content">
            <div class="card">
                <div class="card-header p-0">
                    <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item"><a class="nav-link active" href="#panel-pedido" id="btn-panel-pedido" data-toggle="tab">Pedidos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#panel-cabecera" id="btn-panel-cabecera" data-toggle="tab">Cabecera</a></li>
                        <li class="nav-item"><a class="nav-link" href="#panel-detalle" id="btn-panel-detalle" data-toggle="tab">Detalle</a></li>
<!--                        <li class="nav-item"><a class="nav-link" href="#panel-otros" id="btn-panel-otros" data-toggle="tab">OTROS</a></li>-->
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="panel-pedido">
                            NO HAY DATOS
                        </div>
                        <div class="tab-pane" id="panel-cabecera">
                            SELECCIONE UNA ACCIÓN
                        </div>
                        <div class="tab-pane" id="panel-detalle">
                            SELECCIONE UNA CABECERA PARA VISUALIZAR LOS DETALLES
                        </div>
                        <div class="tab-pane" id="panel-otros">
                            Campo de texto inhabilitado
                            <input type="text" disabled="" class="form-control col-sm-6" id="campo1" value="esto esta deshabilitado1">
                            <input type="text" disabled="" class="form-control col-sm-6" id="campo2" value="esto esta deshabilitado2">
                            <input type="text" disabled="" class="form-control col-sm-6" id="campo3" value="esto esta deshabilitado3">
                            <input type="text" disabled="" class="form-control col-sm-6" id="campo4" value="esto esta deshabilitado4">
                            <input type="text" disabled="" class="form-control col-sm-6" id="campo5" value="esto esta deshabilitado5">
                            Radio Botones<br>
                            <input type="radio" class="form-control" id="grupo1" name="grupo" onchange="habilitar_campo(3);" value="1"><label for="grupo1">Grupo1</label><br>
                            <input type="radio" class="form-control" id="grupo2" name="grupo" onchange="deshabilitar_campo(3);" value="2">Grupo2<br>
                            <input type="radio" class="form-control" id="grupo3" name="grupo" value="3">Grupo3<br>
                            <input type="radio" class="form-control" id="grupo4" name="grupo" value="4">Grupo4<br>
                            <input type="radio" class="form-control" id="grupo5" name="solitario1" value="5" checked="">Grupo5<br>
                            <input type="radio" class="form-control" id="grupo6" name="solitario2" value="6">Grupo6<br>
                            <br>
                            ESTO ES UN CHECKBOX:
                            EJEMPLO DE CHECK CON GRILLA
                            <input type="button" onclick="verificar()" value="VERIFICAR">
                            <table class="col-12">
                                <thead>
                                    <tr>
                                        <th>CODIGO</th>
                                        <th>ARTICULO</th>
                                        <th>CANTIDAD</th>
                                        <th>PRESENTADO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><label for="presentado1">MARTILLO</label></td>
                                        <td>10</td>
                                        <td><input type="checkbox" class="detalle" value="1" id="presentado1"><input type="button" onclick="comprobar(1)" value="COMPROBAR"></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>PINZA</td>
                                        <td>7</td>
                                        <td><input type="checkbox" class="detalle" id="presentado2" value="2"><input type="button" onclick="comprobar(2)" value="COMPROBAR"></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>MACHETE</td>
                                        <td>15</td>
                                        <td><input type="checkbox" class="detalle" value="4" id="presentado3"><input type="button" onclick="comprobar(3)" value="COMPROBAR"></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>DESTORNILLADOR</td>
                                        <td>8</td>
                                        <td><input type="checkbox" class="detalle" value="DE ESTE ME OLVIDE" id="presentado4"><input type="button" onclick="comprobar(4)" value="COMPROBAR"></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>PALA</td>
                                        <td>1</td>
                                        <td><input type="checkbox" class="detalle" value="7" id="presentado5"><input type="button" onclick="comprobar(5)" value="COMPROBAR"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-editar-detalle">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            INGRESE LA NUEVA CANTIDAD
                            <input class="form-control" type="number" id="cantidad_editar" value="">
                            <input type="hidden" id="id_ped_editar" value="">
                            <input type="hidden" id="id_item_editar" value="">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cerrar_editar_detalle">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="grabar_editar_detalle();">Grabar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-confirmar">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <i class="fas fa-check btn-success"></i>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_ped_confirmar" value="">
                            <h4>¿ESTAS SEGURO DE CONFIRMAR?</h4>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_cerrar_confirmar">NO</button>
                            <button type="button" class="btn btn-success" onclick="grabar_confirmar();">SI</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-anular">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <i class="fas fa-check btn-success"></i>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_ped_anular" value="">
                            <h4>¿ESTAS SEGURO DE ANULAR?</h4>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_cerrar_anular">NO</button>
                            <button type="button" class="btn btn-success" onclick="grabar_anular();">SI</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </div>
      <footer class="main-footer">
        <strong>Copyright &copy; 2019 <a href="#">FASCY SHOP S.A</a></strong>
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
    <script src="/sysgrafica/estilo/plugins/select2/js/select2.full.min.js"></script>
    <script src="funciones.js"></script>
    <?php include "../../mensaje.php";?>
  </body>
</html>