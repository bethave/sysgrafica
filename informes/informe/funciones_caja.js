$(function () {
  tabla();
});
function tabla(){
    var descripcion;
  $.ajax({
    type:"POST", url: "datos_caja.php", filter: {filtro:descripcion}
  }).done(function(datos){
    $("#div_tabla").html(datos);
    formato_tabla('#tabla_cargos');
  });
}
function formato_tabla(tabla){
  $(tabla).DataTable({
    "lengthChange": false,
    responsive: "true",
    "iDisplayLength": 14,
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
function inactivar(codigo, descripcion){
  $("#codigo_inactivar").val(codigo);
  $("#pregunta_inactivar").html('¿ESTAS SEGURO DE ANULAR <b>' + descripcion + '</b>?');
  $("#btn-modal-inactivar").click();
}
function grabar(operacion){
  var codigo = '0';
  var descripcion = '';
  var grabar = 'NO';
  
  if(operacion=='1'){
    codigo = $("#desde_agregar").val();
    $("#has_agregar").val('');
    $("btn_cerrar_agregar").click();
    grabar = 'SI';
  }
  if(grabar == 'SI'){
    $.ajax({
      type: "POST", url: "grabar.php", data: {codigo:codigo, caja_id:caja_id, operacion:operacion}
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
