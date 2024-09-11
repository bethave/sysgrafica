$(function () {
  tabla_orden();  
});
function refrescar_select(){
    $(".select2").select2();
}
function tabla_orden(){
  $.ajax({
    type:"POST", url: "panel_orden.php", data: {filtro:""}
  }).done(function(datos){
    $("#panel-orden").html(datos);
    formato_tabla('#tabla_panel_orden');
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
function detalles(id_oc){
    $.ajax({
    type: "POST", url: "panel_detalle.php",
      data: {
          id_oc: id_oc
      }
    }).done(function(resultado){
        $("#panel-detalle").html(resultado);
        $(".select2").select2();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    panel_cabecera(id_oc);
    $("#btn-panel-detalle").click();
}
function panel_cabecera(id_oc){
    $.ajax({
    type: "POST", url: "panel_cabecera.php",
      data: {
          id_oc: id_oc
      }
    }).done(function(resultado){
        $("#panel-cabecera").html(resultado);
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}
function agregar(){
    $.ajax({
    type: "POST", url: "panel_cabecera.php",
      data: {
          id_oc: '0'
      }
    }).done(function(resultado){
        $("#panel-cabecera").html(resultado);
        $("#panel-detalle").html("SELECCIONE UNA CABECERA PARA VISUALIZAR LOS DETALLES");
        refrescar_select();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $("#btn-panel-cabecera").click();
}
function grabar_cabecera(){
    var caja_id;
    var aper_minicial;
    caja_id = $("#id_pro_cabecera").val();
    aper_minicial = $("#id_minicial_cabecera").val();
    //alert(con_pedido);
    if(aper_minicial!=""){
      $("#id_minicial_cabecera").removeClass("is-warning");
      $("#id_minicial_cabecera").val("");
    }else{
      mensaje('INGRESE MONTO','warning');
      $("#id_minicial_cabecera").select();
      $("#id_minicial_cabecera").addClass("is-warning");
    }
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_oc : '0', 
          aper_minicial: aper_minicial, 
          caja_id: caja_id, 
          operacion: '1'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
        tabla_orden();
      $("#btn-panel-orden").click();
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
function grabar_pedidos(id_oc){
    var id_ped;
    $(".check_pedido").each(function(index){
        if($(this).prop("checked")){
            id_ped = $(this).val();
            $.ajax({
            type: "POST", url: "grabar.php",
              data: {
                  id_oc : id_oc, 
                  id_pro: '0', 
                  con_pedido: 't', 
                  id_ped: id_ped, 
                  id_item: '0', 
                  cantidad: '0', 
                  operacion: '2'
              }
            }).done(function(resultado){
                mensaje(resultado,'success');
            }).fail(function(a,b,c){
              mensaje(c,'warning');
            });
        }
        tabla_orden();
        $("#btn-panel-orden").click();
    });
}
function agregar_detalle(id_oc){
    var id_item;
    var cantidad;
    var id_item = $("#id_item_detalle").val();
    var cantidad = $("#cantidad_detalle").val();
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
            id_oc : id_oc, 
            id_pro: '0', 
            con_pedido: 't', 
            id_ped: '0', 
            id_item: id_item, 
            cantidad: cantidad, 
            operacion: '5'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}


function eliminar_detalle(id_oc, id_item){
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
            id_oc : id_oc, 
            id_pro: '0', 
            con_pedido: 't', 
            id_ped: '0', 
            id_item: id_item, 
            cantidad: '0', 
            operacion: '7'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}
function grabar_confirmar(id_oc){
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_oc : id_oc, 
            id_pro: '0', 
            con_pedido: 't', 
            id_ped: '0', 
            id_item: '0', 
            cantidad: '0', 
            operacion: '3'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
        tabla_orden();
        $("#panel-cabecera").html("SELECCIONE UNA ACCIÓN");
        $("#panel-detalle").html("SELECCIONE UNA CABECERA PARA VISUALIZAR LOS DETALLES");
        $("#btn_cerrar_confirmar").click();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}

/*HASTA AHI NO MAS SE PUSO TODO BIEN*/



function editar_detalle(id_oc, aper_minicial){
    $("#btn-modal-editar-detalle").click();
    $("#cantidad_editar").val(aper_minicial);
    $("#id_ped_editar").val(id_oc);
}
function grabar_editar_detalle(){
    var id_oc = $("#id_ped_editar").val();
    var aper_minicial = $("#cantidad_editar").val();
    $("#btn_cerrar_editar_detalle").click();
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_oc : id_oc, 
          aper_minicial: aper_minicial, 
          caja_id: '0',  
          operacion: '5'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
        tabla_orden();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $.ajax({
    type: "POST", url: "panel_orden.php",
      data: { 
          id_oc : id_oc
      }
    }).done(function(resultado){
        $("#panel-orden").html(resultado);
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}

function insert(id_oc, aper_minicial){
    $("#btn-modal-insert").click();
    $("#cantidad_insert").val(aper_minicial);
    $("#id_ped_insert").val(id_oc);
}
function grabar_insert(){
    var id_oc = $("#id_ped_insert").val();
    var aper_minicial = $("#cantidad_insert").val();
    var caja_id = $("#caja_insert").val();
    $("#btn_cerrar_insert").click();
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_oc : id_oc, 
          aper_minicial: aper_minicial, 
          caja_id: caja_id,  
          operacion: '7'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
        tabla_orden();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $.ajax({
    type: "POST", url: "panel_orden.php",
      data: { 
          id_oc : id_oc
      }
    }).done(function(resultado){
        $("#panel-orden").html(resultado);
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}

function confirmar(id_ped){
    $("#btn-modal-confirmar").click();
    $("#id_ped_confirmar").val(id_ped);
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
function anular_cabecera(id_oc){
    $("#btn-modal-anular").click();
    $("#id_ped_anular").val(id_oc);
}
function grabar_anular(){
      var id_oc = $("#id_ped_anular").val();
    $("#btn_cerrar_anular").click();
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_oc : id_oc, 
          aper_minicial: '0', 
          caja_id: '0',  
          operacion: '3'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
        tabla_orden();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $.ajax({
    type: "POST", url: "panel_orden.php",
      data: { 
          id_oc : id_oc
      }
    }).done(function(resultado){
        $("#panel-orden").html(resultado);
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}
function imprimir(){
    var id_oc = $("#id_ped").val(id_oc);
    var caja_id = $("#caja_id").val(caja_id);
    window.open ("../../tcpdf/examples/example_apertura.php?codigo="+id_oc);
}