//inicia buscar datos
$(buscar_datos());
//funcion buscar datos de los usuarios
function buscar_datos(consulta)
{
    $.ajax({
        url:'acciones/cargar_usuarios.php', //donde va ir la funcion
        type:'POST',
        dataType:'html',
        data: {consulta:consulta}, //se pasara como parametro consulta
    })
    .done(function(respuesta){
        $("#datos_usuarios").html(respuesta); //cargar en un div que contenga el identificador de datos_usuarios y que lo pase la respuesta del seridor ajax en formato html

    })   
    .fail(function(){

        console.log("error");
    })

}

//creamos ahora cuando se presiona en el texbox con id:text_buscar
$(document).on('keyup',"#text_buscar", function(){ //si en el documento se presiona la caja de texto con identificador text_buscar ejecutara la siguiente funcion
    var valor=$(this).val(); //que capture el valor de lo que presiono en el identificador #text_buscar
    if(valor!=""){ //si valor distinto de vacio
        buscar_datos(valor); //que llame a funcion buscar_datos con la variable valor
    }
    else{
        buscar_datos(); //llamar a la funcion sin ningun parametro por consiguiente mostrara todos los datos de la tabla
    }
});

//inicia buscar expositor
$(buscar_datos_expositor());
//funcion buscar datos de los expositores
function buscar_datos_expositor(consulta)
{
    $.ajax({
        url:'acciones/cargar_expositor.php', //donde va ir la funcion
        type:'POST',
        dataType:'html',
        data: {consulta:consulta}, //se pasara como parametro consulta
    })
    .done(function(respuesta){
        $("#datos_expositores").html(respuesta); //cargar en un div que contenga el identificador de datos_usuarios y que lo pase la respuesta del seridor ajax en formato html

    })   
    .fail(function(){

        console.log("error");
    })

}

//creamos ahora cuando se presiona en el texbox con id:text_buscar
$(document).on('keyup',"#text_buscar_expositor", function(){ //si en el documento se presiona la caja de texto con identificador text_buscar ejecutara la siguiente funcion
    var valor=$(this).val(); //que capture el valor de lo que presiono en el identificador #text_buscar
    if(valor!=""){ //si valor distinto de vacio
        buscar_datos_expositor(valor); //que llame a funcion buscar_datos con la variable valor
    }
    else{
        buscar_datos_expositor(); //llamar a la funcion sin ningun parametro por consiguiente mostrara todos los datos de la tabla
    }
});

//inicia buscador de eventos
$(buscar_datos_eventos());
//funcion buscar datos de los expositores
function buscar_datos_eventos(consulta)
{
    $.ajax({
        url:'acciones/cargar_eventos.php', //donde va ir la funcion
        type:'POST',
        dataType:'html',
        data: {consulta:consulta}, //se pasara como parametro consulta
    })
    .done(function(respuesta){
        $("#datos_eventos").html(respuesta); //cargar en un div que contenga el identificador de datos_usuarios y que lo pase la respuesta del seridor ajax en formato html

    })   
    .fail(function(){

        console.log("error");
    })

}
//creamos ahora cuando se presiona en el texbox que busque el evento por el input text
$(document).on('keyup',"#text_buscar_evento", function(){ //si en el documento se presiona la caja de texto con identificador text_buscar ejecutara la siguiente funcion
    var valor=$(this).val(); //que capture el valor de lo que presiono en el identificador #text_buscar
    if(valor!=""){ //si valor distinto de vacio
        buscar_datos_eventos(valor); //que llame a funcion buscar_datos con la variable valor
    }
    else{
        buscar_datos_eventos(); //llamar a la funcion sin ningun parametro por consiguiente mostrara todos los datos de la tabla
    }
});
//para buscar entre 2 fechas
function buscar_fechas_eventos()
{
    var desde= $('#text_fechaini_evento').val(); //guardar el dato de la fecha inicio
    var hasta= $('#text_fechafin_evento').val(); //guardar el dato de la fecha fin
    $.ajax({
        url:'acciones/cargar_eventos.php', //donde va ir la funcion
        type:'POST',
        dataType:'html',
        data:'desde='+desde+'&hasta='+hasta, //se pasara como parametro el desde y el hasta 
    })
    .done(function(respuesta){
        $("#datos_eventos").html(respuesta); //cargar en un div que contenga el identificador de datos_eventos y que lo pase la respuesta del seridor ajax en formato html

    })   
    .fail(function(){

        console.log("error");
    })

}

