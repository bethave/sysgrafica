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
function agregar(){
  $("#descripcion_agregar").select();
  $("#marca_agregar").select();
  $("#ti_agregar").select();
  $("#tpi_agregar").select();
  $("#compra_agregar").select();
  $("#venta_agregar").select();
  $("#um_agregar").select();
  $("#proce_agregar").select();
  $("#img_agregar").select();
}
function editar(codigo,descripcion, marca, ti, tpi, compra, venta, um, proce, img){
  $("#pais_editar").select();
  $("#codigo_editar").val(codigo);
  $("#descripcion_editar").val(descripcion);
  $("descripcion_anterior_editar").val(descripcion);
  $("#marca_editar").val(marca);
  $("marca_anterior_editar").val(marca);
  $("#ti_editar").val(ti);
  $("ti_anterior_editar").val(ti);
  $("#tpi_editar").val(tpi);
  $("tpi_anterior_editar").val(tpi);
  $("#compra_editar").val(compra);
  $("compra_anterior_editar").val(compra);
  $("#venta_editar").val(venta);
  $("venta_anterior_editar").val(venta);
  $("#um_editar").val(um);
  $("um_anterior_editar").val(um);
  $("#proce_editar").val(proce);
  $("proce_anterior_editar").val(proce);
  $("#img_editar").val(img);
  $("img_anterior_editar").val(img);
  $("#btn-modal-editar").click();
  }
function inactivar(codigo){
  $("#codigo_inactivar").val(codigo);
  $("#pregunta_inactivar").html('¿ESTAS SEGURO DE ANULAR?');
  $("#btn-modal-inactivar").click();
}
function grabar(operacion){
  var codigo = '0';
  var descripcion = '';
  var marca = '0';
  var ti = '0';
  var tpi = '0';
  var compra = '';
  var venta = '';
  var um = '0';
  var proce = '0';
  var img = '';
  var grabar = 'NO';
  if (operacion =='1'){
    var descripcion = $("#descripcion_agregar").val().trim();
    var marca = $("#marca_agregar").val().trim();
    var ti = $("#ti_agregar").val().trim();
    var tpi = $("#tpi_agregar").val().trim();
    var compra = $("#compra_agregar").val().trim();
    var venta = $("#venta_agregar").val().trim();
    var um = $("#um_agregar").val().trim();
    var proce = $("#proce_agregar").val().trim();
    var img = $("#img_agregar").val().trim();
    if(descripcion!='' && marca!='' && ti!='' && tpi!='' && compra!='' && venta!='' && um!='' && proce!='' && img!=''){
      $("#descripcion_agregar").removeClass("is-warning");
      $("#marca_agregar").removeClass("is-warning");
      $("#ti_agregar").removeClass("is-warning");
      $("#tpi_agregar").removeClass("is-warning");
      $("#compra_agregar").removeClass("is-warning");
      $("#venta_agregar").removeClass("is-warning");
      $("#um_agregar").removeClass("is-warning");
      $("#proce_agregar").removeClass("is-warning");
      $("#btn_cerrar_agregar").click();
      $("#descripcion_agregar").val("");
      $("#marca_agregar").val("");
      $("#ti_agregar").val("");
      $("#tpi_agregar").val("");
      $("#compra_agregar").val("");
      $("#venta_agregar").val("");
      $("#um_agregar").val("");
      $("#proce_agregar").val("");
      grabar = 'SI';
    }else{
       mensaje('INGRESE UNA DESCRIPCION','warning');
    }
  }
  
    if(operacion=='2'){
    codigo = $("#codigo_editar").val();
    descripcion = $("#descripcion_editar").val().trim();
    marca = $("#marca_editar").val().trim();
    ti = $("#ti_editar").val().trim();
    tpi = $("#tpi_editar").val().trim();
    compra = $("#compra_editar").val().trim();
    venta = $("#venta_editar").val().trim();
    um = $("#um_editar").val().trim();
    proce = $("#proce_editar").val().trim();
    img = $("#img_editar").val().trim();
    if((descripcion!="") && (descripcion != $("#descripcion_anterior_editar").val()) 
            ){
      $("#descripcion_editar").removeClass("is-warning");
      
      $("#btn_cerrar_editar").click();
      $("#descripcion_editar").val("");
      
      $("#descripcion_anterior_editar").val("");
     
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
      type: "POST", url: "grabar.php",
        data: {
            codigo: codigo,
            marca: marca,
            tpi: tpi,
            ti: ti,
            descripcion: descripcion,
            compra: compra,
            venta: venta,
            um: um,
            proce: proce,
            img : img,
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
