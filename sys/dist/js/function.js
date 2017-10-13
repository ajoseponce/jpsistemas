var i=0;
function volver_listado(relacion){
 window.location.href = 'controlador.php?action='+relacion;
}
function volver_listado_relaciones(){
    window.location.href = 'controlador.php?action=lista_relaciones';
}
function volver_listado_productos(){
    window.location.href = 'controlador.php?action=lista_productos';
}
function guardar_datos(){
    $("#form_datos").submit();
}
function guardar_obito(){
    $("#form_obito").submit();
}
function guardar_garante(){
    $("#form_garante").submit();
}
function guardar_solicitante(){
    $("#form_solicitante").submit();
}
function guardar_producto(){

    $("#form_datos").submit();
}
function guardar_relacion(){
    if($("#id_persona").val()==''){
        alert("La Persona debe estar cargada");
        return false;
    }
    if($("#id_producto").val()==''){
        alert("Seleccione un producto por favor");
        return false;
    }
    $.ajax({
        url:           "controlador.php",
        data:          {action_js: "guardar_relacion",clientes: ""+$("#id_persona").val()+"",id_producto: ""+$("#id_producto").val()+"",fecha_inicio: ""+$("#fecha_inicio").val()+""},
        type: 'get',
        success:       function(data){
            alert('La actividad se relaciono al cliente correctamente');
            $("#form_datos").submit();
        }
    });
    //$("#form_datos").submit();
}
function autocomleteINI(id, path) {
    $('#suggest_' + id).autocomplete(
        { messages: { noResults: 'nadaaa', results: function() {} },
            source: function (request, response) {
                $.getJSON( path, { term: this.term }, response );
        }, minLength: 2,
            select: function (event, ui) {
                    // /console.log(ui); i
                    if (ui.item == null) {
                        $('#' + id).val('').trigger('clear');
                        $('#suggest_' + id).val('');
                    } else {
                        $('#' + id).val(ui.item.id).trigger('change');
                    }
                }
        }) ;
    }
function autocomleteINI_productos(id, path) {
    $('#suggest_' + id).autocomplete(
        { messages: { noResults: 'nadaaa', results: function() {} },
            source: function (request, response) {
                $.getJSON( path, { term: this.term }, response );
            }, minLength: 2,
            select: function (event, ui) {
                // /console.log(ui); i
                if (ui.item == null) {
                    $('#' + id).val('').trigger('clear');
                    $('#suggest_' + id).val('');
                } else {
                    //alert('hola'+ui.item.id);
                    $('#' + id).val(ui.item.id).trigger('change');
                    $("#id_producto").load('trae_productos.php?id_cliente='+ui.item.id);
                }
            }
        }) ;
}
function autocomleteINI_prestacion(id, path) {
    $('#suggest_' + id).autocomplete(
        { messages: { noResults: 'nadaaa', results: function() {} },
            source: function (request, response) {
                $.getJSON( path, { term: this.term }, response );
            }, minLength: 2,
            select: function (event, ui) {
                // /console.log(ui); i
                if (ui.item == null) {
                    $('#' + id).val('').trigger('clear');
                    $('#suggest_' + id).val('');
                } else {
                    //alert('hola'+ui.item.precio);
                    $('#' + id).val(ui.item.id).trigger('change');
                    $('#precio_' + id).val(ui.item.precio).trigger('change');
                    $('#costo_' + id).val(ui.item.costo).trigger('change');
                    $( "#cantidad" ).focus();

                }
            }
        }) ;
}

function agrega_carrito(){
  if($('#cantidad').val()==''){
    alert('Ingrese una cantidad');
    return false;
  }
  var producto=$('#suggest_productos').val();
  var id_producto=$('#productos').val();
  var unidad=$('#unidad_productos').val();
  var cantidad=$('#cantidad').val();
  var precio=$('#precio').val();
  v2=parseFloat(precio);
  precio=v2.toFixed(2)
  i++;
  $("#prestaciones_comprobante").append('<tr><td>'+producto+'<input name="producto_reserva['+i+']" id="producto_reserva_'+i+'" value="'+id_producto+'" type="hidden"/><input name="unidad['+i+']" id="unidad_'+i+'" value="'+unidad+'" type="hidden"/></td><td><input class="form-control" name="cantidad['+i+']" id="cantidad_'+i+'" value="'+cantidad+'" type="hidden"/><div id="cantidad_prod'+i+'">'+cantidad+'</div></td><td><div id="etiqueta_precio_'+i+'">'+precio+'</div><input type="hidden" name="precio['+i+']" id="precio_'+i+'" value="'+precio+'"/></td><td><button type="button" class="btn btn-danger btn-borrar-fila" onclick="resta('+i+')">x</button></td></tr>');
  $('#suggest_productos').val("");
  $('#productos').val("");
  $('#precio').val("");
  $('#cantidad').val("");
  $( "#suggest_productos" ).focus();

  v1=parseFloat($("#precio_aprox").val());
    // alert($("#precio_aprox").val());
  v2=parseFloat(precio);
  v3=v2+v1;
  $("#precio_aprox").val(v3.toFixed(2));
}