//
$(document).on('change',"#text_fechaini_evento", function(){ //si se selecciona una fecha
    buscar_fechas_eventos(); //que llame a funcion buscar_fechas
    
});

$(document).on('change',"#text_fechafin_evento", function(){ //si se selecciona una fecha
    buscar_fechas_eventos(); //que llame a funcion buscar_fechas
    
});


//inicia datos_eventos_abiertos_para registrar inscritos
$(buscar_eventos_abiertos());
//funcion buscar datos de los expositores
function buscar_eventos_abiertos(consulta)
{
    $.ajax({
        url:'acciones/cargar_eventos_abiertos.php', //donde va ir la funcion
        type:'POST',
        dataType:'html',
        data: {consulta:consulta}, //se pasara como parametro consulta
    })
    .done(function(respuesta){
        $("#datos_eventos_abiertos").html(respuesta); //cargar en un div que contenga el identificador de datos_usuarios y que lo pase la respuesta del seridor ajax en formato html

    })   
    .fail(function(){

        console.log("error");
    })

}
//creamos ahora cuando se presiona en el texbox que busque el evento por el input text
$(document).on('keyup',"#text_buscar_evento_abierto", function(){ //si en el documento se presiona la caja de texto con identificador text_buscar ejecutara la siguiente funcion
    var valor=$(this).val(); //que capture el valor de lo que presiono en el identificador #text_buscar
    if(valor!=""){ //si valor distinto de vacio
        buscar_eventos_abiertos(valor); //que llame a funcion buscar_datos con la variable valor
    }
    else{
        buscar_eventos_abiertos(); //llamar a la funcion sin ningun parametro por consiguiente mostrara todos los datos de la tabla
    }
});


//inicia datos_eventos_cerrados
$(buscar_eventos_cerrados());
//funcion buscar eventos cerrados
function buscar_eventos_cerrados(consulta)
{
    $.ajax({
        url:'acciones/cargar_eventos_cerrados.php', //donde va ir la funcion
        type:'POST',
        dataType:'html',
        data: {consulta:consulta}, //se pasara como parametro consulta
    })
    .done(function(respuesta){
        $("#datos_eventos_cerrados").html(respuesta); //cargar en un div que contenga el identificador de datos_usuarios y que lo pase la respuesta del seridor ajax en formato html

    })   
    .fail(function(){

        console.log("error");
    })

}
//creamos ahora cuando se presiona en el texbox que busque el evento por el input text
$(document).on('keyup',"#text_buscar_evento_cerrado", function(){ //si en el documento se presiona la caja de texto con identificador text_buscar ejecutara la siguiente funcion
    var valor=$(this).val(); //que capture el valor de lo que presiono en el identificador #text_buscar
    if(valor!=""){ //si valor distinto de vacio
        buscar_eventos_cerrados(valor); //que llame a funcion buscar_datos con la variable valor
    }
    else{
        buscar_eventos_cerrados(); //llamar a la funcion sin ningun parametro por consiguiente mostrara todos los datos de la tabla
    }
});
//funcion para el footer cuando se expanda mayor a la ventan del windows
//$(document).ready(function(){
  //  if(($("body").height())<($(window).height())){
    //    $("footer2").css({"position":"absolute","bottom":"0px"});
    //}
   
//});

//datos eventos_pj_publico_general
$(buscar_datos_eventos_pj());
//funcion buscar datos de los expositores
function buscar_datos_eventos_pj(consulta)
{
    $.ajax({
        url:'acciones/cargar_eventos_pj.php', //donde va ir la funcion
        type:'POST',
        dataType:'html',
        data: {consulta:consulta}, //se pasara como parametro consulta
    })
    .done(function(respuesta){
        $("#datos_eventos_pj").html(respuesta); //cargar en un div que contenga el identificador de datos_usuarios y que lo pase la respuesta del seridor ajax en formato html

    })   
    .fail(function(){

        console.log("error");
    })

}
//creamos ahora cuando se presiona en el texbox que busque el evento por el input text
$(document).on('keyup',"#text_eventos_pj", function(){ //si en el documento se presiona la caja de texto con identificador text_buscar ejecutara la siguiente funcion
    var valor=$(this).val(); //que capture el valor de lo que presiono en el identificador #text_buscar
    if(valor!=""){ //si valor distinto de vacio
        buscar_datos_eventos_pj(valor); //que llame a funcion buscar_datos con la variable valor
    }
    else{
        buscar_datos_eventos_pj(); //llamar a la funcion sin ningun parametro por consiguiente mostrara todos los datos de la tabla
    }
});

