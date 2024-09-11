$(function () {
  tabla();
});
function tabla(){
  $.ajax({
    type:"POST", url: "datos.php", data: {filtro:""}
  }).done(function(datos){
    $("#div_tabla").html(datos);
    formato_tabla('#tabla_cargos');
  });
}
function formato_tabla(tabla){
  $(tabla).DataTable({
    "lengthChange": false,
    responsive: "true",
    "iDisplayLength": 20,
      language: {
        "sSearch":"Buscar: ",
        "sInfo":"Mostrando resultados del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoFiltered": "(filtrado de entre _MAX_ registros)",
        "sZeroRecords":"No hay resultados",
        "sInfoEmpty":"No hay resultados",
        "oPaginate":{
        "sNext":"Siguiente",
        "sPrevious":"Anterior"
      }
    }
  });
}
function agregar(){
  $("#ruc_agregar").select();
  $("#nombre_agregar").select();
  $("#apellido_agregar").select();
  $("#celular_agregar").select();
  $("#email_agregar").select();
  $("#direc_agregar").select();
  $("#ciudad_agregar").select();
  $("#genero_agregar").select();
  $("#tipo_agregar").select();
}
function editar(codigo,per_ruc,per_nombre,per_apellido,per_celular,per_email,per_direccion,id_ciu,id_gen,id_tper){
  $("#ruc_editar").select();
  $("#codigo_editar").val(codigo);
  $("#ruc_editar").val(per_ruc);
  $("#ruc_anterior_editar").val(per_ruc);
  $("#nombre_editar").val(per_nombre);
  $("#nombre_anterior_editar").val(per_nombre);
  $("#apellido_editar").val(per_apellido);
  $("#apellido_anterior_editar").val(per_apellido);
  $("#celular_editar").val(per_celular);
  $("#celular_anterior_editar").val(per_celular);
  $("#email_editar").val(per_email);
  $("#email_anterior_editar").val(per_email);
  $("#direc_editar").val(per_direccion);
  $("#direc_anterior_editar").val(per_direccion);
  $("#ciudad_editar").val(id_ciu);
  $("#ciudad_anterior_editar").val(id_ciu);
  $("#genero_editar").val(id_gen);
  $("#genero_anterior_editar").val(id_gen);
  $("#tipo_editar").val(id_tper);
  $("#tipo_anterior_editar").val(id_tper);
  $("#btn-modal-editar").click();
}
function activar(codigo){
  $("#codigo_activar").val(codigo);
  $("#btn-modal-activar").click();
}
function inactivar(codigo){
  $("#codigo_inactivar").val(codigo);
  $("#pregunta_inactivar").html('¿ESTAS SEGURO DE ANULAR <b>');
  $("#btn-modal-inactivar").click();
}
function grabar(operacion){
  var codigo = '0';
  var per_ruc = '';
  var per_nombre = '';
  var per_apellido = '';
  var per_celular = '';
  var per_email = '';
  var per_direccion = '';
  var id_ciu = '0';
  var id_gen = '0';
  var id_tper = '0';
  var grabar = 'NO';
  if(operacion=='1'){ //AGREGAR
        var per_ruc = $("#ruc_agregar").val().trim();
        var per_nombre = $("#nombre_agregar").val().trim();
        var per_apellido = $("#apellido_agregar").val().trim();
        var per_celular = $("#celular_agregar").val().trim();
        var per_email = $("#email_agregar").val().trim();
        var per_direccion = $("#direc_agregar").val().trim();
        var id_ciu = $("#ciudad_agregar").val().trim();
        var id_gen = $("#genero_agregar").val().trim();
        var id_tper = $("#tipo_agregar").val().trim();
    if(per_nombre!="" && per_apellido!="" && per_ruc!=""){
      $("#nombre_agregar").removeClass("is-warning");
      $("#apellido_agregar").removeClass("is-warning");
      $("#ruc_agregar").removeClass("is-warning");
      $("#btn_cerrar_agregar").click();
      $("#nombre_agregar").val("");
      $("#apellido_agregar").val("");
      $("#ruc_agregar").val("");
      grabar = 'SI';
    }else{
      mensaje('INGRESE DATOS','warning');
      $("#nombre_agregar").select();
      $("#nombre_agregar").addClass("is-warning");
      $("#apellido_agregar").select();
      $("#apellido_agregar").addClass("is-warning");
      $("#ruc_agregar").select();
      $("#ruc_agregar").addClass("is-warning");
    }
}
  if(operacion =='2'){
    codigo = $("#codigo_editar").val();
    per_ruc = $("#ruc_editar").val().trim();
    per_nombre = $("#nombre_editar").val().trim();
    per_apellido = $("#apellido_editar").val().trim();
    per_celular = $("#celular_editar").val().trim();
    per_email = $("#email_editar").val().trim();
    per_direccion = $("#direc_editar").val().trim();
    id_ciu = $("#ciudad_editar").val().trim();
    id_gen = $("#genero_editar").val().trim();
    id_tper = $("#tipo_editar").val().trim();
    if((per_ruc!="") && (per_ruc != $("#ruc_anterior_editar").val())
                ){
      $("#ruc_editar").removeClass("is-warning");
      $("#nombre_editar").removeClass("is-warning");
      $("#apellido_editar").removeClass("is-warning");
      $("#celular_editar").removeClass("is-warning");
      $("#email_editar").removeClass("is-warning");
      $("#direc_editar").removeClass("is-warning");
      $("#ciudad_editar").removeClass("is-warning");
      $("#genero_editar").removeClass("is-warning");
      $("#tipo_editar").removeClass("is-warning");
      
      $("#btn_cerrar_editar").click();
      
      $("#ruc_editar").val("");
      $("#nombre_editar").val("");
      $("#apellido_editar").val("");
      $("#celular_editar").val("");
      $("#email_editar").val("");
      $("#direc_editar").val("");
      $("#ciudad_editar").val("");
      $("#genero_editar").val("");
      $("#tipo_editar").val("");
      
      $("#ruc_anterior_editar").val("");
      $("#nombre_anterior_editar").val("");
      $("#apellido_anterior_editar").val("");
      $("#celular_anterior_editar").val("");
      $("#email_anterior_editar").val("");
      $("#direc_anterior_editar").val("");
      $("#ciudad_anterior_editar").val("");
      $("#genero_anterior_editar").val("");
      $("#tipo_anterior_editar").val("");
      
      grabar = 'SI';
    }else{
      mensaje('MODIFIQUE DATOS CORRESPONDIENTES','warning');
    }
  }
  if(operacion=='3'){
    codigo = $("#codigo_inactivar").val();
    $("#codigo_inactivar").val('');
    $("#btn_cerrar_inactivar").click();
    grabar = 'SI';
  }
  if(grabar == 'SI'){
    $.ajax({
      type: "POST", url: "grabar.php", data: {
          codigo : codigo,
          per_ruc : per_ruc, 
          per_nombre : per_nombre,
          per_apellido : per_apellido,
          per_celular : per_celular,
          per_email : per_email,
          per_direccion : per_direccion,
          id_ciu : id_ciu,
          id_gen : id_gen,
          id_tper : id_tper,
          operacion:operacion
      }
    }).done(function(retorno){
      r = retorno.split('_/_');
      var texto = r[0];
      var tipo = r[1];
      if(tipo == 'error'){
        texto = texto.split('ERROR:');
        texto = texto[2];
      }
      if(tipo == 'success'){
        texto = texto.split('NOTICE:');
        texto = texto[1];
      }
      mensaje(texto,tipo);
      tabla();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
      
    });
  }
}

function detalles(codigo){
    $.ajax({
    type: "POST", url: "detalles.php",
      data: {
          codigo: codigo
      }
    }).done(function(resultado){
        $("#detalle-persona").html(resultado);
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $("#btn-modal-detalle").click();
}