function resta(vale){
  v1=parseFloat($("#precio_aprox").val());
  var precio=$('#precio_'+vale).val();
  v2=parseFloat(precio);
  v3=v1-v2;
  $("#precio_aprox").val(v3.toFixed(2));
}
function autocomleteINI_prod_negocio(id, path) {
    $('#suggest_' + id).autocomplete(
        { messages: { noResults: 'nadaaa', results: function() {} },
            source: function (request, response) {
                $.getJSON( path, { term: this.term }, response );
            }, minLength: 2,
            select: function (event, ui) {
                // /console.log(ui); i
                if (ui.item == null) {
                    $('#' + id).val('').trigger('clear');
                    $('#suggest_' + id).val('');
                } else {
                    //alert('hola'+ui.item.id);
                    $('#' + id).val(ui.item.id).trigger('change');
                    i++;
                    var unidad_medida;
                    $("#prestaciones_comprobante").append('<tr><td>'+ui.item.label+'<input name="producto['+i+']" id="producto_'+i+'" value="'+ui.item.id+'" type="hidden"/></td><td><input class="form-control"  onchange="calculadora_precio('+i+')" name="cantidad['+i+']" id="cantidad_'+i+'" value="1"/></td><td><div id="etiqueta_precio_'+i+'">'+ui.item.precio+'</div><input type="hidden" name="precio['+i+']" id="precio_'+i+'" value="'+ui.item.precio+'"/></td><td><button type="button"  class="btn btn-danger btn-borrar-fila" >x</button></td></tr>');
                    $("#productos").attr("value", "");
                    $("#suggest_productos").attr("value", "");
                }
            }
        }) ;
}
function calculadora_precio(){
//alert($("#precio_"+value).val()*$("#cantidad_"+value).val());
if($("#unidad_productos").val()==1){
  var valor=($("#precio_productos").val()*$("#cantidad").val())/1000;
}
if($("#unidad_productos").val()==2){
  var valor=($("#precio_productos").val()/6)*$("#cantidad").val();
}
if($("#unidad_productos").val()==3){
  var valor=$("#precio_productos").val()*$("#cantidad").val();
}
if($("#unidad_productos").val()==4){
  var valor=($("#precio_productos").val()/12)*$("#cantidad").val();
}
$("#precio").val(valor);
//$("#etiqueta_precio").html(valor);
}
function autocomleteINI_datos(id, path) {
    $('#suggest_' + id).autocomplete(
        { messages: { noResults: 'nadaaa', results: function() {} },
            source: function (request, response) {
                $.getJSON( path, { term: this.term }, response );
            }, minLength: 2,
            select: function (event, ui) {
                // /console.log(ui); i
                if (ui.item == null) {
                    $('#' + id).val('').trigger('clear');
                    $('#suggest_' + id).val('');
                } else {
                    //alert('hola'+ui.item.id);
                    $('#' + id).val(ui.item.id).trigger('change');
                    $("#id_producto").load('trae_productos.php?id_cliente='+ui.item.id);
                }
            }
        }) ;
}
function autocomleteINI_coberturas(id, path) {
    $('#suggest_' + id).autocomplete(
        { messages: { noResults: 'No', results: function() {} },
            source: function (request, response) {
                $.getJSON( path, { term: this.term }, response );
            }, minLength: 2,
            select: function (event, ui) {
                // /console.log(ui); i
                if (ui.item == null) {
                    $('#' + id).val('').trigger('clear');
                    $('#suggest_' + id).val('');
                } else {
                    //alert('hola'+ui.item.id);
                    $('#' + id).val(ui.item.id).trigger('change');
                    $("#plan_cobertura").load('trae_plan_cobertura.php?id_cobertura='+ui.item.id);
                }
            }
        }) ;
}
// function autocomleteINI_prestacion(id, path) {
//     $('#suggest_' + id).autocomplete(
//         { messages: { noResults: 'No', results: function() {} },
//             source: function (request, response) {
//                 $.getJSON( path, { term: this.term }, response );
//             }, minLength: 2,
//             select: function (event, ui) {
//                 // /console.log(ui); i
//                 if (ui.item == null) {
//                     $('#' + id).val('').trigger('clear');
//                     $('#suggest_' + id).val('');
//                 } else {
//                     //alert('hola'+ui.item.id);
//                     $('#' + id).val(ui.item.id).trigger('change');
//                     $("#prestaciones_comprobante").append('<tr><td>'+ui.item.label+'</td><td>1</td><td>'+ui.item.precio+'</td><td><button type="button"  class="btn btn-danger btn-borrar-fila">x</button></td></tr>');
//                 }
//             }
//         }) ;
// }
function guardar_edicion_relacion(relacion){
    if($("#id_persona").val()==''){
        alert("La Persona debe estar cargada");
        return false;
    }
    if($("#id_producto_"+relacion).val()==''){
        alert("Seleccione un producto por favor");
        return false;
    }
    $.ajax({
        url:           "controlador.php",
        data:          {action_js: "guardar_relacion",clientes: ""+$("#id_persona").val()+"",id_relacion: ""+relacion+"",id_producto: ""+$("#id_producto_"+relacion).val()+"",fecha_inicio: ""+$("#fecha_inicio_"+relacion).val()+""},
        type: 'get',
        success:       function(data){
            alert('La actividad se edito correctamente');
            location.reload();
        }
    });
}
function edita_relacion(relacion) {
    $("#div_producto_"+relacion).hide();
    $("#div_fecha_"+relacion).hide();
    $("#div_action_"+relacion).hide();
    $("#div_producto_edita_"+relacion).show();
    $("#div_fecha_edita_"+relacion).show();
    $("#div_action_edita_"+relacion).show();
}
function guardar_pago() {

    if($("#clientes").val()==''){
        alert("El cliente no puede estar vacio");
        return false;
    }

    if($("#precio").val()==''){
        alert("El monto a pagar no puede estar vacio");
        return false;
    }
    if($("#periodo").val()==''){
        alert("El periodo a pagar no puede estar vacio");
        return false;
    }
    $.ajax({
        url:           "controlador.php",
            data:          {action_js: "guardar_pago",id_cliente: ""+$("#clientes").val()+"",id_producto: ""+$("#id_producto").val()+"",periodo: ""+$("#periodo").val()+"",monto: ""+$("#precio").val()+"",nota: ""+$("#nota").val()},
        dataType:      'json',
        type: 'get',
        success:       function(data) {

                $("#form_datos").html(data.mjs+" Comprobante numero:"+data.id_pago);


        }
    });
}
function trae_precio(id) {
    if($("#periodo").val()==''){
        alert("El periodo a pagar no puede estar vacio");
        return false;
    }
    $.ajax({
        url:           "controlador.php",
        data:          {action_js: "buscar_precio",clientes: ""+$("#clientes").val()+"",id_producto: ""+id+"",periodo: ""+$("#periodo").val()},
        dataType:      'json',
        type: 'get',
        success:       function(data){
            if(data.dias>0){
                $("#mjs_alert").html("Tiene "+data.dias+" dias de retraso. Intereses por dia "+data.intereses+" pesos.");
                $("#dias_retraso").val(data.dias);
                $("#monto_incremento").val(data.intereses);
            }else{
                $("#mjs_alert").html("");
                $("#dias_retraso").val(data.dias);
                $("#monto_incremento").val(data.intereses);
            }
            $("#precio").val(data.precio);
        }
    });
}
function trae_pago_periodo(periodo) {
    if($("#clientes").val()==''){
        alert("El cliente no puede estar vacio");
        return false;
    }
    $.ajax({
        url:           "controlador.php",
        data:          {action_js: "pagos_periodo",periodo: ""+periodo+"",cliente: ""+$("#clientes").val()},
        dataType:      'json',
        type: 'get',
        success:       function(data){
            if(data.cant_pagos==0){
                $("#graba").show();
            }else{
                $("#mjs_alert").html(data.cartel);
                $("#graba").hide();
            }

        }
    });
}
function cancelar() {
    $("#mjs_alert").html("");
    $("#graba").show();
    document.getElementById("periodo").selectedIndex="0";
    // /document.form_datos.periodo.selectedIndex="0";
}
function acepta_periodo() {
    $("#mjs_alert").html("");
    $("#graba").show();
    //document.getElementById("periodo").selectedIndex="0";
    // /document.form_datos.periodo.selectedIndex="0";
}
function trae_pagos(){
        var fecha_desde=$("#fecha_desde").val();
        var fecha_hasta=$("#fecha_hasta").val();
        var periodo=$("#periodo").val();
        $("#tabla_listado").load('trae_pagos.php?fecha_desde='+fecha_desde+'&fecha_hasta='+fecha_hasta+'&periodo='+periodo);

}
function trae_pagos_servicios(){
        var fecha_desde=$("#fecha_desde").val();
        var fecha_hasta=$("#fecha_hasta").val();
         var id_servicio='';
        $("#tabla_listado").load('trae_pagos_servicios.php?id_servicio='+id_servicio+'&fecha_desde='+fecha_desde+'&fecha_hasta='+fecha_hasta);

}
function trae_servicios(){
        var fecha_desde=$("#fecha_desde").val();
        var fecha_hasta=$("#fecha_hasta").val();
         var obito=$("#persona_obito").val();
        $("#tabla_listado").load('trae_servicios.php?fecha_desde='+fecha_desde+'&fecha_hasta='+fecha_hasta+'&obito='+obito);

}
function limpiar_filtro_lista_servicios(){
        ("#persona_obito").attr("");
        ("#suggest_persona_obito").attr("");
        trae_servicios();
}
// trae_servicios
function trae_turnos(){
//  alert('si bueno ');
        var fecha_desde=$("#fecha_desde").val();
        var fecha_hasta=$("#fecha_hasta").val();

        var apellido_filtro=$("#apellido_filtro").val();
        var nombre_filtro=$("#nombre_filtro").val();
        var dni_filtro=$("#dni_filtro").val();
        var motivo_filtro=$("#motivo_filtro").val();
        // var periodo=$("#periodo").val();
        $("#tabla_listado").load('trae_turnos.php?fecha_desde='+fecha_desde+'&fecha_hasta='+fecha_hasta+'&apellido_filtro='+apellido_filtro+'&nombre_filtro='+nombre_filtro+'&dni_filtro='+dni_filtro+'&motivo_filtro='+motivo_filtro);

}