//buscar en el selector
function buscar_estado_eventos()
{
    var estado_evento= $('#estado_evento').val(); //guardar el dato de la fecha inicio
    $.ajax({
        url:'acciones/cargar_eventos_pj.php', //donde va ir la funcion
        type:'POST',
        dataType:'html',
        data:'estado_evento='+estado_evento, //se pasara como parametro el desde y el hasta 
    })
    .done(function(respuesta){
        $("#datos_eventos_pj").html(respuesta); //cargar en un div que contenga el identificador de datos_eventos y que lo pase la respuesta del seridor ajax en formato html

    })   
    .fail(function(){

        console.log("error");
    })

}
$(document).on('change',"#estado_evento", function(){ //si en el documento se presiona la caja de texto con identificador text_buscar ejecutara la siguiente funcion
    buscar_estado_eventos();
});

//ver detalles evento de la pagna eventos_detalles_pj
function verdetalle_evento(nro_evento)
{
    $.ajax({
        type:'POST',
        data:'nro_evento='+nro_evento,
        url:'acciones/mante_eventos.php',
        dataType:'html',
        success:function(data){
            $('#modal_vereventos').html(data),
            $('#modal_detalle_evento').modal({
                show:true, //muestra el modal
                //backdrop:'static', //impide que se salga del modal
            });
            
        }
    });
    return false;
    
}

//buscar datos de los asistentes de entrada en el evento

$(buscar_datos_asistentes_entrada());
//funcion buscar datos de los usuarios
function buscar_datos_asistentes_entrada(consulta)
{
    var nro_evento_entrada= $('#id_evento2').val(); //sacar el el nro de evento del form registro entrada
    
    $.ajax({
        url:'acciones/cargar_entrada_evento.php', //donde va ir la funcion
        type:'POST',
        dataType:'html',
        data: {consulta:consulta, nro_evento_entrada:nro_evento_entrada}, //se pasara 2 parametros consulta (teclado) y el otro del id evento
    })
    .done(function(respuesta){
        $("#datos_eventos_entrada").html(respuesta); //cargar en un div que contenga el identificador de datos_usuarios y que lo pase la respuesta del seridor ajax en formato html

    })   
    .fail(function(){

        console.log("error");
    })

}

//creamos ahora cuando se presiona en el texbox con id:text_buscar
$(document).on('keyup',"#text_buscar_asistente", function(){ //si en el documento se presiona la caja de texto con identificador text_buscar ejecutara la siguiente funcion
    var valor=$(this).val(); //que capture el valor de lo que presiono en el identificador #text_buscar
    if(valor!=""){ //si valor distinto de vacio
        buscar_datos_asistentes_entrada(valor); //que llame a funcion buscar_datos con la variable valor
    }
    else{
        buscar_datos_asistentes_entrada(); //llamar a la funcion sin ningun parametro por consiguiente mostrara todos los datos de la tabla
    }
});

//buscar asisten en formulario registar_salida
$(buscar_datos_asistentes_salida());
//funcion buscar datos de los usuarios
function buscar_datos_asistentes_salida(consulta)
{
    var nro_evento_salida= $('#id_evento2').val();//sacar el el nro de evento del form registro entrada
    
    $.ajax({
        url:'acciones/cargar_salida_evento.php', //donde va ir la funcion
        type:'POST',
        dataType:'html',
        data: {consulta:consulta, nro_evento_salida:nro_evento_salida}, //se pasara 2 parametros consulta (teclado) y el otro del id evento
    })
    .done(function(respuesta){
        $("#datos_eventos_salida").html(respuesta); //cargar en un div que contenga el identificador de datos_usuarios y que lo pase la respuesta del seridor ajax en formato html

    })   
    .fail(function(){

        console.log("error");
    })

}

