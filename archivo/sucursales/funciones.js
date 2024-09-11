/* global is_numeric */

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
    "iDisplayLength": 4,
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
  $("#descripcion_agregar").select();
  $("#email_agregar").select();
  $("#celular_agregar").select();
  $("#direc_agregar").select();
  $("#ubi_agregar").select();
  $("#imagen_agregar").select();
}
function editar(codigo, ruc, descripcion, email, celular, direc, ubi, imagen){
  $("#ruc_editar").select();
  $("#descripcion_editar").select();
  $("#email_editar").select();
  $("#celular_editar").select();
  $("#direc_editar").select();
  $("#ubi_editar").select();
  $("#imagen_editar").select();
  $("#codigo_editar").val(codigo);
  $("#ruc_editar").val(ruc);
  $("#descripcion_editar").val(descripcion);
  $("#email_editar").val(email);
  $("#celular_editar").val(celular);
  $("#direc_editar").val(direc);
  $("#ubi_editar").val(ubi);
  $("#imagen_editar").val(imagen);
  $("#ruc_anterior_editar").val(ruc);
  $("#btn-modal-editar").click();
  $("#descripcion_anterior_editar").val(descripcion);
  $("#btn-modal-editar").click();
  $("#email_anterior_editar").val(email);
  $("#btn-modal-editar").click();
  $("#celular_anterior_editar").val(celular);
  $("#btn-modal-editar").click();
  $("#direc_anterior_editar").val(direc);
  $("#btn-modal-editar").click();
  $("#ubi_anterior_editar").val(ubi);
  $("#btn-modal-editar").click();
  $("#imagen_anterior_editar").val(imagen);
  $("#btn-modal-editar").click();
}
function inactivar(codigo, descripcion){
  $("#codigo_inactivar").val(codigo);
  $("#pregunta_inactivar").html('¿ESTAS SEGURO DE ANULAR <b>' + descripcion + '</b>?');
  $("#btn-modal-inactivar").click();
}
function grabar(operacion){
  var codigo = '0';
  var ruc = '';
  var descripcion = '';
  var email = '';
  var celular = '';
  var direc = '';
  var ubi = '';
  var imagen = '';
  var grabar = 'NO';
  if(operacion=='1'){ //AGREGAR
   var ruc = $("#ruc_agregar").val().trim();
   var descripcion = $("#descripcion_agregar").val().trim();
   var email = $("#email_agregar").val().trim();
   var celular = $("#celular_agregar").val().trim();
   var direc = $("#direc_agregar").val().trim();
   var ubi = $("#ubi_agregar").val().trim();
   var imagen = $("#imagen_agregar").val().trim();
    if(ruc!="" && descripcion!="" && email!="" && celular!="" && direc!="" && ubi!="" && imagen!=""){
      $("#descripcion_agregar").removeClass("is-warning");
      $("#email_agregar").removeClass("is-warning");
      $("#celular_agregar").removeClass("is-warning");
      $("#direc_agregar").removeClass("is-warning");
      $("#ubi_agregar").removeClass("is-warning");
      $("#imagen_agregar").removeClass("is-warning");
      $("#btn_cerrar_agregar").click();
      $("#ruc_agregar").val("");
      $("#descripcion_agregar").val("");
      $("#email_agregar").val("");
      $("#celular_agregar").val("");
      $("#direc_agregar").val("");
      $("#ubi_agregar").val("");
      $("#imagen_agregar").val("");
      grabar = 'SI';
    }else{
      mensaje('INGRESE DATOS','warning');
    }if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(email)){
        grabar = 'SI';
        } else {
        mensaje('La dirección de email es incorrecta!','warning');
        grabar = 'NO';
  }
    }
  
  if(operacion=='2'){
    codigo = $("#codigo_editar").val();
    ruc = $("#ruc_editar").val().trim();
    descripcion = $("#descripcion_editar").val().trim();
    email = $("#email_editar").val().trim();
    celular = $("#celular_editar").val().trim();
    direc = $("#direc_editar").val().trim();
    ubi = $("#ubi_editar").val().trim();
    imagen = $("#imagen_editar").val().trim();
    if((descripcion!="") && (descripcion != $("#descripcion_anterior_editar").val()) 
            ){
      $("#ruc_editar").removeClass("is-warning");
      $("#descripcion_editar").removeClass("is-warning");
      $("#email_editar").removeClass("is-warning");
      $("#celular_editar").removeClass("is-warning");
      $("#direc_editar").removeClass("is-warning");
      $("#ubi_editar").removeClass("is-warning");
      $("#imagen_editar").removeClass("is-warning");
      
      $("#btn_cerrar_editar").click();
      
      $("#ruc_editar").val("");
      $("#descripcion_editar").val("");
      $("#email_editar").val("");
      $("#celular_editar").val("");
      $("#direc_editar").val("");
      $("#ubi_editar").val("");
      $("#imagen_editar").val("");
      $("#ruc_anterior_editar").val("");
      $("#descripcion_anterior_editar").val("");
      $("#email_anterior_editar").val("");
      $("#celular_anterior_editar").val("");
      $("#direc_anterior_editar").val("");
      $("#ubi_anterior_editar").val("");
      $("#imagen_anterior_editar").val("");
      grabar = 'SI';
    }else{
      mensaje('FAVOR MODIFICAR LOS DATOS','warning');
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
          codigo:codigo, 
          ruc:ruc, 
          descripcion:descripcion, 
          email:email,
          celular:celular,
          direc:direc,
          ubi:ubi,
          imagen:imagen,
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