function trae_turnos_fecha(){
//  alert('holaaa comenten');
        var fecha_turno=$("#fecha_turno").val();

        $("#contador_turnos").load('trae_turnos_dia.php?fecha_turno='+fecha_turno);

}
function trae_actividades_clientes() {
    var dni=$("#dni").val();
    var dominio=$("#dominio").val();
    $("#id_producto").load('trae_productos_dni.php?dni_cliente='+dni+'&dominio='+dominio);
    //$("#mjs").load('busca_pagos_dni.php?dni_cliente='+dni);

    $.ajax({
        url:           "busca_pagos_dni.php",
        data:          {dni_cliente: ""+$("#dni").val(), dominio: ""+dominio},
        dataType:      'json',
        type: 'get',
        success:       function(data){
          //alert(data.mjs);
            if(data.error==1){
                $("#mjs_asistencia").html(data.mjs);
                $("#boton_guarda").hide();
                $("#boton_sig").show();
                $("#div_prod").hide();
                $("#dni").val("");
            }else{
                $("#mjs_asistencia").html(data.mjs);
                $("#boton_guarda").show();
                $("#boton_sig").hide();
                $("#div_prod").show();
            }

        }
    });

    // $("#guar").show();
    // $("#sig").hide();
}
function eiminaCliente(persona){
    if(confirm('Usted esta por eliminar un cliente.Desea Continuar?')){
        window.location.assign('controlador.php?action_js=eliminar_persona_gym&id_persona='+persona);
    }
}
function eiminaPatente(registro, persona){
    if(confirm('Usted esta por eliminar un vehiculo asociado del cliente.Desea Continuar?')){
        window.location.assign('controlador.php?action_js=eliminar_vehiculo_persona&id_relacion='+registro+'&id_persona='+persona);
    }
}
function presente_cliente() {
    var dni=$("#dni").val();
    var dominio=$("#dominio").val();
    $.ajax({
        url:           "presente.php",
        data:          { dni_cliente: ""+$("#dni").val()+"", actividad: ""+$("#id_producto").val(), dominio: ""+dominio},
        type: 'get',
        success:       function(data) {
            //alert(data);
            if (data == 0) {
                $("#mjs").html("Muchas gracias por asistir.");
                $("#refrescar").show();
                $("#boton_guarda").hide();
                $("#div_dni").hide();
                $("#boton_sig").hide();
                $("#div_prod").hide();
            } else { $("#mjs").html("Usted ya marco su presente hoy pillin pillin.Gracias.");
                $("#refrescar").show();
                $("#boton_guarda").hide();
                $("#div_dni").hide();
                $("#boton_sig").hide();
                $("#div_prod").hide();
            }
        }
    });

}
function refrescar() {
    location.reload();

}
function IsNumeric(valor)
{
    var log=valor.length; var sw="S";
    for (x=0; x<log; x++)
    { v1=valor.substr(x,1);
        v2 = parseInt(v1);
//Compruebo si es un valor numérico
        if (isNaN(v2)) { sw= "N";}
    }
    if (sw=="S") {return true;} else {return false; }
}
var primerslap=false;
var segundoslap=false;
function formateafecha(fecha)
{
    var long = fecha.length;
    var dia;
    var mes;
    var ano;
    if ((long>=2) && (primerslap==false)) { dia=fecha.substr(0,2);
        if ((IsNumeric(dia)==true) && (dia<=31) && (dia!="00")) { fecha=fecha.substr(0,2)+"/"+fecha.substr(3,7); primerslap=true; }
        else { fecha=""; primerslap=false;}
    }
    else
    { dia=fecha.substr(0,1);
        if (IsNumeric(dia)==false)
        {fecha="";}
        if ((long<=2) && (primerslap=true)) {fecha=fecha.substr(0,1); primerslap=false; }
    }
    if ((long>=5) && (segundoslap==false))
    { mes=fecha.substr(3,2);
        if ((IsNumeric(mes)==true) &&(mes<=12) && (mes!="00")) { fecha=fecha.substr(0,5)+"/"+fecha.substr(6,4); segundoslap=true; }
        else { fecha=fecha.substr(0,3);; segundoslap=false;}
    }
    else { if ((long<=5) && (segundoslap=true)) { fecha=fecha.substr(0,4); segundoslap=false; } }
    if (long>=7)
    { ano=fecha.substr(6,4);
        if (IsNumeric(ano)==false) { fecha=fecha.substr(0,6); }
        else { if (long==10){ if ((ano==0) || (ano<1900) || (ano>2100)) { fecha=fecha.substr(0,6); } } }
    }
    if (long>=10)
    {
        fecha=fecha.substr(0,10);
        dia=fecha.substr(0,2);
        mes=fecha.substr(3,2);
        ano=fecha.substr(6,4);
// Año no viciesto y es febrero y el dia es mayor a 28
        if ( (ano%4 != 0) && (mes ==02) && (dia > 28) ) { fecha=fecha.substr(0,2)+"/"; }
    }
    return (fecha);
}
function autocomleteINI_menu(id, path) {
    $('#suggest_' + id).autocomplete(
        { messages: { noResults: 'SinResultados', results: function() {} },
            source: function (request, response) {
                $.getJSON( path, { term: this.term }, response );
            }, minLength: 2,
            select: function (event, ui) {
                // /console.log(ui); i
                if (ui.item == null) {
                    $('#' + id).val('').trigger('clear');
                    $('#suggest_' + id).val('');
                } else {
                    //alert('hola'+ui.item.id);
                    $('#' + id).val(ui.item.id).trigger('change');
                    //$("#id_menu").load('trae_menu.php?id_menu='+ui.item.id);
                }
            }
        }) ;
}
function autocomleteINI_aplicativos(id, path) {
    $('#suggest_' + id).autocomplete(
        { messages: { noResults: 'SinResultados', results: function() {} },
            source: function (request, response) {
                $.getJSON( path, { term: this.term }, response );
            }, minLength: 2,
            select: function (event, ui) {
                // /console.log(ui); i
                if (ui.item == null) {
                    $('#' + id).val('').trigger('clear');
                    $('#suggest_' + id).val('');
                } else {
                    //alert('hola'+ui.item.id);
                    $('#' + id).val(ui.item.id).trigger('change');
                    //$("#id_aplicativo").load('trae_aplicativo.php?id_aplicativo='+ui.item.id);
                }
            }
        }) ;
}
function autocomleteINI_usuario(id, path) {
    $('#suggest_' + id).autocomplete(
        { messages: { noResults: 'SinResultados', results: function() {} },
            source: function (request, response) {
                $.getJSON( path, { term: this.term }, response );
            }, minLength: 2,
            select: function (event, ui) {
                // /console.log(ui); i
                if (ui.item == null) {
                    $('#' + id).val('').trigger('clear');
                    $('#suggest_' + id).val('');
                } else {
                    //alert('hola'+ui.item.id);
                    $('#' + id).val(ui.item.id).trigger('change');
                    //$("#id_menu").load('trae_menu.php?id_menu='+ui.item.id);
                }
            }
        }) ;
}
function eliminarPago(pago){
    if(confirm('Usted esta por eliminar un comprobante.Desea Continuar?')){
        window.location.assign('controlador.php?action_js=elimina_pago&id_pago='+pago);
    }
}
function guardar_cambio_contrasenia(){
    if($("#contrasenia_nueva1").val()!=$("#contrasenia_nueva2").val()){
        alert("Las contraseñas  nuevas deben ser iguales");
        return false;
    }
    if($("#contrasenia_nueva1").val()==''){
        alert("El campo nueva contraseña no puede ser nulo");
        return false;
    }
    $.ajax({
        url:           "controlador.php",
        data:          {action_js: "guardar_contrasenia_nueva",contrasenia_nueva1: ""+$("#contrasenia_nueva1").val()+""},
        type: 'post',
        success:       function(data){
            alert('La aplicacion se cerrara vuelva a ingresar .Gracias');
            //location.reload();
            window.location.href = 'controlador.php?action_js=logout';
        }
    });
}
function abrir_pop_turnos(idpersona){
    $("#fechaDiv").addClass( "form-group" );
    $("#motivoDiv").addClass( "form-group" );
    $("#fechaDiv").attr("");
    $("#fecha_turno").attr("");
    $("#persona").load('trae_persona.php?idpersona='+idpersona);
    $("#motivo").load('trae_motivos.php');
    $('#turnera').modal('toggle');

}

