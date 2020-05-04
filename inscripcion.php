<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hello, world!</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/alertify.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="js/jquery.js"></script> 
    <script src="js/alertify.js"></script>
    <script src="js/bootstrap.js"></script>
    
    <script>
		function habilitar()
		{
            
            if (document.getElementById("check_activar").checked)
            {
                document.getElementById("dni_inscrito").readOnly=false;
                document.getElementById("nombres_inscrito").readOnly=false;
                document.getElementById("apellidos_inscrito").readOnly=false;
                document.getElementById("dni_inscrito").value="";
                document.getElementById("nombres_inscrito").value="";
                document.getElementById("apellidos_inscrito").value="";
            }
            else
            {
               
                document.getElementById("dni_inscrito").readOnly=true;
                document.getElementById("nombres_inscrito").readOnly=true;
                document.getElementById("apellidos_inscrito").readOnly=true;
            }
            
		}
    </script>

    <script language="JavaScript">
        function mueveReloj(){
            momentoActual = new Date();
            hora = momentoActual.getHours();
            minuto = momentoActual.getMinutes();
            segundo = momentoActual.getSeconds();

            str_segundo = new String (segundo);
            str_minuto = new String (minuto)
            if (str_minuto.length == 1){
            minuto = "0" + minuto;
            }
            str_hora = new String (hora)
            if (str_hora.length == 1){
            hora = "0" + hora;
            }
            horaImprimible=hora+":"+minuto+":"+segundo;

            document.registro_inscripcion.horabd.value = horaImprimible;
            

            setTimeout("mueveReloj()",1000)
        }
        </script>
  </head>
  <body  background="images/pj2-transparente.png" onload="mueveReloj()">
  
 >
    <?php
      require('conexion.php');  
      $nro_evento=$_GET['id_evento'];
      $consulta="select nro_evento,tipo_evento,nombre_evento,fecha,hora,estado from evento where nro_evento='$nro_evento'";
      if(!$resultado=$miconex->query($consulta))
      {
          die ("Ha ocurrido un error en:[".$miconex->error."]");
      }
      if($fila=$resultado->fetch_assoc())
      {
          $nombre_completo_evento=$fila['tipo_evento']." : ".$fila['nombre_evento'];
          $fecha_evento=$fila['fecha'];
          $hora_evento=$fila['hora'];
    ?>   
  
    <nav style="background-image: url('images/pj2.png'); background-repeat: repeat-x;  background-size: 40px 40px;">
        <img src="images/pj2.png" width="40" height="40"  alt="">
    </nav>
    <!-- fin menu -->
    <!-- Inicio Cabecera-->
    <div class="container-fluid">
      
      <div class="text-center mt-2 container">
        
        <div class=" p-2 d-inline d-sm-inline-block"><img src="images/pj.jpg" class=""></div>
        <div class="p-2 d-inline d-sm-inline-block text-uppercase"><h4><strong><em><?php echo $nombre_completo_evento; ?></em></strong></h4></div>
       
      </div>
      <div class="text-center container">
        <div class="p-2 d-inline d-sm-inline-block"><span class="font-weight-bold">Fecha: <?php echo fecha_mostrar2($fila['fecha']); ?></span></div>
        <div class="p-2 d-inline d-sm-inline-block"><span class="font-weight-bold">Hora: <?php echo hora_mostrar($fila['hora']); ?></span></div>
      </div>
        
        <h3 class="display-5 container"><small class="text-muted">INSCRIBITE</small></h3>
        <div class="container text-danger text-justify mb-2"> *En caso de que el curso tenga certificacion se recomienda realizar la busqueda por dni, caso contrario los datos ingresados manualmente sera responsabilidad del interesado.</div>
      
        <form class="container">
           <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Ingrese DNI:</strong></label>
                <div class="col-sm-3">
                    <input type="text" class="form-control mb-2" id="dni" name="dni" maxlength="8" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-dark mb-2" id="botoncito">Buscar</button>
                </div>
                <div class="col-sm-5">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="check_activar" value="" onchange="habilitar();">
                        <label class="form-check-label text-secondary"><strong>Ingresar datos manualmente</strong></label>
                    </div>
                </div>
            </div> 
        </form>
      
        <div class="text-danger container"> *Verificacion de datos --- si el valor es null verificar que el dni es correcto</div>
       
        <form class="container" name="registro_inscripcion" method="post" action="">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Su DNI:</strong></label>
                <div class="col-sm-3">
                <input type="text" readonly class="form-control" id="dni_inscrito" name="dni_inscrito1" required="" value="" maxlength="8" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                </div>                
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Nombres:</strong></label>
                <div class="col-sm-4">
                    <input type="text" readonly class="form-control" id="nombres_inscrito" name="nombres_inscrito1" required="" >
                </div>
                <label class="col-sm-2 col-form-label"><strong>Apellidos:</strong></label>
                <div class="col-sm-4">
                    <input type="text" readonly class="form-control" id="apellidos_inscrito" name="apellidos_inscrito1" required="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"><strong>Correo:</strong></label>
                <div class="col-sm-4">
                    <input type="email"  class="form-control" id="" name="correo_inscrito" required="" value="">
                </div>
                <label class="col-sm-2 col-form-label"><strong>Telefono:</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="" name="telefono_inscrito" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                </div>
            </div>
          
            <input type="hidden" name="fecha_hoy" value="<?php echo fecha_actual(); ?>">
            <input type="hidden" id="" name="horabd" value="">
            <input type="hidden" id="" name="estado_actual" value="<?php echo $fila['estado'];?>">
            <input type="hidden" id="" name="fecha_evento1" value="<?php echo $fecha_evento;?>">
            <input type="hidden" id="" name="hora_evento1" value="<?php echo $hora_evento;?>">
            <input type="hidden" id="" name="nro_evento1" value="<?php echo $nro_evento;?>">
           
            <div class="form-group row text-center">
                <div class="col-sm-4">
                    <button type="submit" name="btn_inscribir" class="btn btn-primary mb-2 btn-block">Inscribir</button>
                </div>
                <div class="col-sm-4">
                    <a class="btn btn-success mb-2 btn-block" href="verificar_inscripcion.php?id_evento=<?php echo $nro_evento;?>" role="button">Verificar Inscripcion</a>
                </div>
                <div class="col-sm-4">
                    <a class="btn btn-danger btn-block" href="eventos_activos.php" role="button">Regresar</a>
                </div>
            </div>
        </form>
        <?php }?>
        
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
                            $('#dni_inscrito').val((datos[0]));
                            $('#nombres_inscrito').val((datos[1]));
                            $('#apellidos_inscrito').val((datos[2]+" "+datos[3]));                            
                    }
                });
                return false;
                });
            });
          </script>
      
        <?php
        if(isset($_POST['btn_inscribir'])){
            $dni_inscrito1=$_POST['dni_inscrito1'];
            $nombres_inscrito1=$_POST['nombres_inscrito1'];
            $apellidos_insritos1=$_POST['apellidos_inscrito1'];
            $correo_inscrito=$_POST['correo_inscrito'];
            $telefono_inscrito=$_POST['telefono_inscrito'];
            $fecha_hoy=$_POST['fecha_hoy'];
            $hora_hoy=$_POST['horabd'];
            $fecha_hora_hoy=$fecha_hoy." ".$hora_hoy;
            $estado_actual=$_POST['estado_actual'];
            $fecha_hora_evento1=$_POST['fecha_evento1']." ".$_POST['hora_evento1'];    
            $nro_evento1=$_POST['nro_evento1'];
     
            $consulta="select * from inscripcion where dni_inscripcion='$dni_inscrito1' and nombres_inscripcion='$nombres_inscrito1'";
            if(!$resultado=$miconex->query($consulta))
            {
                 die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
            }
       
            if($resultado->num_rows>0)
            {
                echo "<script>alertify.error('Ya existe inscrito con el mismo nombre o DNI, no se pudo insertar');</script>";
                echo "<div class='p-3 mb-2 bg-danger text-white container'>Ya existe inscrito con el mismo nombre o DNI, no se pudo insertar. Dirijase a Verificar Inscripcion para ver su ticket de entrada</div>"; //mensaje
            }
    
            elseif(($estado_actual=="abierto")&&($fecha_hora_evento1>=$fecha_hora_hoy)&&($dni_inscrito1!=" ")&&($nombres_inscrito1!=" "))
            {
                $consulta="insert into inscripcion values('','$dni_inscrito1','$nombres_inscrito1',
                    '$apellidos_insritos1','$fecha_hoy','$hora_hoy','$correo_inscrito','$telefono_inscrito','$nro_evento1')";
                    if(!$miconex->query($consulta))
                    {
                        die ("no se pudo insertar insertar por error en: [".$miconex->error."]");
                    }
                    else
                    {
                        echo "<script>alertify.success('Inscrito Correctamente, verifique su ticket de ingreso en verificar inscripcion');</script>"; 
                        echo "<div class='p-3 mb-2 bg-success text-white container'>Inscrito Correctamente, verifique su ticket de ingreso en verificar inscripcion</div>"; 
                    }
                               
            }
            else{
                echo "<script>alertify.error('no se pudo insertar, el evento ya no se encuentra disponible por fecha y hora pasada');</script>";
                echo "<div class='p-3 mb-2 bg-danger text-white container'>El evento ya no se encuentra disponible por fecha y hora pasada</div>"; 
            }
        }
        ?>
        <br/>
  
    
        <footer class="footer">
            <p><b>© 2020 OFICINA DE ESTADISTICA E INFORMATICA - CSJAP</b></p>
        </footer>
        
    <script src="js/main.js"></script>
    
  </body>
</hmtl>