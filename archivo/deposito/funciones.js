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
  $("#pais_agregar").select();
}
function editar(codigo, pais){
  $("#descripcion_editar").select();
  $("#codigo_editar").val(codigo);
  $("#pais_editar").val(pais);
  $("pais_anterior_editar").val(pais);
  $("#btn-modal-editar").click();
}
function inactivar(codigo){
  $("#codigo_inactivar").val(codigo);
  $("#pregunta_inactivar").html('¿ESTAS SEGURO DE INACTIVAR DEPOSITO');
  $("#btn-modal-inactivar").click();
}
function grabar(operacion){
  var codigo = '0';
  var pais = '0';
  var grabar = 'NO';
  if (operacion =='1'){
    var pais = $("#pais_agregar").val().trim();
    if(pais!=""){
       $("#pais_agregar").removeClass("is-warning");
      $("#btn_cerrar_agregar").click();
      $("#pais_agregar").val("");
      grabar = 'SI';
    }else{
       mensaje('INGRESE UNA DESCRIPCION','warning');
      $("#pais_agregar").select();
      $("#pais_agregar").addClass("is-warning");
    }
  }
  if(operacion =='2'){
    codigo = $("#codigo_editar").val();
    pais = $("#pais_editar_anterior").val().trim();
    if((pais!="") && (pais != $("#pais_anterior_editar").val())){
      $("#pais_editar").removeClass("is-warning");
      $("#btn_cerrar_editar").click();
      $("#pais_editar").val("");
      $("#pais_anterior_editar").val("");
      grabar = 'SI';
    }else{
      mensaje('INGRESE UNA NUEVA DESCRIPCION','warning');
      $("#pais_editar").select();
      $("#pais_editar").addClass("is-warning");
    }
  }
  if (operacion === '3'){
     codigo = $("#codigo_inactivar").val();
    $("#codigo_inactivar").val('');
    $("#btn_cerrar_inactivar").click();
    grabar = 'SI';
  }
  if(grabar === 'SI'){
    $.ajax({
      type: "POST", url: "grabar.php",
        data: {
            codigo: codigo,
            pais: pais,
            operacion: operacion
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