function guardar_turno(){
    //alert($("#motivo").val());
    if($("#fecha_turno").val()==''){
        $("#fechaDiv").addClass( "form-group  has-error" );
        return false;
    }
    if($("#motivo").val()==null){
        $("#motivoDiv").addClass( "form-group  has-error" );
        return false;
    }
    $.ajax({
            url:           "controlador.php",
            data:          {action_js: "guardar_turno",id_persona: ""+$("#id_persona").val()+"",fecha_turno: ""+$("#fecha_turno").val()+"",tipo_turno: ""+$("#tipo_turno").val()+"",hora: ""+$("#hora").val()+"",observaciones: ""+$("#observaciones").val()+"",motivo: ""+$("#motivo").val()+""},
            type: 'post',
            success:       function(data){
              //  alert(data);
                if(data){
                    $('#mjs').html('El turno se reservo correctamente');
                    $('#mensaje').modal('toggle');
                    $('#id_turno').attr('value', data);
                    $('#boton_impresion').show();
                }else{
                    $('#mjs_error').html('Ocurrio un error');
                    $('#mensaje_error').modal('toggle');
                }
                $('#turnera').modal('toggle');
            }
        });
}

function busca_persona(){
    var apellido_filtro=$("#apellido_filtro").val();
    var nombre_filtro=$("#nombre_filtro").val();
    var dni_filtro=$("#dni_filtro").val();
    $("#tabla_listado").load('trae_personas.php?dnifiltro='+dni_filtro+'&apellidofiltro='+apellido_filtro+'&nombrefiltro='+nombre_filtro);

}

