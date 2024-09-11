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
  $("#descripcion_agregar").select();
}
function editar(codigo, descripcion){
  $("#descripcion_editar").select();
  $("#codigo_editar").val(codigo);
  $("#descripcion_editar").val(descripcion);
  $("#descripcion_anterior_editar").val(descripcion);
  $("#btn-modal-editar").click();
}
function activar(codigo, descripcion){
  $("#codigo_activar").val(codigo);
  $("#pregunta_activar").html('¿ESTAS SEGURO DE ACTIVAR <b>' + descripcion + '</b>?');
  $("#btn-modal-activar").click();
}
function inactivar(codigo, descripcion){
  $("#codigo_inactivar").val(codigo);
  $("#pregunta_inactivar").html('¿ESTAS SEGURO DE INACTIVAR <b>' + descripcion + '</b>?');
  $("#btn-modal-inactivar").click();
}
function grabar(operacion){
  var codigo = '0';
  var descripcion = '';
  var grabar = 'NO';
  if(operacion=='1'){ //AGREGAR
   var descripcion = $("#descripcion_agregar").val().trim();
    if(descripcion!=""){
      $("#descripcion_agregar").removeClass("is-warning");
      $("#btn_cerrar_agregar").click();
      $("#descripcion_agregar").val("");
      grabar = 'SI';
    }else{
      mensaje('INGRESE UNA DESCRIPCION','warning');
      $("#descripcion_agregar").select();
      $("#descripcion_agregar").addClass("is-warning");
    }
  }
  if(operacion=='2'){
    codigo = $("#codigo_editar").val();
    descripcion = $("#descripcion_editar").val().trim();
    if((descripcion!="") && (descripcion != $("#descripcion_anterior_editar").val())){
      $("#descripcion_editar").removeClass("is-warning");
      $("#btn_cerrar_editar").click();
      $("#descripcion_editar").val("");
      $("#descripcion_anterior_editar").val("");
      grabar = 'SI';
    }else{
      mensaje('INGRESE UNA NUEVA DESCRIPCION','warning');
      $("#descripcion_editar").select();
      $("#descripcion_editar").addClass("is-warning");
    }
  }
  if(operacion=='3'){
    codigo = $("#codigo_activar").val();
    $("#codigo_activar").val('');
    $("#btn_cerrar_activar").click();
    grabar = 'SI';
  }
  if(operacion=='4'){
    codigo = $("#codigo_inactivar").val();
    $("#codigo_inactivar").val('');
    $("#btn_cerrar_inactivar").click();
    grabar = 'SI';
  }
  if(grabar == 'SI'){
    $.ajax({
      type: "POST", url: "grabar.php", data: {codigo:codigo, descripcion:descripcion, operacion:operacion}
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