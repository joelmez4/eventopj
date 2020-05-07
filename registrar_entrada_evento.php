<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Hello, world!</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/alertify.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css"> 
    <script src="jquery-3.1.1.min.js"></script>
    <script src="js/alertify.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
		function habilitar()
		{
            // habilitamos
            if (document.getElementById("check_activar").checked)
            {
                document.getElementById("dni_asistente").readOnly=false;
                document.getElementById("nombres_asistente").readOnly=false;
                document.getElementById("apellidos_asistente").readOnly=false;
                document.getElementById("dni_asistente").value="";
                document.getElementById("nombres_asistente").value="";
                document.getElementById("apellidos_asistente").value="";
                document.form_reg_entrada.dni_asistente.focus();
            }
            else
            {
                // deshabilitamos
                document.getElementById("dni_asistente").readOnly=true;
                document.getElementById("nombres_asistente").readOnly=true;
                document.getElementById("apellidos_asistente").readOnly=true;
            }
            
		}
    </script>
  </head>
  <body OnLoad="document.form_reg.dni.focus();" background="images/pj2-transparente.png">
        <!-- inicio menu -->
      <?php
          include('maqueta/menu.php');   
      ?>
      <br/>
      <br/>
      <br/>
    <!-- fin menu -->
    <!-- Inicio conexion con base de datos-->
    <?php
     
      $dni2=""; //auxiliar dni2 para formulario ticket
      $nombres2=""; //auxiliar nombre2 para formulario ticket
      $apellidos2=""; //auxiliar apellido2 para formulario ticket
      $nro_evento=$_GET['id_evento'];
      $consulta="SELECT nro_evento,tipo_evento,nombre_evento,fecha,estado FROM evento WHERE nro_evento='$nro_evento'";
      if(!$resultado=$miconex->query($consulta))
      {
          die ("Ha ocurrido un error en:[".$miconex->error."]");
      }    
    ?>   
    <!-- Fin conexion con base de datos-->
    
      <!-- Inicio de Contenido -->
    <div style="min-height: 100vh;">
        <div class="container-fluid table-responsive mt-0">
            <?php   
                if($fila=$resultado->fetch_assoc()){
                    $nombre_completo_evento=$fila['tipo_evento']." : ".$fila['nombre_evento'];    
                    $estado=$fila['estado'];    
                    $fecha_evento=$fila['fecha'];         
            ?>
            <div class="text-center mt-2 container">
                <div class="p-2 d-inline d-sm-inline-block text-uppercase"><h4><strong><em><?php echo $nombre_completo_evento; ?></em></strong></h4></div>
                
            </div>
            <?php } ?> 
            <!-- Inicio de reloj -->
            <div class="wrap">
            
                <div class="widget">
                    <div class="fecha">
                        <p id="diaSemana" class="diaSemana"></p>
                        <p id="dia" class="dia"></p>
                        <p>de </p>
                        <p id="mes" class="mes"></p>
                        <p>del </p>
                        <p id="year" class="year"></p>
                    </div>
                    <div class="reloj">
                        <p id="horas" class="horas"></p>
                        <p>:</p>
                        <p id="minutos" class="minutos"></p>
                        <p>:</p>
                        <div class="caja-segundos">
                        <p id="segundos" class="segundos"></p>
                        <p id="ampm" class="ampm"></p>					
                        </div>
                    </div>
                </div>
            </div>
        <!-- Fin reloj -->
        <!-- Inicio Buscador-->
        <form class="container" action="" name="form_reg">
           <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Ingresar por DNI:</strong></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control mb-2" id="dni" name="dni" maxlength="8">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-dark mb-2" id="botoncito">Buscar</button>
                </div>
                <div class="col-sm-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="check_activar" value="" onchange="habilitar();">
                        <label class="form-check-label text-secondary"><strong>Ingresar datos manualmente</strong></label>
                    </div>
                </div>
            </div> 
        </form>
        <!-- script busqueda dni -->
        <script>
            $(function(){
                $('#botoncito').on('click', function(){
                    var dni = $('#dni').val();
                    var url = 'consulta_reniec.php';
                    $.ajax({
                    type:'POST',
                    url:url,
                    data:'dni='+dni,
                    success: function(datos_dni){
                        var datos = eval(datos_dni);
                            $('#dni_asistente').val((datos[0]));
                            $('#nombres_asistente').val((datos[1]));
                            $('#apellidos_asistente').val((datos[2]+" "+datos[3]));  
                            $('#dni').val(""); //borra el input text dejandolo blanco               
                    }
                });
                return false;
                });
            });
        </script>
        <!-- script fin busqueda dni -->
        <!-- Inicia Formulario para ticket -->
        <form class="container" method="post" action="">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Ingresar por Ticket:</strong></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control mb-2" placeholder="Ingrese DNI o Ticket" name="ticket" maxlength="8">
                </div>
                <input type="hidden" class="form-control mb-2"  name="nro_evento1" value="<?php echo $fila['nro_evento'];?>">
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-dark" name="btn_buscar_ticket">Buscar</button>
                </div>
            </div> 
        </form>
        <!-- Fin Formulario para ticket -->
         <!-- php para buscar ticket de incripcion segun el evento indicado -->
            <?php
                if(isset($_POST['btn_buscar_ticket']))
                {
                    $nro_ticket=$_POST['ticket'];
                    $nro_evento1=$_POST['nro_evento1'];
                    $consulta="SELECT a.nro_evento,a.fecha,a.hora,b.id_inscripcion,b.dni_inscripcion,
                    b.nombres_inscripcion,b.apellidos_inscripcion FROM evento a inner join inscripcion b
                    on a.nro_evento=b.nro_evento where a.nro_evento='$nro_evento1' and (b.id_inscripcion='$nro_ticket' 
                    or b.dni_inscripcion='$nro_ticket')";
                    if(!$resultado=$miconex->query($consulta))
                    {
                        die ("Ha ocurrido un error en:[".$miconex->error."]");
                    }
                    if($fila=$resultado->fetch_assoc())
                    {      
                        $dni2=$fila['dni_inscripcion'];     
                        $nombres2=$fila['nombres_inscripcion']; 
                        $apellidos2=$fila['apellidos_inscripcion']; 
                    }
                    else
                    {
                        echo "<div class='alert alert-danger container' role='alert'>No se encuentra el usuario, el usuario no se ha inscrito</div>";
                    }
                }
            ?>
        <!-- fin php para buscar ticket de incripcion segun el evento indicado -->
        <!-- fin php para buscar ticket de incripcion segun el evento indicado -->
        <div class="container text-danger"> * Verificacion de datos</div>
        <!-- Inicio php para verificacion de datos y luego registrar entrada -->
        <form class="container" name="form_reg_entrada" method="post" action="">
            <div class="form-group row">
                <div class="col-sm-2">
                    <input type="text" readonly placeholder="AQUI DNI" required="" class="form-control mb-2" id="dni_asistente" name="dni_asistente1" value="<?php echo $dni2;?>" maxlength="8" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                </div>
                <div class="col-sm-4">
                    <input type="text" readonly placeholder="AQUI NOMBRES" class="form-control mb-2" id="nombres_asistente" name="nombres_asistente1" value="<?php echo $nombres2;?>" required="">
                </div>
                <div class="col-sm-4">
                    <input type="text" readonly placeholder="AQUI APELLIDOS" class="form-control mb-2" id="apellidos_asistente" name="apellidos_asistente1" value="<?php echo $apellidos2;?>" required="" >
                </div>
                <div class="col-sm-2">
                <!-- consulta para ver el numero de inscripcion -->
                <!-- ocultos -->
                <input type="hidden" name="fecha_evento" value="<?php echo $fecha_evento; ?>">
                <input type="hidden" name="estado_evento" value="<?php echo $estado; ?>">
                <input type="hidden" id="id_evento2" name="nroevento" value="<?php echo $nro_evento; ?>">
                <input type="hidden" name="fecha_hoy" value="<?php echo fecha_actual(); ?>">
                <input type="hidden" id="horabd" name="hora_evento_actual">
                    <button type="submit" class="btn btn-primary" name="btn_registrar_entrada">Registrar Entrada</button>
                </div>
            </div> 
        </form>
        <!-- registro de entrada al evento -->
        <?php
            if(isset($_POST['btn_registrar_entrada']))
            {
                $dni_asistente1=$_POST['dni_asistente1'];
                $nombres_asistente1=$_POST['nombres_asistente1'];
                $apellidos_asistente1=$_POST['apellidos_asistente1'];
                $fecha_ingreso=$_POST['fecha_hoy'];
                $hora_ingreso=$_POST['hora_evento_actual'];
                $hora_salida="";
                $nro_evento2=$_POST['nroevento'];
                $id_usuario="cverah";
                $estado_evento=$_POST['estado_evento'];
                $fecha_evento=$_POST['fecha_evento'];
                $consulta3="SELECT * FROM asistentes_evento WHERE dni_asistente='$dni_asistente1' and nro_evento='$nro_evento2'";
                if(!$resultado3=$miconex->query($consulta3))
                {
                     die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
                }
                //si encuentra inscrito con el mismo nombre
                if($resultado3->num_rows>0)
                {
                    echo "<script>alertify.error('Ya ha sido registrado la entrada del asistente, no se pudo insertar');</script>";
                    echo "<div class='alert alert-danger container' role='alert'>El asistente ya ha sido inscrito, verifique en buscar</div>"; //mensaje
                }
                //si el dni o nombre es diferente de vacio o fecha de evento esta dentro de la fecha actual
                elseif(($estado_evento=="abierto")&&($fecha_evento==$fecha_ingreso)&&($dni_asistente1!=""))
                {
                    $consulta3="insert into asistentes_evento values('','$dni_asistente1','$nombres_asistente1',
                        '$apellidos_asistente1','$fecha_ingreso','$hora_ingreso','$hora_salida','$nro_evento2','$id_usuario')";
                        if(!$miconex->query($consulta3))
                        {
                            die ("no se pudo insertar insertar por error en: [".$miconex->error."]");
                        }
                        else
                        {
                            echo "<script>alertify.success('Registro de entrada Correctamente');</script>"; //codigo de js alertify
                            echo "<div class='alert alert-success container' role='alert'>Registro de Entrada Correctamente</div>"; //mensaje
            
                        }
                                
                }
                else{
                    echo "<script>alertify.error('no se pudo insertar, el evento ya no se encuentra disponible por fecha y hora pasada');</script>";//codigo de js alertify
                    echo "<div class='alert alert-danger container' role='alert'>El evento ya no se encuentra disponible por fecha y hora pasada, o DNI vacio</div>"; //mensaje
                }
                }
        ?>
        <!-- fin de entrada al evento -->
        <!-- Inicio de Cargar Contenido -->
        <form class="container">
            <div class="form-group row container">
                <label for="staticEmail" class="col-form-label"><b>Buscar Evento:</b></label>
                <div class="col-sm-8">
                    <input type="text"  class="form-control mb-2" id="text_buscar_asistente" name="text_buscar_evento_abierto">
                </div><div class="col-sm-2">
                    <a class="btn btn-danger" href="eventos_abiertos.php" role="button">Regresar</a>
                </div>
            </div>
        </form>
        <div class="container" id="datos_eventos_entrada">

        </div>
        </div>
    </div>
  <!-- Fin Contenido-->
  <!-- Inicio Pie de Pagina-->
    <?php
      include('maqueta/footer.php');   
    ?>
  <!-- Fin Pie de Pagina-->
  <!-- Modal para insertar evento -->
  <!-- Fin para insertar usuario -->
  <!-- Fin Modal para insertar usuario -->    
    <script src="js/jquery.js"></script>
  
    <script src="js/main.js"></script>
    <script src="js/reloj.js"></script>
   
    <!-- Scrip para hora - time -->  
  
  </body>
</hmtl>