function busca_persona_all(){
    var apellido_filtro=$("#apellido_filtro").val();
    var nombre_filtro=$("#nombre_filtro").val();
    var dni_filtro=$("#dni_filtro").val();
    $("#tabla_listado").load('trae_personas_all.php?dnifiltro='+dni_filtro+'&apellidofiltro='+apellido_filtro+'&nombrefiltro='+nombre_filtro);

}
function guardar_motivo(){
    //alert($("#motivo").val());
    if($("#descripcion").val()==''){
        $("#descripciondiv").addClass( "form-group  has-error" );
        return false;
    }
    $.ajax({
            url:           "controlador.php",
            data:          {action_js: "guardar_motivo",descripcion: ""+$("#descripcion").val()},
            type: 'post',
            success:       function(data){
                //alert(data);
                if(data){
                    $('#mjs').html('El motivo se guardo correctamente');
                    $('#mensaje').modal('toggle');
                    $("#motivo").load('trae_motivos.php');
                }else{
                    $('#mjs_error').html('Ocurrio un error');
                    $('#mensaje_error').modal('toggle');
                }
                $('#motivos').modal('toggle');
            }
    });
}
function guardar_preparador(){
    //alert($("#motivo").val());
    if($("#decripcion_preparador").val()==''){
        $("#decripcion_preparadorDiv").addClass( "form-group  has-error" );
        return false;
    }
    $.ajax({
            url:           "controlador.php",
            data:          {action_js: "guardar_preparador",descripcion: ""+$("#decripcion_preparador").val()},
            type: 'post',
            success:       function(data){
                //alert(data);
                if(data){
                    $('#mjs').html('El preparador se guardo correctamente');
                    $('#mensaje').modal('toggle');
                    $("#preparador").load('trae_preparador.php');
                }else{
                    $('#mjs_error').html('Ocurrio un error');
                    $('#mensaje_error').modal('toggle');
                }
                $('#preparador_form').modal('toggle');
            }
    });
}
function guardar_cementerio(){
    //alert($("#motivo").val());
    if($("#decripcion_cementerio").val()==''){
        $("#decripcion_cementerioDiv").addClass( "form-group  has-error" );
        return false;
    }

    $.ajax({
            url:           "controlador.php",
            data:          {action_js: "guardar_cementerio",descripcion: ""+$("#decripcion_cementerio").val(),cementerio_cremacion: ""+$("#cementerio_cremacion_abm").val()},
            type: 'post',
            success:       function(data){
                //alert(data);
                if(data){
                    $('#mjs').html('El lugar de servicio se guardo correctamente');
                    $('#mensaje').modal('toggle');
                    Seleccionar_tipo_entierro($("#cementerio_cremacion").val());
                }else{
                    $('#mjs_error').html('Ocurrio un error');
                    $('#mensaje_error').modal('toggle');
                }
                $('#cementerio_form').modal('toggle');
            }
    });
}

