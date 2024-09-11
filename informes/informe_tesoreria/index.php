<?php
  include "../../conexion.php";
  include "../../session.php";
  $_SESSION['id_pag'] = '70';
  include "../../permiso.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FERRESHOP S.A</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/sysgrafica/iconos/fascy2.png" type="jpeg">
    <link rel="stylesheet" href="/sysgrafica/estilo/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/descarga/font-google.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/toastr/toastr.min.css">
  <style>
        h1{
            font-size: 1000%;
            text-shadow: 4px 5px 4px red;
            color: black;
            padding: 10px;
        }
        h5{
            text-shadow: 4px 5px 4px red;
            color: black;
        }
    </style>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <?php include ("../../cabecera.php"); ?>
      <?php include ("../../menu.php"); ?>
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-11">
                  <h1 class="m-0 text-dark text-center"><b>INFORMES DE TESORERIA</b></h1>
              </div>
            </div>
          </div>
        </div>
        <section class="content">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <form action="factura.php" class="form-inline" method="POST" target="_blank">
                        <h5 class="col-sm-4"><b>INFORME - FACTURA DE PAGO</b></h5><input type="submit" class="btn btn-block btn-danger col-sm-1" value="VISUALIZAR"><BR>
                    </form>
                    <hr>
                    <dl></dl>
                    <form action="ordenp.php" class="form-inline" method="POST" target="_blank">
                        <h5 class="col-sm-4"><b>INFORME - ORDEN DE PAGO</b></h5><input type="submit" class="btn btn-block btn-danger col-sm-1" value="VISUALIZAR"><BR><BR>
                    </form>
                    <hr>
                    <dl></dl>
                    <form action="entcheq.php" class="form-inline" method="POST" target="_blank">
                        <h5 class="col-sm-4"><b>INFORME - ENTREGA DE CHEQUE</b></h5><input type="submit" class="btn btn-block btn-danger col-sm-1" value="VISUALIZAR"><BR><BR>
                    </form>
                    <hr>
                    <dl></dl>
                    <form action="proc.php" class="form-inline" method="POST" target="_blank">
                        <h5 class="col-sm-4"><b>INFORME - PROCESOS ESPECIALES</b></h5><input type="submit" class="btn btn-block btn-danger col-sm-1" value="VISUALIZAR"><BR><BR>
                    </form>
                    <hr>
                    <dl></dl>
                    <form action="asig.php" class="form-inline" method="POST" target="_blank">
                        <h5 class="col-sm-4"><b>INFORME - ASIGNACION DE FONDO FIJO</b></h5><input type="submit" class="btn btn-block btn-danger col-sm-1" value="VISUALIZAR"><BR><BR>
                    </form>
                    <hr>
                    <dl></dl>
                    <form action="rendi.php" class="form-inline" method="POST" target="_blank">
                        <h5 class="col-sm-4"><b>INFORME - RENDICIÓN DE FONDO FIJO</b></h5><input type="submit" class="btn btn-block btn-danger col-sm-1" value="VISUALIZAR"><BR><BR>
                    </form>
                    <hr>
                    <dl></dl>
                    <form action="conci.php" class="form-inline" method="POST" target="_blank">
                        <h5 class="col-sm-4"><b>INFORME - CONCILIACION BANCARIA</b></h5><input type="submit" class="btn btn-block btn-danger col-sm-1" value="VISUALIZAR"><BR><BR>
                    </form>
                    <hr>
                    <dl></dl>
                    <form action="otr.php" class="form-inline" method="POST" target="_blank">
                        <h5 class="col-sm-4"><b>INFORME - OTROS DEBITO/CREDITOS</b></h5><input type="submit" class="btn btn-block btn-danger col-sm-1" value="VISUALIZAR"><BR><BR>
                    </form>
                    <hr>
                    <dl></dl>
                    <form action="bdep.php" class="form-inline" method="POST" target="_blank">
                        <h5 class="col-sm-4"><b>INFORME - BOLETA DE DEPÓSITO</b></h5><input type="submit" class="btn btn-block btn-danger col-sm-1" value="VISUALIZAR"><BR><BR>
                    </form>
                    <hr>
                    <dl></dl>
                    <form action="repo.php" class="form-inline" method="POST" target="_blank">
                        <h5 class="col-sm-4"><b>INFORME - REPOSICION DE FONDO FIJO</b></h5><input type="submit" class="btn btn-block btn-danger col-sm-1" value="VISUALIZAR"><BR><BR>
                    </form>
                    <hr>
                    <dl></dl>
                    <form action="liq.php" class="form-inline" method="POST" target="_blank">
                        <h5 class="col-sm-4"><b>INFORME - LIQUIDACION CON TARJETA DE CREDITO</b></h5><input type="submit" class="btn btn-block btn-danger col-sm-1" value="VISUALIZAR"><BR><BR>
                    </form>
                    <hr>
                    <dl></dl>
                    <form action="trans.php" class="form-inline" method="POST" target="_blank">
                        <h5 class="col-sm-4"><b>INFORME - TRANSFERENCIA BANCARIA</b></h5><input type="submit" class="btn btn-block btn-danger col-sm-1" value="VISUALIZAR"><BR><BR>
                    </form>
                    <hr>
                    <input type="hidden" id="btn-modal-editar" data-toggle="modal" data-target="#modal-editar">
                    <input type="hidden" id="btn-modal-activar" data-toggle="modal" data-target="#modal-activar">
                    <input type="hidden" id="btn-modal-inactivar" data-toggle="modal" data-target="#modal-inactivar">
                    <input type="hidden" id="btn-modal-detalle" data-toggle="modal" data-target="#modal-detalle">
                </div>
                
              </div>
            </div>
          </div>
       
        </section>
      </div>
      <footer class="main-footer">
        <strong>Copyright &copy; 2021 <a href="#">FERRESHOP S.A</a></strong>
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