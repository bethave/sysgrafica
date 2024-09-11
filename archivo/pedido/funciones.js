$(function () {
  tabla();  
});
function tabla(){
  $.ajax({
    type:"POST", url: "panel_pedido.php", data: {filtro:""}
  }).done(function(datos){
    $("#panel-pedido").html(datos);
    formato_tabla('#tabla_panel_pedido');
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
function detalles(id_ped){
    $.ajax({
    type: "POST", url: "panel_detalle.php",
      data: {
          id_ped: id_ped
      }
    }).done(function(resultado){
        $("#panel-detalle").html(resultado);
        $(".select2").select2();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $.ajax({
    type: "POST", url: "panel_cabecera.php",
      data: {
          id_ped: id_ped
      }
    }).done(function(resultado){
        $("#panel-cabecera").html(resultado);
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $("#btn-panel-detalle").click();
}
function agregar(){
    $.ajax({
    type: "POST", url: "panel_cabecera.php",
      data: {
          id_ped: '0'
      }
    }).done(function(resultado){
        $("#panel-cabecera").html(resultado);
        $("#panel-detalle").html("SELECCIONE UNA CABECERA PARA VISUALIZAR LOS DETALLES");
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $("#btn-panel-cabecera").click();
}
function grabar_cabecera(){
    var id_suc;
    id_suc = $("#id_suc_cabecera").val();
    //alert(id_suc);
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_suc: id_suc, 
          id_ped : '0', 
          id_item: '0', 
          cantidad: '0', 
          operacion: '1'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
        tabla();
      $("#btn-panel-pedido").click();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}
function cancelar_cabecera(){
    $("#panel-cabecera").html("SELECCIONE UNA ACCIÓN");
    $("#panel-detalle").html("SELECCIONE UNA CABECERA PARA VISUALIZAR LOS DETALLES");
    $("#btn-panel-pedido").click();
    mensaje('SE CANCELÓ LA OPERACIÓN','error');
}
function agregar_detalle(){
    var id_ped;
    var id_item;
    var cantidad;
    var id_ped = $("#id_ped_detalle").val();
    var id_item = $("#id_item_detalle").val();
    var cantidad = $("#cantidad_detalle").val();
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_suc: '0', 
          id_ped : id_ped, 
          id_item: id_item, 
          cantidad: cantidad, 
          operacion: '4'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
        tabla();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $.ajax({
    type: "POST", url: "panel_detalle.php",
      data: { 
          id_ped : id_ped
      }
    }).done(function(resultado){
        $("#panel-detalle").html(resultado);
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}
function eliminar_detalle(id_ped, id_item){
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_suc: '0', 
          id_ped : id_ped, 
          id_item: id_item, 
          cantidad: '0', 
          operacion: '6'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
        tabla();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $.ajax({
    type: "POST", url: "panel_detalle.php",
      data: { 
          id_ped : id_ped
      }
    }).done(function(resultado){
        $("#panel-detalle").html(resultado);
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}
function editar_detalle(id_ped, id_item, cantidad){
    $("#btn-modal-editar-detalle").click();
    $("#cantidad_editar").val(cantidad);
    $("#id_ped_editar").val(id_ped);
    $("#id_item_editar").val(id_item);
}
function grabar_editar_detalle(){
    var id_ped = $("#id_ped_editar").val();
    var id_item = $("#id_item_editar").val();
    var cantidad = $("#cantidad_editar").val();
    $("#btn_cerrar_editar_detalle").click();
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_suc: '0', 
          id_ped : id_ped, 
          id_item: id_item, 
          cantidad: cantidad, 
          operacion: '5'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
        tabla();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $.ajax({
    type: "POST", url: "panel_detalle.php",
      data: { 
          id_ped : id_ped
      }
    }).done(function(resultado){
        $("#panel-detalle").html(resultado);
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}
function confirmar(id_ped){
    $("#btn-modal-confirmar").click();
    $("#id_ped_confirmar").val(id_ped);
}
function grabar_confirmar(){
    var id_ped = $("#id_ped_confirmar").val();
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_suc: '0', 
          id_ped : id_ped, 
          id_item: '0', 
          cantidad: '0', 
          operacion: '2'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
        tabla();
        $("#panel-cabecera").html("SELECCIONE UNA ACCIÓN");
        $("#panel-detalle").html("SELECCIONE UNA CABECERA PARA VISUALIZAR LOS DETALLES");
        $("#btn_cerrar_confirmar").click();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}
function marcar1(){
    $("#grupo3").select();
    $("#grupo3").click();
}
function habilitar_campo(codigo){
   // alert();
    $("#campo" + codigo).removeAttr("disabled","disabled");
    $("#campo" + codigo).val("YA ESTA HABILITADO");
}
function deshabilitar_campo(codigo){
 //   alert();
    $("#campo" + codigo).attr("disabled","disabled");
    $("#campo" + codigo).val("YA ESTA DESHABILITADO");
}
function comprobar(valor){
    
}

function verificar(){
    var marcado = '{{0,0}';
    $(".detalle").each(function(index){
        if($(this).prop('checked')){
            marcado = marcado + ',{' + $(this).val() + ',' + $(this).val() + '}';
        }else{
            //marcado = 'NO';
        }
    });
    marcado = marcado + '}'
    alert(marcado);
}