function guardar_problema(){

    if($("#descripcion_problema").val()==''){
        $("#descripcion_problemadiv").addClass( "form-group  has-error" );
        return false;
    }
    $.ajax({
            url:           "controlador.php",
            data:          {action_js: "guardar_problema",descripcion: ""+$("#descripcion_problema").val()},
            type: 'post',
            success:       function(data){
                //alert(data);
                if(data){
                    $('#mjs').html('El problema se guardo correctamente');
                    $('#mensaje').modal('toggle');
                    $("#problemas_persona").load('trae_problemas.php');
                }else{
                    $('#mjs_error').html('Ocurrio un error');
                    $('#mensaje_error').modal('toggle');
                }
                $('#problemas').modal('toggle');
            }
    });
}
function cancelar_turno(turno){
    if(confirm('Usted esta por cancelar un turno.Desea Continuar?')){
        window.location.assign('controlador.php?action=cancelar_turnos&turno='+turno);
    }
}
function abrir_pop_motivos(){
  //var_dump('hola');
    $('#motivos').modal('toggle');
}
function abrir_pop_problemas(){
  //var_dump('hola');
    $('#problemas').modal('toggle');
}
function guardar_atencion(){
    //alert($("#motivo").val());
    if($("#descripcion_atencion").val()==''){
        $("#descripcionatenciondiv").addClass( "form-group  has-error" );
        return false;
    }
    $.ajax({
            url:           "controlador.php",
            data:          {action_js: "guardar_atencion",descripcion_atencion: ""+$("#descripcion_atencion").val()},
            type: 'post',
            success:       function(data){
                alert(data);
                if(data){
                    $('#mjs').html('La tarea realizada se grabo correctamente');
                    $('#mensaje').modal('toggle');
                    $("#motivo").load('trae_motivos.php');
                }else{
                    $('#mjs_error').html('Ocurrio un error');
                    $('#mensaje_error').modal('toggle');
                }
                $('#motivos').modal('toggle');
            }
    });
}
function guardar_evolucion(){

    var data=$("#form_datos_evolucion").serialize()+"&problemas_diagnosticos="+$("#problemas_persona").val();
    if($("#evolucion_texto").val()==null){
        $("#evolucion_texto").addClass( "form-group  has-error" );
        return false;
    }
    $.ajax({
            url:           "controlador.php",
            data:         data,
            type: 'post',
            success:       function(data){
                //alert(data);
                if(data){
                    $('#mjs').html('La evolucion se guardo correctamente');
                    $('#mensaje').modal('toggle');
                      $("#bloque_evoluciones").load('trae_evoluciones.php?id_persona='+$("#id_persona").val());
                      location.reload();
                }else{
                    $('#mjs_error').html('Ocurrio un error');
                    $('#mensaje_error').modal('toggle');
                }

            }
        });
}
function edita_estado_turno(turno, estado) {

    $.ajax({
        url:           "controlador.php",
        data:          {action_js: "edita_estado_turno",turno: ""+turno+"",estado:   ""+estado+""},
        dataType:      'json',
        type: 'get',
        success:       function(data){
          $('#mjs').html('El turno se cambio de estado correctamente');
          $('#mensaje').modal('toggle');
          trae_turnos();
        }
    });
}
function turnera(){
  //alert('hola mundo');
  $("#turnera").load("turnero.php");
        //$("#tabla_listado").load('trae_turnos.php?fecha_desde='+fecha_desde+'&fecha_hasta='+fecha_hasta);
}
function imprimir_bono(turno){
  if(turno){

  }else{
    var turno=$("#id_turno").val();
  }
    window.open('impresion/bono_turno.php?turno='+turno, '_blank');
    $('#boton_impresion').hide();
}
function imprimir_servicio(servicio){
  if(servicio){

  }else{
    var servicio=$("#id_servicio").val();
  }
    window.open('impresion/bono_servicio.php?id_servicio='+servicio, '_blank');
    $('#boton_impresion').hide();
}
function imprimir_pago(pago){
  if(pago){

  }else{
    var pago=$("#id_pago").val();
  }
    window.open('impresion/bono_pago.php?pago='+pago, '_blank');
    $('#boton_impresion').hide();
}
function trae_asistencias(){
        var fecha_desde=$("#fecha_desde").val();
        var fecha_hasta=$("#fecha_hasta").val();
        // var periodo=$("#periodo").val();
        $("#tabla_listado").load('trae_asistencias.php?fecha_desde='+fecha_desde+'&fecha_hasta='+fecha_hasta);

}
function trae_relaciones(){
        var actividad=$("#actividad").val();
        $("#tabla_listado").load('trae_relaciones.php?actividad='+actividad);
}
function elimina_relacion(idRelacion, idPersona){
    if(confirm('Usted esta por eliminar una relacion de actividad .Desea Continuar?')){
        window.location.assign('controlador.php?action_js=eliminar_relacion&idRelacion='+idRelacion+'&idPersona='+idPersona);
    }
}
function agrega_comprobante(){
  if($('#cantidad').val()==''){
    alert('Ingrese una cantidad');
    return false;
  }
  var prestacion=$('#suggest_prestaciones').val();
  var id_prestacion=$('#prestaciones').val();
  // var unidad=$('#unidad_productos').val();
  var cantidad=$('#cantidad').val();
  var precio=$('#precio_prestaciones').val();
  var costo=$('#costo_prestaciones').val();
  v2=parseFloat(precio);
  precio=v2.toFixed(2)
  i++;
  $("#prestacion_comprobante").append('<tr><td>'+prestacion+'<input name="prestacion_reserva['+i+']" id="prestacion_reserva_'+i+'" value="'+id_prestacion+'" type="hidden"/></td><td><input class="form-control" name="cantidad['+i+']" id="cantidad_'+i+'" value="'+cantidad+'" type="hidden"/><div id="cantidad_prod'+i+'">'+cantidad+'</div></td><td><div id="etiqueta_precio_'+i+'">'+precio+'</div><input type="hidden" name="precio['+i+']" id="precio_'+i+'" value="'+precio+'"/></td><td><button type="button" class="btn btn-danger btn-borrar-fila" onclick="resta('+i+')">x</button></td></tr>');
  $('#suggest_prestaciones').val("");
  $('#prestaciones').val("");
  $('#precio_prestaciones').val("");
  $('#cantidad').val("1");
  $( "#suggest_prestaciones" ).focus();

  v1=parseFloat($("#precio_aprox").val());
    // alert($("#precio_aprox").val());
  v2=parseFloat(precio);
  v3=v2+v1;
  $("#precio_aprox").val(v3.toFixed(2));
}
function trae_comprobantes(){
        var fecha_desde=$("#fecha_desde").val();
        var fecha_hasta=$("#fecha_hasta").val();
        // var periodo=$("#periodo").val();
        $("#tabla_listado").load('trae_comprobantes.php?fecha_desde='+fecha_desde+'&fecha_hasta='+fecha_hasta);

}
function trae_turnos_pelu(){
//  alert('si bueno ');
        var fecha_desde=$("#fecha_desde").val();
        var fecha_hasta=$("#fecha_hasta").val();

        var apellido_filtro=$("#apellido_filtro").val();
        var nombre_filtro=$("#nombre_filtro").val();
        var dni_filtro=$("#dni_filtro").val();
        var motivo_filtro=$("#motivo_filtro").val();
        // var periodo=$("#periodo").val();
        $("#tabla_listado").load('trae_turnos_pelu.php?fecha_desde='+fecha_desde+'&fecha_hasta='+fecha_hasta+'&apellido_filtro='+apellido_filtro+'&nombre_filtro='+nombre_filtro+'&dni_filtro='+dni_filtro+'&motivo_filtro='+motivo_filtro);

}
function abrir_pop_personas(){
  $("#pais").load('trae_paises.php');
  $("#os").load('trae_os.php');
  $("#lugar_deceso").load('trae_lugar_deceso.php');

  $('#nueva_persona').modal('toggle');
}
function abrir_pop_solicitantes(){
  
  $('#nueva_solicitante').modal('toggle');
}
function abrir_pop_garantes(){
  
  $('#nueva_garante').modal('toggle');
}
function abrir_pop_pais(){
  $('#form_paises').modal('toggle');
}
function abrir_pop_preparador(){
  $('#preparador_form').modal('toggle');
}
function abrir_pop_cementerio(){
  $('#cementerio_form').modal('toggle');
}
function abrir_pop_lugar(){
  $('#form_lugar_deceso').modal('toggle');
}
function guardar_pais(){
    //alert($("#motivo").val());
    if($("#descripcion").val()==''){
        $("#descripciondiv").addClass( "form-group  has-error" );
        return false;
    }
    $.ajax({
            url:           "controlador.php",
            data:          {action_js: "guardar_pais",descripcion: ""+$("#descripcion").val()},
            type: 'post',
            success:       function(data){
                //alert(data);
                if(data){
                    $('#mjs').html('El pais se guardo correctamente');
                    $('#mensaje').modal('toggle');
                    $("#pais").load('trae_paises.php');
                }else{
                    $('#mjs_error').html('Ocurrio un error');
                    $('#mensaje_error').modal('toggle');
                }
                $('#form_paises').modal('toggle');
            }
    });
}
function guardar_lugar(){
    //alert($("#motivo").val());
    if($("#descripcion_lugar").val()==''){
        $("#descripciondiv").addClass( "form-group  has-error" );
        return false;
    }
    $.ajax({
            url:           "controlador.php",
            data:          {action_js: "guardar_lugar",descripcion: ""+$("#descripcion_lugar").val()},
            type: 'post',
            success:       function(data){
                //alert(data);
                if(data){
                    $('#mjs').html('El lugar de deceso se guardo correctamente');
                    $('#mensaje').modal('toggle');
                    $("#lugar_deceso").load('trae_lugar_deceso.php');
                }else{
                    $('#mjs_error').html('Ocurrio un error');
                    $('#mensaje_error').modal('toggle');
                }
                $('#form_lugar_deceso').modal('toggle');
            }
    });
}

