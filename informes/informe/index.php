<?php
  include "../../conexion.php";
  include "../../session.php";
  $_SESSION['id_pag'] = '51';
  include "../../permiso.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KAMBA FERRETERÍA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/sysgrafica/iconos/kamba1.ico" type="image/x-icon">
    <link rel="stylesheet" href="/sysgrafica/estilo/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/descarga/font-google.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/toastr/toastr.min.css">
  <style>
        h1{
            font-size: 2000%;
            text-shadow: 4px 5px 4px orange;
            color: black;
            padding: 10px;
            text-align: center;
        }
        h3{
            font-size: 200%;
            text-shadow: 4px 5px 4px yellow;
            color: black;
            padding: 10px;
            text-align: center;
        }
        h5{
            text-shadow: 4px 5px 4px orange;
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
                  <h1 class="m-0 text-dark text-center"><b>INFORMES REFERENCIALES</b></h1>
              </div>
            </div>
          </div>
        </div>
        <section class="content">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <H3><a>INFORME MERCADERÍAS</a></h3>
                    <form action="items.php" class="form-inline" method="POST" target="_blank">
                        <h5 class="col-sm-4"><b>INFORME - STOCK</b></h5><input type="submit" class="btn btn-block btn-dark col-sm-1" value="VISUALIZAR"><BR><BR>
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
    <?php include "../../mensaje.php";?>
  </body>
</html>