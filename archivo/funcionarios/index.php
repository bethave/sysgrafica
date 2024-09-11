<?php
  include "../../conexion.php";
  include "../../session.php";
  $_SESSION['id_pag'] = '5';
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
                <h1 class="m-0 text-dark">FUNCIONARIOS</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active">REFERENCIALE</li>
                  <li class="breadcrumb-item active">FUNCIONARIOS</li>
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
                  <label>Seleccione Persona</label>
                  <select id="descripcion_agregar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_des = pg_query($conexion, "SELECT * FROM v_personas WHERE estado = 'ACTIVO';");
                        $descripcion = pg_fetch_all($r_des);
                      ?>
                      <?php foreach($descripcion as $d){ ?>
                      <option value="<?php echo $d['id_per']; ?>"><?php echo $d['persona']; ?></option>
                      <?php } ?>
                  </select>
                  
                    <label>Seleccione Cargo</label>
                  <select id="pais_agregar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_pais = pg_query($conexion, "SELECT * FROM cargos WHERE estado = 'ACTIVO';");
                        $pais = pg_fetch_all($r_pais);
                      ?>
                      <?php foreach($pais as $c){ ?>
                      <option value="<?php echo $c['id_car']; ?>"><?php echo $c['car_descrip']; ?></option>
                      <?php } ?>
                  </select>
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
                  <input type="hidden" id="descripcion_anterior_editar" value="">-->
                  <input type="hidden" id="codigo_editar" value="">
                 
                  <label>Seleccione Persona</label>
                  <select id="descripcion_editar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_des = pg_query($conexion, "SELECT * FROM v_personas WHERE estado = 'ACTIVO';");
                        $descripcion = pg_fetch_all($r_des);
                      ?>
                      <?php foreach($descripcion as $d){ ?>
                      <option value="<?php echo $d['id_per']; ?>"><?php echo $d['persona']; ?></option>
                      <?php } ?>
                  </select>
                  
                  <label>Seleccione Cargo</label>
                  <select id="pais_editar_anterior" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_pais = pg_query($conexion, "SELECT * FROM cargos WHERE estado = 'ACTIVO';");
                        $pais = pg_fetch_all($r_pais);
                      ?>
                      <?php foreach($pais as $c){ ?>
                      <option value="<?php echo $c['id_car']; ?>"><?php echo $c['car_descrip']; ?></option>
                      <?php } ?>
                  </select>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <i class="fas fa-minus btn-danger"></i>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <div class="modal-body">
                        <div id="detalle-persona">
                          <label>Ciudad: </label>
                          <label>Pais Codigo: </label>
                          <label>Descripcion Pais: </label>
                          <label>Gentilicio: </label>
                          <label>Estado: </label>
                        </div>
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
    <script src="funciones.js"></script>
    <?php include "../../mensaje.php";?>
  </body>
</html>