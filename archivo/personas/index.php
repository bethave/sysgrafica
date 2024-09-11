<?php
  include "../../conexion.php";
  include "../../session.php";
  $_SESSION['id_pag'] = '4';
  include "../../permiso.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KAMBA FERRETERIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/sysgrafica/iconos/kamba1.ico" type="image/x-icon">
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
                <h1 class="m-0 text-dark">PERSONAS</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active">ARCHIVO</li>
                  <li class="breadcrumb-item active">PERSONAS</li>
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
                  <input class="form-control" type="text" id="ruc_agregar" placeholder="CI o RUC"><br>
                  <input class="form-control" type="text" id="nombre_agregar" placeholder="Nombre"><br>
                  <input class="form-control" type="text" id="apellido_agregar" placeholder="Apellido"><br>
                  <input class="form-control" type="text" id="celular_agregar" placeholder="Celular"><br>
                  <input class="form-control" type="text" id="email_agregar" placeholder="Correo"><br>
                  <input class="form-control" type="text" id="direc_agregar" placeholder="Direccion"><br>
                  <label>Seleccione una Ciudad</label>
                  <select id="ciudad_agregar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_ciudades = pg_query($conexion, "SELECT * FROM v_ciudades WHERE estado = 'ACTIVO';");
                        $ciudades = pg_fetch_all($r_ciudades);
                      ?>
                      <?php foreach($ciudades as $c){ ?>
                      <option value="<?php echo $c['id_ciu']; ?>"><?php echo $c['ciu_descrip']." (".$c['pais'].")";?></option>
                      <?php } ?>
                  </select>
                  <label>Seleccione el Género</label>
                  <select id="genero_agregar" class="form-control select2">
                      <?php $r_generos = pg_query($conexion, "SELECT * FROM generos WHERE estado = 'ACTIVO';");
                        $generos = pg_fetch_all($r_generos);
                      ?>
                      <?php foreach($generos as $g){ ?>
                      <option value="<?php echo $g['id_gen']; ?>"><?php echo $g['gen_descrip']; ?></option>
                      <?php } ?>
                  </select>
                  <label>Seleccione el Tipo de Persona</label>
                  <select id="tipo_agregar" class="form-control select2">
                      <?php $r_tipo_persona = pg_query($conexion, "SELECT * FROM tipos_personas WHERE estado = 'ACTIVO';");
                        $tipo_persona = pg_fetch_all($r_tipo_persona);
                      ?>
                      <?php foreach($tipo_persona as $tp){ ?>
                      <option value="<?php echo $tp['id_tper']; ?>"><?php echo $tp['tper_descrip']; ?></option>
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
                  <h4 class="modal-title">MODIFICAR</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <lable>RUC</lable>
                    <input class="form-control" type="text" id="ruc_editar" value="" autofocus="true">
                    <input type="hidden" id="ruc_anterior_editar" value="">
                    <lable>Nombre</lable>
                    <input class="form-control" type="text" id="nombre_editar" value="" autofocus="true">
                    <input type="hidden" id="nombre_anterior_editar" value="">
                    <lable>Apellido</lable>
                    <input class="form-control" type="text" id="apellido_editar" value="" autofocus="true">
                    <input type="hidden" id="apellido_anterior_editar" value="">
                    <lable>Celular</lable>
                    <input class="form-control" type="text" id="celular_editar" value="" autofocus="true">
                    <input type="hidden" id="celular_anterior_editar" value="">
                    <lable>Email</lable>
                    <input class="form-control" type="text" id="email_editar" value="" autofocus="true">
                    <input type="hidden" id="email_anterior_editar" value="">
                    <lable>Dirección</lable>
                    <input class="form-control" type="text" id="direc_editar" value="" autofocus="true">
                    <input type="hidden" id="direc_anterior_editar" value="">
                    <label>Seleccione una Ciudad</label>
                  <select id="ciudad_agregar" class="form-control select2">
                      <?php $conexion = conexion::conectar();
                        $r_ciudades = pg_query($conexion, "SELECT * FROM v_ciudades WHERE estado = 'ACTIVO';");
                        $ciudades = pg_fetch_all($r_ciudades);
                      ?>
                      <?php foreach($ciudades as $c){ ?>
                      <option value="<?php echo $c['id_ciu']; ?>"><?php echo $c['ciu_descrip']." (".$c['pais'].")";?></option>
                      <?php } ?>
                  </select>
                  <label>Seleccione el Género</label>
                  <select id="genero_agregar" class="form-control select2">
                      <?php $r_generos = pg_query($conexion, "SELECT * FROM generos WHERE estado = 'ACTIVO';");
                        $generos = pg_fetch_all($r_generos);
                      ?>
                      <?php foreach($generos as $g){ ?>
                      <option value="<?php echo $g['id_gen']; ?>"><?php echo $g['gen_descrip']; ?></option>
                      <?php } ?>
                  </select>
                  <label>Seleccione el Tipo de Persona</label>
                  <select id="tipo_agregar" class="form-control select2">
                      <?php $r_tipo_persona = pg_query($conexion, "SELECT * FROM tipos_personas WHERE estado = 'ACTIVO';");
                        $tipo_persona = pg_fetch_all($r_tipo_persona);
                      ?>
                      <?php foreach($tipo_persona as $tp){ ?>
                      <option value="<?php echo $tp['id_tper']; ?>"><?php echo $tp['tper_descrip']; ?></option>
                      <?php } ?>
                  </select>
                    <input type="hidden" id="codigo_editar" value="">
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cerrar_editar">CERRAR</button>
                  <button type="button" class="btn btn-primary" onclick="grabar('2');">GRABAR</button>
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
                          <label>RUC: </label>
                          <label>Fecha de Nacimiento: </label>
                          <label>Numero de Celular: </label>
                          <label>Correo: </label>
                          <label>Direccion: </label>
                          <label>Ciudad: </label>
                          <label>Genero: </label>
                          <label>Pais: </label>
                          <label>Gentilicio: </label>
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
    <?php include "../../mensaje.php";?>
  </body>
</html>