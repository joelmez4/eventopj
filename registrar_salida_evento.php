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
           
            if (document.getElementById("check_activar").checked)
            {
                document.getElementById("dni_asistente1").readOnly=false;
                document.getElementById("nombres_asistente1").readOnly=false;
                document.getElementById("apellidos_asistente1").readOnly=false;
                document.getElementById("dni_asistente1").value="";
                document.getElementById("nombres_asistente1").value="";
                document.getElementById("apellidos_asistente1").value="";
                document.form_reg_entrada.dni_asistente.focus();
            }
            else
            {
                
                document.getElementById("dni_asistente1").readOnly=true;
                document.getElementById("nombres_asistente1").readOnly=true;
                document.getElementById("apellidos_asistente1").readOnly=true;
            }
            
		}
    </script>
  </head>
  <body OnLoad="document.form_salida.dni_salida.focus();" background="images/pj2-transparente.png">
   
      <?php
          include('maqueta/menu.php');   
      ?>
      <br/>
      <br/>
      <br/>
  
    <?php
     
      $dni2=""; 
      $nombres2=""; 
      $apellidos2=""; 
      $nro_evento=$_GET['id_evento'];
      $consulta="SELECT nro_evento,tipo_evento,nombre_evento,fecha,estado FROM evento WHERE nro_evento='$nro_evento'";
      if(!$resultado=$miconex->query($consulta))
      {
          die ("Ha ocurrido un error en:[".$miconex->error."]");
      }    
    ?>   

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
   
        <form class="container" method="post" action="" name="form_salida">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Ingrese DNI:</strong></label>
                <div class="col-sm-3">
                    <input type="text" class="form-control mb-2" name="dni_salida" maxlength="8">
                </div>
                <input type="hidden" class="form-control mb-2"  name="nro_evento1" value="<?php echo $fila['nro_evento'];?>">
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-dark" name="btn_buscar_dni_salida">Buscar</button>
                </div>
                <div class="col-sm-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="check_activar" value="" onchange="habilitar();">
                        <label class="form-check-label text-secondary"><strong>Ingresar datos manualmente</strong></label>
                    </div>
                </div>
            </div> 
        </form>
  
        <?php
                if(isset($_POST['btn_buscar_dni_salida']))
                {
                    $dni_salida=$_POST['dni_salida'];
                    $nro_evento1=$_POST['nro_evento1'];
                 
                    $consulta1="SELECT dni_asistente,nombres_asistente,apellidos_asistente,hora_ingreso,nro_evento FROM asistentes_evento WHERE 
                        dni_asistente='$dni_salida' and nro_evento='$nro_evento1' and hora_ingreso!='00:00:00.000000'";
                    if(!$resultado1=$miconex->query($consulta1))
                    {
                        die ("Ha ocurrido un error en:[".$miconex->error."]");
                    }
                    if($fila1=$resultado1->fetch_assoc())
                    {      
                        $dni2=$fila1['dni_asistente'];     
                        $nombres2=$fila1['nombres_asistente']; 
                        $apellidos2=$fila1['apellidos_asistente']; 
                    }
                    else
                    {
                        echo "<div class='alert alert-danger container' role='alert'>No ha registrado su entrada en este evento</div>";
                    }
                }
            ?>

        <div class="container text-danger"> * Verificacion de datos</div>

        <form class="container" name="form_reg_entrada" method="post" action="">
            <div class="form-group row">
                <div class="col-sm-2">
                    <input type="text" readonly placeholder="AQUI DNI" required="" class="form-control mb-2" id="dni_asistente1" name="dni_asistente1" value="<?php echo $dni2;?>" maxlength="8" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                </div>
                <div class="col-sm-4">
                    <input type="text" readonly placeholder="AQUI NOMBRES" class="form-control mb-2" id="nombres_asistente1" name="nombres_asistente1" value="<?php echo $nombres2;?>" required="">
                </div>
                <div class="col-sm-4">
                    <input type="text" readonly placeholder="AQUI APELLIDOS" class="form-control mb-2" id="apellidos_asistente1" name="apellidos_asistente1" value="<?php echo $apellidos2;?>" required="" >
                </div>
                <div class="col-sm-2">
             
                    <input type="hidden" name="fecha_evento" value="<?php echo $fecha_evento; ?>">
                    <input type="hidden" name="estado_evento" value="<?php echo $estado; ?>">
                    <input type="hidden" id="id_evento2" name="nroevento" value="<?php echo $nro_evento; ?>">
                    <input type="hidden" name="fecha_hoy" value="<?php echo fecha_actual(); ?>">
                    <input type="hidden" id="horabd" name="hora_evento_actual">
                    
                    <button type="submit" class="btn btn-primary" name="btn_registrar_salida">Registrar Salida</button>
                </div>
            </div> 
        </form>

        <?php
            if(isset($_POST['btn_registrar_salida']))
            {
                $dni_asistente1=$_POST['dni_asistente1'];
                $fecha_ingreso=$_POST['fecha_hoy'];
                $hora_salida=$_POST['hora_evento_actual']; 
                $nro_evento2=$_POST['nroevento'];
                $id_usuario="cverah";
                $estado_evento=$_POST['estado_evento'];
                $fecha_evento=$_POST['fecha_evento'];
     
                $consulta3="SELECT * FROM asistentes_evento WHERE dni_asistente='$dni_asistente1' and nro_evento='$nro_evento2'
                and hora_salida!='00:00:00.000000'";
                if(!$resultado3=$miconex->query($consulta3))
                {
                     die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
                }
         
                if($resultado3->num_rows>0)
                {
                    echo "<script>alertify.error('Ya ha sido registrado la salida del asistente, no se pudo insertar');</script>";
                    echo "<div class='alert alert-danger container' role='alert'>El asistente ya registro su salida, verifique en buscar</div>"; 
                }
    
                elseif(($estado_evento=="abierto")&&($fecha_evento==$fecha_ingreso)&&($dni_asistente1!=""))
                {
                    $consulta3="UPDATE asistentes_evento SET hora_salida='$hora_salida' 
                                WHERE dni_asistente='$dni_asistente1' and nro_evento='$nro_evento2'";
                        if(!$miconex->query($consulta3))
                        {
                            die ("no se pudo insertar insertar por error en: [".$miconex->error."]");
                        }
                        else
                        {
                            echo "<script>alertify.success('Registro de Salida Correctamente');</script>";
                            echo "<div class='alert alert-success container' role='alert'>Registro de Salida Correctamente</div>"; 
            
                        }
                                
                }
                else{
                    echo "<script>alertify.error('no se pudo insertar, el evento ya no se encuentra disponible por fecha y hora pasada');</script>";
                    echo "<div class='alert alert-danger container' role='alert'>El evento ya no se encuentra disponible por fecha y hora pasada, o DNI vacio</div>"; 
                }
                }
        ?>
    
        <form class="container">
            <div class="form-group row container">
                <label for="staticEmail" class="col-form-label"><b>Buscar Evento:</b></label>
                <div class="col-sm-8">
                    <input type="text"  class="form-control mb-2" id="text_buscar_salida">
                </div><div class="col-sm-2">
                    <a class="btn btn-danger" href="eventos_abiertos.php" role="button">Regresar</a>
                </div>
            </div>
        </form>
        <div class="container" id="datos_eventos_salida">

        </div>
        </div>
    </div>
 
    <?php
      include('maqueta/footer.php');   
    ?>
  
    <script src="js/jquery.js"></script>
  
    <script src="js/main.js"></script>
    <script src="js/reloj.js"></script>
   
 
  
  </body>
</hmtl>