//creamos ahora cuando se presiona en el texbox con id:text_buscar
$(document).on('keyup',"#text_buscar_salida", function(){ //si en el documento se presiona la caja de texto con identificador text_buscar ejecutara la siguiente funcion
    var valor=$(this).val(); //que capture el valor de lo que presiono en el identificador #text_buscar
    if(valor!=""){ //si valor distinto de vacio
        buscar_datos_asistentes_salida(valor); //que llame a funcion buscar_datos con la variable valor
    }
    else{
        buscar_datos_asistentes_salida(); //llamar a la funcion sin ningun parametro por consiguiente mostrara todos los datos de la tabla
    }
});

//buscar inscritos en el evento
$(buscar_inscritos_evento());
//funcion buscar datos de los usuarios
function buscar_inscritos_evento(consulta)
{
    var nro_evento_cerrado= $('#id_evento3').val();//sacar el el nro de evento 
    
    $.ajax({
        url:'acciones/cargar_inscritos_evento.php', //donde va ir la funcion
        type:'POST',
        dataType:'html',
        data: {consulta:consulta, nro_evento_cerrado:nro_evento_cerrado}, //se pasara 2 parametros consulta (teclado) y el otro del id evento
    })
    .done(function(respuesta){
        $("#datos_inscritos_eventos").html(respuesta); //cargar en un div que contenga el identificador de datos_usuarios y que lo pase la respuesta del seridor ajax en formato html

    })   
    .fail(function(){

        console.log("error");
    })

}

//creamos ahora cuando se presiona en el texbox con id:text_buscar
$(document).on('keyup',"#text_buscar_inscrito", function(){ //si en el documento se presiona la caja de texto con identificador text_buscar ejecutara la siguiente funcion
    var valor=$(this).val(); //que capture el valor de lo que presiono en el identificador #text_buscar
    if(valor!=""){ //si valor distinto de vacio
        buscar_inscritos_evento(valor); //que llame a funcion buscar_datos con la variable valor
    }
    else{
        buscar_inscritos_evento(); //llamar a la funcion sin ningun parametro por consiguiente mostrara todos los datos de la tabla
    }
});

//buscar en el selector
function buscar_estado_certificado()
{
    var nro_evento_cerrado= $('#id_evento3').val();
    var estado_certificado= $('#estado_certificado').val(); //guardar el dato de la fecha inicio
    $.ajax({
        url:'acciones/cargar_inscritos_evento.php', //donde va ir la funcion
        type:'POST',
        dataType:'html',
        data:'estado_certificado='+estado_certificado+'&nro_evento_cerrado='+nro_evento_cerrado, //se pasara como parametro el desde y el hasta 
    })
    .done(function(respuesta){
        $("#datos_inscritos_eventos").html(respuesta); //cargar en un div que contenga el identificador de datos_eventos y que lo pase la respuesta del seridor ajax en formato html

    })   
    .fail(function(){

        console.log("error");
    })

}
$(document).on('change',"#estado_certificado", function(){ //si en el documento se presiona la caja de texto con identificador text_buscar ejecutara la siguiente funcion
    buscar_estado_certificado();
});



//inicia datos_eventos_cerrados
$(cerrar_eventos_pj());
//funcion buscar eventos cerrados
function cerrar_eventos_pj(consulta)
{
    $.ajax({
        url:'acciones/cerrar_evento_pj.php', //donde va ir la funcion
        type:'POST',
        dataType:'html',
        data: {consulta:consulta}, //se pasara como parametro consulta
    })
    .done(function(respuesta){
        $("#evento_a_cerrar").html(respuesta); //cargar en un div que contenga el identificador de datos_usuarios y que lo pase la respuesta del seridor ajax en formato html

    })   
    .fail(function(){

        console.log("error");
    })

}
//creamos ahora cuando se presiona en el texbox que busque el evento por el input text
$(document).on('keyup',"#text_evento_a_cerrar", function(){ //si en el documento se presiona la caja de texto con identificador text_buscar ejecutara la siguiente funcion
    var valor=$(this).val(); //que capture el valor de lo que presiono en el identificador #text_buscar
    if(valor!=""){ //si valor distinto de vacio
        cerrar_eventos_pj(valor); //que llame a funcion buscar_datos con la variable valor
    }
    else{
        cerrar_eventos_pj(); //llamar a la funcion sin ningun parametro por consiguiente mostrara todos los datos de la tabla
    }
});

//boton de reporte excel

