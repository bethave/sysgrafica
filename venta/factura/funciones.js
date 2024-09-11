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
    "iDisplayLength": 50,
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
    var fac_tipo;
    var fac_cuotas;
    var fac_intervalo;
    var cli_id;
    var con_presu;
    fac_tipo = $("#id_tipfac_cabecera").val();
    fac_cuotas = $("#id_cuota_cabecera").val();
    fac_intervalo = $("#id_inter_cabecera").val();
    cli_id = $("#id_pro_cabecera").val();
    if($("#con_presu_cabecera").prop('checked')){
        con_presu = 't';
    }else{
        con_presu = 'f';
    }
   
    //alert(con_pedido);
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_oc : '0', 
          fac_tipo: fac_tipo,
          fac_cuotas: fac_cuotas,
          con_presu: con_presu,
          cli_id: cli_id, 
          fac_intervalo : fac_intervalo,
          pre_cod: '0', 
          id_item: '0', 
          cantidad: '0', 
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
    var pre_cod;
    $(".check_pedido").each(function(index){
        if($(this).prop("checked")){
            pre_cod = $(this).val();
            $.ajax({
            type: "POST", url: "grabar.php",
              data: {
                    id_oc : id_oc, 
                    fac_tipo: '',
                    fac_cuotas: '0',
                    con_presu: 't',
                    cli_id: '0', 
                    fac_intervalo : '0',
                    pre_cod: pre_cod, 
                    id_item: '0', 
                    cantidad: '0', 
                    operacion: '2'
              }
            }).done(function(resultado){
                mensaje(resultado,'success');
                tabla_orden();
            }).fail(function(a,b,c){
              mensaje(c,'warning');
            });
            $.ajax({
            type: "POST", url: "panel_detalle.php",
                data: { 
                id_oc : id_oc
            }
            }).done(function(resultado){
               $("#panel-detalle").html(resultado);
            }).fail(function(a,b,c){
                mensaje(c,'warning');
            });
        }
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
                    fac_tipo: '',
                    fac_cuotas: '0',
                    con_presu: 't',
                    cli_id: '0', 
                    fac_intervalo : '0',
                    pre_cod: '0', 
                    id_item: id_item, 
                    cantidad: cantidad, 
                    operacion: '5'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
        tabla_orden();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $.ajax({
    type: "POST", url: "panel_detalle.php",
      data: { 
          id_oc : id_oc
      }
    }).done(function(resultado){
        $("#panel-detalle").html(resultado);
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}


function eliminar_detalle(id_oc, id_item){
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
                    id_oc : id_oc, 
                    fac_tipo: '',
                    fac_cuotas: '0',
                    con_presu: 't',
                    cli_id: '0', 
                    fac_intervalo : '0',
                    pre_cod: '0', 
                    id_item: id_item, 
                    cantidad: '0',
                    operacion: '7'
      }
    }).done(function(resultado){
        mensaje(resultado,'success');
        tabla_orden();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $.ajax({
    type: "POST", url: "panel_detalle.php",
      data: { 
          id_oc : id_oc
      }
    }).done(function(resultado){
        $("#panel-detalle").html(resultado);
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
}

function grabar_confirmar(id_oc){
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
                    id_oc : id_oc, 
                    fac_tipo: '',
                    fac_cuotas: '0',
                    con_presu: 't',
                    cli_id: '0', 
                    fac_intervalo : '0',
                    pre_cod: '0', 
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



function editar_detalle(id_oc, id_item, cantidad){
    $("#btn-modal-editar-detalle").click();
    $("#cantidad_editar").val(cantidad);
    $("#id_ped_editar").val(id_oc);
    $("#id_item_editar").val(id_item);
}
function grabar_editar_detalle(){
    var id_oc = $("#id_ped_editar").val();
    var id_item = $("#id_item_editar").val();
    var cantidad = $("#cantidad_editar").val();
    $("#btn_cerrar_editar_detalle").click();
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
                    id_oc : id_oc, 
                    fac_tipo: '',
                    fac_cuotas: '0',
                    con_presu: 't',
                    cli_id: '0', 
                    fac_intervalo : '0',
                    pre_cod: '0', 
                    id_item: id_item, 
                    cantidad: cantidad, 
                    operacion: '6'
      }
     }).done(function(resultado){
        mensaje(resultado,'success');
        tabla_orden();
    }).fail(function(a,b,c){
      mensaje(c,'warning');
    });
    $.ajax({
    type: "POST", url: "panel_detalle.php",
      data: { 
          id_oc : id_oc
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
                    fac_tipo: '',
                    fac_cuotas: '0',
                    con_presu: 't',
                    cli_id: '0', 
                    fac_intervalo : '0',
                    pre_cod: '0', 
                    id_item: '0', 
                    cantidad: '0',  
                    operacion: '4'
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
    var id_oc = $("#id_oc").val(id_oc);
    window.open ("../../tcpdf/examples/example_factura_venta.php?codigo="+id_oc);
}