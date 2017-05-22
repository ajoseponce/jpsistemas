function volver_listado(relacion){
 window.location.href = 'controlador.php?action=listar_'+relacion;
}
function volver_listado_relaciones(){
    window.location.href = 'controlador.php?action=lista_relaciones';
}
function volver_listado_productos(){
    window.location.href = 'controlador.php?action=lista_productos';
}
function guardar_datos(){
    // if($("#nombre").val()==''){
    //     alert("Seleccione una nombre por favor");
    //     return false;
    // }
    // if($("#apellido").val()==''){
    //     alert("Seleccione un apellido por favor");
    //     return false;
    // }
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
        data:          {action: "guardar_relacion",clientes: ""+$("#id_persona").val()+"",id_producto: ""+$("#id_producto").val()+"",fecha_inicio: ""+$("#fecha_inicio").val()+""},
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
        data:          {action: "guardar_relacion",clientes: ""+$("#id_persona").val()+"",id_relacion: ""+relacion+"",id_producto: ""+$("#id_producto_"+relacion).val()+"",fecha_inicio: ""+$("#fecha_inicio_"+relacion).val()+""},
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
            data:          {action: "guardar_pago",id_cliente: ""+$("#clientes").val()+"",id_producto: ""+$("#id_producto").val()+"",periodo: ""+$("#periodo").val()+"",monto: ""+$("#precio").val()+"",nota: ""+$("#nota").val()},
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
        data:          {action: "buscar_precio",clientes: ""+$("#clientes").val()+"",id_producto: ""+id+"",periodo: ""+$("#periodo").val()},
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
        data:          {action: "pagos_periodo",periodo: ""+periodo+"",cliente: ""+$("#clientes").val()},
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
        window.location.assign('controlador.php?action=eliminar_persona&id_persona='+persona);
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
    location.href= 'controlador.php?action=asistencia';

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

