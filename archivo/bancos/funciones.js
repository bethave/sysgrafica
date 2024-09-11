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
  $("#descripcion_agregar").select();
  $("#tel_agregar").select();
  $("#email_agregar").select();
  $("#direc_agregar").select();
}
function editar(codigo, descripcion, tel, email, direc){
  $("#descripcion_editar").select();
  $("#tel_editar").select();
  $("#email_editar").select();
  $("#direc_editar").select();
  $("#codigo_editar").val(codigo);
  $("#descripcion_editar").val(descripcion);
  $("#tel_editar").val(tel);
  $("#email_editar").val(email);
  $("#direc_editar").val(direc);
  $("#descripcion_anterior_editar").val(descripcion);
  $("#btn-modal-editar").click();
  $("#tel_anterior_editar").val(tel);
  $("#btn-modal-editar").click();
  $("#email_anterior_editar").val(email);
  $("#btn-modal-editar").click();
  $("#direc_anterior_editar").val(direc);
  $("#btn-modal-editar").click();
}
function inactivar(codigo, descripcion){
  $("#codigo_inactivar").val(codigo);
  $("#pregunta_inactivar").html('¿ESTAS SEGURO DE ANULAR <b>' + descripcion + '</b>?');
  $("#btn-modal-inactivar").click();
}
function grabar(operacion){
  var codigo = '0';
  var descripcion = '';
  var tel = '';
  var email = '';
  var direc = '';
  var grabar = 'NO';
  if(operacion=='1'){ //AGREGAR
   var descripcion = $("#descripcion_agregar").val().trim();
   var tel = $("#tel_agregar").val().trim();
   var email = $("#email_agregar").val().trim();
   var direc = $("#direc_agregar").val().trim();
    if(descripcion!="" && tel!="" && email!="" && direc!=""){
      $("#descripcion_agregar").removeClass("is-warning");
      $("#tel_agregar").removeClass("is-warning");
      $("#email_agregar").removeClass("is-warning");
      $("#direc_agregar").removeClass("is-warning");
      $("#btn_cerrar_agregar").click();
      $("#descripcion_agregar").val("");
      $("#tel_agregar").val("");
      $("#email_agregar").val("");
      $("#direc_agregar").val("");  
    }else{
      mensaje('INGRESE DATOS','warning');
      $("#descripcion_agregar").select();
      $("#descripcion_agregar").addClass("is-warning");
      $("#tel_agregar").select();
      $("#tel_agregar").addClass("is-warning");
       $("#email_agregar").select();
      $("#email_agregar").addClass("is-warning");
       $("#direc_agregar").select();
      $("#direc_agregar").addClass("is-warning");
    }if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(email)){
        grabar = 'SI';
        } else {
        mensaje('La dirección de email es incorrecta!','warning');
        grabar = 'NO';
  }
}
  
  if(operacion =='2'){
    codigo = $("#codigo_editar").val();
    descripcion = $("#descripcion_editar").val().trim();
    tel = $("#tel_editar").val().trim();
    email = $("#email_editar").val().trim();
    direc = $("#direc_editar").val().trim();
    if((descripcion!="") && (descripcion != $("#descripcion_anterior_editar").val())){
      $("#descripcion_editar").removeClass("is-warning");
      $("#descripcion_editar").val("");
      $("#descripcion_anterior_editar").val("");
      $("#btn_cerrar_editar").click();
      grabar = 'SI';
    }else{
      mensaje('MODIFIQUE DATOS CORRESPONDIENTES','warning');
      $("#descripcion_editar").select();
      $("#descripcion_editar").addClass("is-warning");
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
          descripcion:descripcion, 
          tel:tel,
          email:email,
          direc:direc,
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
function validarEmail(email) {
  
}

 

