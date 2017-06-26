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

function guardar_producto(){
    // if($("#descripcion").val()==''){
    //     alert("cargue una descripcion por favor");
    //     return false;
    // }
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
function trae_turnos_fecha(){
//  alert('holaaa comenten');
        var fecha_turno=$("#fecha_turno").val();

        $("#contador_turnos").load('trae_turnos_dia.php?fecha_turno='+fecha_turno);

}
function trae_actividades_clientes() {
    var dni=$("#dni").val();
    $("#id_producto").load('trae_productos_dni.php?dni_cliente='+dni);
    //$("#mjs").load('busca_pagos_dni.php?dni_cliente='+dni);

    $.ajax({
        url:           "busca_pagos_dni.php",
        data:          {dni_cliente: ""+$("#dni").val()},
        dataType:      'json',
        type: 'get',
        success:       function(data){
            if(data.error==1){
                $("#mjs").html(data.mjs);
                $("#boton_guarda").hide();
                $("#boton_sig").show();
                $("#div_prod").hide();
                $("#dni").val("");
            }else{
                $("#mjs").html(data.mjs);
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
        window.location.assign('controlador.php?action_js=eliminar_persona&id_persona='+persona);
    }
}
function presente_cliente() {
    var dni=$("#dni").val();
    $.ajax({
        url:           "presente.php",
        data:          { dni_cliente: ""+$("#dni").val()+"", actividad: ""+$("#id_producto").val()},
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
    location.href= 'controlador.php?action_js=asistencia';

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
            window.location.href = 'controlador.php?action=logout';
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
                //alert(data);
                if(data){
                    $('#mjs').html('El turno se reservo correctamente');
                    $('#mensaje').modal('toggle');
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
