<?php
	include "conexion.php";
	include "session.php";
  $_SESSION['id_pag'] = '0';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FERRETERÍA KAMBA</title>
    <meta name="viewport" content="width=device-width, initial-scale=2">
    <link rel="icon" href="/sysgrafica/iconos/kamba1.ico" type="image/x-icon">
    <link rel="stylesheet" href="/sysgrafica/estilo/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/descarga/font-google.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="/sysgrafica/estilo/plugins/toastr/toastr.min.css">
    <style>
        h1{
            font-size: 400%;
            text-shadow: 7px 5px 4px #000;
            color: #000;
            padding: 10px;
        }
        h4{
            text-shadow: 1px 2px 2px #000;
            color: #000;
        }
        img{
            display:block;
            margin:auto;
        }
    </style>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed ">
    <div class="wrapper">
      <?php include ("cabecera.php"); ?>
      <?php include ("menu.php"); ?>
        <div class="content-wrapper">
        <div class="content-header" >
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                  <h4 class="m-0 text-warning"><b>FERRETERÍA KAMBA</b></h4>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><b>FERRETERÍA KAMBA</b></a></li>
                  <li class="breadcrumb-item active">INICIO</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <!--<div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>150</h3>
                    <p>New Orders</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-alert-circled"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>-->
              <!--<div class="col-lg-3 col-6">
                <div class="small-box bg-dark">
                  <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                    <p>Bounce Rate</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>-->
              <!--<div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>44</h3>
                    <p>User Registrations</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>-->
              <!--<div class="col-lg-3 col-6">
                <div class="small-box bg-dark">
                  <div class="inner">
                    <h3>65</h3>
                    <p>Unique Visitors</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>-->
                <h1 class="m-2 text-warning text-center col-sm-11"><br><b>¡BIENVENIDO AL SISTEMA!</b></h1>
                <img src="iconos/Kamba.png" width="400" height="350" center="100%">
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
    <script src="/sysgrafica/estilo/plugins/fastclick/fastclick.js"></script>
    <script src="/sysgrafica/estilo/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="/sysgrafica/estilo/plugins/toastr/toastr.min.js"></script>
    <?php include "mensaje.php"; ?>
  </body>
</html>