function busca_persona_obito(){
    var apellido_filtro=$("#apellido_filtro").val();
    var nombre_filtro=$("#nombre_filtro").val();
    var dni_filtro=$("#dni_filtro").val();
    $("#tabla_listado").load('trae_personas_obito.php?dnifiltro='+dni_filtro+'&apellidofiltro='+apellido_filtro+'&nombrefiltro='+nombre_filtro);

}

function busca_persona_solicitante(){
    var apellido_filtro=$("#apellido_filtro").val();
    var nombre_filtro=$("#nombre_filtro").val();
    var dni_filtro=$("#dni_filtro").val();
    $("#tabla_listado").load('trae_personas_solicitantes.php?dnifiltro='+dni_filtro+'&apellidofiltro='+apellido_filtro+'&nombrefiltro='+nombre_filtro);

}
function trae_medidas_ataud(tipo){
        
        $("#medida_ataud").load('trae_medida_por_tipo.php?id_tipo='+tipo);

}
function trae_anchos_ataud(medida){
        var tipo=$("#tipo_ataud").val();
        $("#ancho_ataud").load('trae_ancho_por_tipo_medida.php?id_tipo='+tipo+'&medida='+medida);

}
function trae_id_ataud(ancho){
        var tipo=$("#tipo_ataud").val();
        var medida=$("#medida_ataud").val();
        $("#div_id_ataud").load('trae_id_ataud.php?id_tipo='+tipo+'&medida='+medida+'&ancho='+ancho);


}
function autocomleteINI_persona_obito(id, path) {
    $('#suggest_' + id).autocomplete(
        { messages: { noResults: 'nadaaa', results: function() {} },
            source: function (request, response) {
                $.getJSON( path, { term: this.term }, response );
            }, minLength: 2,
            select: function (event, ui) {
                // /console.log(ui); i
                if (ui.item == null) {
                    $('#' + id).val('').trigger('clear');
                    $('#suggest_' + id).val('');
                } else {
                    //alert('hola'+ui.item.id);
                    $('#' + id).val(ui.item.id).trigger('change');
                    $("#datos_persona_obito").load('trae_datos_persona_obito.php?id_persona_obito='+ui.item.id);
                    $("#buscador_obito").hide();
                }
            }
        }) ;
}
function autocomleteINI_persona_obito_filtro(id, path) {
    $('#suggest_' + id).autocomplete(
        { messages: { noResults: 'nadaaa', results: function() {} },
            source: function (request, response) {
                $.getJSON( path, { term: this.term }, response );
            }, minLength: 2,
            select: function (event, ui) {
                // /console.log(ui); i
                if (ui.item == null) {
                    $('#' + id).val('').trigger('clear');
                    $('#suggest_' + id).val('');
                } else {
                    //alert('hola'+ui.item.id);
                    $('#' + id).val(ui.item.id).trigger('change');
                    trae_servicios();
                }
            }
        }) ;
}
function autocomleteINI_solicitante(id, path) {
    $('#suggest_' + id).autocomplete(
        { messages: { noResults: 'nadaaa', results: function() {} },
            source: function (request, response) {
                $.getJSON( path, { term: this.term }, response );
            }, minLength: 2,
            select: function (event, ui) {
                // /console.log(ui); i
                if (ui.item == null) {
                    $('#' + id).val('').trigger('clear');
                    $('#suggest_' + id).val('');
                } else {
                    //alert('hola'+ui.item.id);
                    $('#' + id).val(ui.item.id).trigger('change');
                    $("#datos_solicitante").load('trae_datos_solicitante.php?id_solicitante='+ui.item.id);
                     $("#buscador_solicitante").hide();
                }
            }
        }) ;
}
function autocomleteINI_garante(id, path) {
    $('#suggest_' + id).autocomplete(
        { messages: { noResults: 'nadaaa', results: function() {} },
            source: function (request, response) {
                $.getJSON( path, { term: this.term }, response );
            }, minLength: 2,
            select: function (event, ui) {
                // /console.log(ui); i
                if (ui.item == null) {
                    $('#' + id).val('').trigger('clear');
                    $('#suggest_' + id).val('');
                } else {
                    //alert('hola'+ui.item.id);
                    $('#' + id).val(ui.item.id).trigger('change');
                    $("#datos_garante").load('trae_datos_garante.php?id_solicitante='+ui.item.id);
                     $("#buscador_garante").hide();
                }
            }
        }) ;
}
function ver_buscador_garante(){
    $("#buscador_garante").show();
    $("#datos_garante").html("");
    
}
function ver_buscador_solicitante(){
    $("#buscador_solicitante").show();
    $("#datos_solicitante").html("");
}
function ver_buscador_obito(){
    $("#buscador_obito").show();
    $("#datos_persona_obito").html("");
}
function buscar_combinacion_ataud() {
    var tipo=$("#tipo_ataud").val();
    var medida=$("#medida").val();
    var ancho=$("#ancho").val();

    $.ajax({
        url:           "buscar_combinacion_ataud.php",
        data:          {medida: ""+medida+"", ancho: ""+ancho+"", tipo: ""+tipo+""},
        type: 'get',
        success:       function(data){
          //alert(data.mjs);
            if(data=='1'){
                // alert('El ataud NOOO ya existe');
                $("#boton_guardar").prop("disabled", false);
            }else{
                $("#boton_guardar").prop("disabled", true);

            }

        }
    });
}
function imprimir_pago_servicio(pago){
  if(pago){

  }else{
    var pago=$("#id_pago_servicio").val();
  }
    window.open('impresion/bono_pago_servicio.php?id_pago_servicio='+pago, '_blank');
    $('#boton_impresion').hide();
}
function buscar_pagos_servicio(id_servicio){
        $("#pagos_realizados").load('trae_pagos_servicios.php?id_servicio='+id_servicio);
        $('#pagos_servicios').modal('toggle');
}
function borrar_pago_servicio(pago) {
    if(confirm('Ustede esta por dar de  baja un  comprobante. Desea continuar?')){
        $.ajax({
            url:           "controlador.php",
            data:          {idPagoServicio: ""+pago+"",action_js: "borrar_pago_servicio"},
            type: 'get',
            success:       function(data){
                trae_pagos_servicios();
            }
        });
    }
}