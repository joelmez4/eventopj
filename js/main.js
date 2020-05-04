
$(buscar_datos());

function buscar_datos(consulta)
{
    $.ajax({
        url:'acciones/cargar_usuarios.php', 
        type:'POST',
        dataType:'html',
        data: {consulta:consulta}, 
    })
    .done(function(respuesta){
        $("#datos_usuarios").html(respuesta); 

    })   
    .fail(function(){

        console.log("error");
    })

}


$(document).on('keyup',"#text_buscar", function(){ 
    var valor=$(this).val(); 
    if(valor!=""){ 
        buscar_datos(valor); 
    }
    else{
        buscar_datos(); 
    }
});


$(buscar_datos_expositor());

function buscar_datos_expositor(consulta)
{
    $.ajax({
        url:'acciones/cargar_expositor.php', 
        type:'POST',
        dataType:'html',
        data: {consulta:consulta}, 
    })
    .done(function(respuesta){
        $("#datos_expositores").html(respuesta); 

    })   
    .fail(function(){

        console.log("error");
    })

}


$(document).on('keyup',"#text_buscar_expositor", function(){ 
    var valor=$(this).val(); 
    if(valor!=""){ 
        buscar_datos_expositor(valor); 
    }
    else{
        buscar_datos_expositor(); 
    }
});


$(buscar_datos_eventos());

function buscar_datos_eventos(consulta)
{
    $.ajax({
        url:'acciones/cargar_eventos.php', 
        type:'POST',
        dataType:'html',
        data: {consulta:consulta}, 
    })
    .done(function(respuesta){
        $("#datos_eventos").html(respuesta); 

    })   
    .fail(function(){

        console.log("error");
    })

}

$(document).on('keyup',"#text_buscar_evento", function(){ 
    var valor=$(this).val(); 
    if(valor!=""){ 
        buscar_datos_eventos(valor); 
    }
    else{
        buscar_datos_eventos(); 
    }
});

function buscar_fechas_eventos()
{
    var desde= $('#text_fechaini_evento').val(); 
    var hasta= $('#text_fechafin_evento').val(); 
    $.ajax({
        url:'acciones/cargar_eventos.php', 
        type:'POST',
        dataType:'html',
        data:'desde='+desde+'&hasta='+hasta, 
    })
    .done(function(respuesta){
        $("#datos_eventos").html(respuesta);

    })   
    .fail(function(){

        console.log("error");
    })

}

//
$(document).on('change',"#text_fechaini_evento", function(){ 
    buscar_fechas_eventos(); 
    
});

$(document).on('change',"#text_fechafin_evento", function(){ 
    buscar_fechas_eventos(); 
    
});



$(buscar_eventos_abiertos());

function buscar_eventos_abiertos(consulta)
{
    $.ajax({
        url:'acciones/cargar_eventos_abiertos.php', 
        type:'POST',
        dataType:'html',
        data: {consulta:consulta}, 
    })
    .done(function(respuesta){
        $("#datos_eventos_abiertos").html(respuesta); 

    })   
    .fail(function(){

        console.log("error");
    })

}

$(document).on('keyup',"#text_buscar_evento_abierto", function(){ 
    var valor=$(this).val(); 
    if(valor!=""){ 
        buscar_eventos_abiertos(valor); 
    }
    else{
        buscar_eventos_abiertos(); 
    }
});



$(buscar_eventos_cerrados());

function buscar_eventos_cerrados(consulta)
{
    $.ajax({
        url:'acciones/cargar_eventos_cerrados.php', 
        type:'POST',
        dataType:'html',
        data: {consulta:consulta}, 
    })
    .done(function(respuesta){
        $("#datos_eventos_cerrados").html(respuesta); 

    })   
    .fail(function(){

        console.log("error");
    })

}

$(document).on('keyup',"#text_buscar_evento_cerrado", function(){ 
    var valor=$(this).val(); 
    if(valor!=""){ 
        buscar_eventos_cerrados(valor); 
    }
    else{
        buscar_eventos_cerrados(); 
    }
});
//funcion para el footer cuando se expanda mayor a la ventan del windows
//$(document).ready(function(){
  //  if(($("body").height())<($(window).height())){
    //    $("footer2").css({"position":"absolute","bottom":"0px"});
    //}
   
//});


$(buscar_datos_eventos_pj());

function buscar_datos_eventos_pj(consulta)
{
    $.ajax({
        url:'acciones/cargar_eventos_pj.php', 
        type:'POST',
        dataType:'html',
        data: {consulta:consulta}, 
    })
    .done(function(respuesta){
        $("#datos_eventos_pj").html(respuesta); 

    })   
    .fail(function(){

        console.log("error");
    })

}

$(document).on('keyup',"#text_eventos_pj", function(){ 
    var valor=$(this).val(); 
    if(valor!=""){ 
        buscar_datos_eventos_pj(valor); 
    }
    else{
        buscar_datos_eventos_pj();
    }
});

//buscar en el selector
function buscar_estado_eventos()
{
    var estado_evento= $('#estado_evento').val(); 
    $.ajax({
        url:'acciones/cargar_eventos_pj.php', 
        type:'POST',
        dataType:'html',
        data:'estado_evento='+estado_evento, 
    })
    .done(function(respuesta){
        $("#datos_eventos_pj").html(respuesta); 

    })   
    .fail(function(){

        console.log("error");
    })

}
$(document).on('change',"#estado_evento", function(){ 
    buscar_estado_eventos();
});


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
                show:true, 
            });
            
        }
    });
    return false;
    
}



$(buscar_datos_asistentes_entrada());

function buscar_datos_asistentes_entrada(consulta)
{
    var nro_evento_entrada= $('#id_evento2').val(); 
    
    $.ajax({
        url:'acciones/cargar_entrada_evento.php', 
        type:'POST',
        dataType:'html',
        data: {consulta:consulta, nro_evento_entrada:nro_evento_entrada}, 
    })
    .done(function(respuesta){
        $("#datos_eventos_entrada").html(respuesta);

    })   
    .fail(function(){

        console.log("error");
    })

}


$(document).on('keyup',"#text_buscar_asistente", function(){ 
    var valor=$(this).val(); 
    if(valor!=""){ 
        buscar_datos_asistentes_entrada(valor); 
    }
    else{
        buscar_datos_asistentes_entrada(); 
    }
});


$(buscar_datos_asistentes_salida());

function buscar_datos_asistentes_salida(consulta)
{
    var nro_evento_salida= $('#id_evento2').val();
    
    $.ajax({
        url:'acciones/cargar_salida_evento.php', 
        type:'POST',
        dataType:'html',
        data: {consulta:consulta, nro_evento_salida:nro_evento_salida}, 
    })
    .done(function(respuesta){
        $("#datos_eventos_salida").html(respuesta); 

    })   
    .fail(function(){

        console.log("error");
    })

}


$(document).on('keyup',"#text_buscar_salida", function(){ 
    var valor=$(this).val(); 
    if(valor!=""){ 
        buscar_datos_asistentes_salida(valor); 
    }
    else{
        buscar_datos_asistentes_salida(); 
    }
});