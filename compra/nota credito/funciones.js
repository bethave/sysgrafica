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
    var cred_tipo;
    var cred_motivo;
    var cred_timnro;
    var con_fac;
    var id_pro;
    var cred_timvto;
    var cred_nro;
    var porcentaje;
    id_pro = $("#id_pro_cabecera").val();
    cred_motivo = $("#id_mot_cabecera").val();
    cred_tipo = $("#id_tipo_cabecera").val();
    cred_timnro = $("#id_timbrado_cabecera").val();
    cred_timvto = $("#id_timvto_cabecera").val();
    cred_nro = $("#id_cred_nro_cabecera").val();
    porcentaje = $("#id_porc_cabecera").val();
    if($("#con_pedido_cabecera").prop('checked')){
        con_fac = 't';
    }else{
        con_fac = 'f';
    }
    
    //alert(con_pedido);
    $.ajax({
    type: "POST", url: "grabar.php",
      data: {
          id_oc : '0', 
          cred_tipo : cred_tipo,
          cred_motivo : cred_motivo,
          cred_timnro : cred_timnro,
          cred_timvto : cred_timvto,
          con_fac : con_fac,
          id_pro : id_pro,
          cred_nro : cred_nro,
          porcentaje: porcentaje,
          fac_cod : '0',
          id_item : '0',
          cantidad : '0',
          operacion : '1',
          
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
    var fac_cod;
    $(".check_pedido").each(function(index){
        if($(this).prop("checked")){
            fac_cod = $(this).val();
            $.ajax({
            type: "POST", url: "grabar.php",
              data: {
                    id_oc : id_oc, 
                    cred_tipo : '',
                    cred_motivo : '',
                    cred_timnro : '0',
                    cred_timvto : '2021-11-28',
                    con_fac : 't',
                    id_pro : '0',
                    cred_nro : '',
                    porcentaje: '0',
                    fac_cod : fac_cod,
                    id_item : '0',
                    cantidad : '0',
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
            cred_tipo : '0',
            cred_motivo : '0',
            cred_timnro : '0',
            con_fac : 't',
            id_pro : '0',
            fac_cod : '0',
            id_item : id_item,
            cantidad : cantidad, 
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
            cred_tipo : '0',
            cred_motivo : '0',
            cred_timnro : '0',
            con_fac : 't',
            id_pro : '0',
            fac_cod : '0',
            id_item : id_item,
            cantidad : '0', 
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
            cred_tipo : '',
            cred_motivo : '',
            cred_timnro : '0',
            cred_timvto : '2021-11-28',
            con_fac : 't',
            id_pro : '0',
            cred_nro : '',
            porcentaje: '0',
            fac_cod : '0',
            id_item : '0',
            cantidad : '0', 
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
          cred_tipo : '0',
          cred_motivo : '0',
          cred_timnro : '0',
          con_fac : 't',
          id_pro : '0',
          fac_cod : '0',
          id_item : id_item,
          cantidad : cantidad,  
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
function confirmar(id_fac){
    $("#btn-modal-confirmar").click();
    $("#id_ped_confirmar").val(id_fac);
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
            cred_tipo : '',
            cred_motivo : '',
            cred_timnro : '0',
            cred_timvto : '2021-11-28',
            con_fac : 't',
            id_pro : '0',
            cred_nro : '',
            porcentaje: '0',
            fac_cod : '0',
            id_item : '0',
            cantidad : '0', 
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
