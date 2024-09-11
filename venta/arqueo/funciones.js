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
    var aper_cod;
    aper_cod = $("#id_aper_cabecera").val();
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_oc : '0', 
          aper_cod : aper_cod,
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



function editar_detalle(id_oc, cie_totalefectivo, cie_totalcheque, cie_totaltarjeta, cie_faltante, cie_sobrante){
    $("#btn-modal-editar-detalle").click();
    $("#efectivo_editar").val(cie_totalefectivo);
    $("#cheque_editar").val(cie_totalcheque);
    $("#tarjeta_editar").val(cie_totaltarjeta);
    $("#faltante_editar").val(cie_faltante);
    $("#sobrante_editar").val(cie_sobrante);
    $("#id_ped_editar").val(id_oc);
}
function grabar_editar_detalle(){
    var id_oc = $("#id_ped_editar").val();
    var cie_totalefectivo = $("#efectivo_editar").val();
    var cie_totalcheque = $("#cheque_editar").val();
    var cie_totaltarjeta = $("#tarjeta_editar").val();
    var cie_faltante = $("#faltante_editar").val();
    var cie_sobrante = $("#sobrante_editar").val();
    $("#btn_cerrar_editar_detalle").click();
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_oc : id_oc, 
          cie_totalefectivo : cie_totalefectivo,
          cie_totalcheque : cie_totalcheque,
          cie_totaltarjeta : cie_totaltarjeta,
          cie_faltante : cie_faltante,
          cie_sobrante : cie_sobrante,
          den_cod : '0',  
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
     var id_oc;
    id_oc = $("#id_ped_anular").val();
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
        $("#panel-cabecera").html("SELECCIONE UNA ACCIÓN");
        $("#panel-detalle").html("SELECCIONE UNA CABECERA PARA VISUALIZAR LOS DETALLES");
        $("#btn_cerrar_anular").click();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}
function imprimir(){
    var id_oc = $("#id_ped").val(id_oc);
    var aper_cod = $("#aper_cod").val(aper_cod);
    window.open ("../../tcpdf/examples/example_cierre.php?codigo="+id_oc);
}