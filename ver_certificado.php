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
    <script src="js/jquery.js"></script> <!-- Para enviar modal se tiene que poner parte arriba este jquery sino no abrira el modal-->
    <script src="js/alertify.js"></script>
    <script src="js/bootstrap.js"></script>
  </head>
  <body  background="images/pj2-transparente.png">
  
    <!-- Inicio conexion con base de datos-->
    <?php
        require('conexion.php');  
        $nro_evento=$_GET['id_evento'];
        $consulta="select nro_evento,tipo_evento,nombre_evento,fecha,estado from evento where nro_evento='$nro_evento'";
        if(!$resultado=$miconex->query($consulta))
        {
            die ("Ha ocurrido un error en:[".$miconex->error."]");
        }
        if($fila=$resultado->fetch_assoc())
        {
            $nombre_completo_evento=$fila['tipo_evento']." : ".$fila['nombre_evento'];
     
            $estado_evento=$fila['estado'];
        }
    ?>   
    <!-- Fin conexion con base de datos-->
    <!-- inicio menu -->
    <nav style="background-image: url('images/pj2.png'); background-repeat: repeat-x;  background-size: 40px 40px;">
        <img src="images/pj2.png" width="40" height="40"  alt="">
    </nav>
    
<div style="min-height: 100vh;"><!-- para que el footer este siempre abajo -->
    <!-- Inicio Contenido-->
        <div class="container-fluid">
            <div class="text-center mt-2 container">
                <div class=" p-2 d-inline d-sm-inline-block"><img src="images/pj.jpg" class=""></div>
                <div class="p-2 d-inline d-sm-inline-block text-uppercase"><h4><strong><em><?php echo $nombre_completo_evento; ?></em></strong></h4></div>
        
            </div>
            <div class="text-center container">
                <div class="p-4 d-inline d-sm-inline-block"><h4><strong>Buscar Certificado</strong></h4></div>
            </div>
           
            <!-- Fin Cabecera-->
            <!-- Inicio Formulario buscar DNI-->
            <form class="container mt-2" method="post" action="" enctype="multipart/form-data"> 
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><strong>Ingrese DNI:</strong></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control mb-2" name="dni_inscrito" maxlength="8" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                    </div>
                    <input type="hidden" name="nro_evento4" value="<?php echo $nro_evento; ?>">
                    <input type="hidden" name="fecha_hoy" value="<?php echo fecha_actual(); ?>">
                    <input type="hidden" name="estado_evento" value="<?php echo $estado_evento; ?>">
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-primary mr-4" name="btn_buscar_certificado">Buscar</button>
                        <a class="btn btn-secondary" href="eventos_activos.php" role="button">Regresar</a>
                    </div>
                   
                </div> 
            </form>
            <!-- Inicio busqueda DNI en el evento-->
                <?php
                    if(isset($_POST['btn_buscar_certificado']))
                    {
                        $dni_inscrito=$_POST['dni_inscrito'];
                        $nro_evento4=$_POST['nro_evento4'];
                        $fecha_hoy=$_POST['fecha_hoy'];
                        $estado_evento=$_POST['estado_evento'];
                        //consulta que enlaza 3 tablas, asimismo valida si la fecha actual es menos a la fecha del evento
                        //si el estado del evento esta cerrado,si el certificado esta creado
                        //y lo mas importante si el inscrito ha sido aprobado para tener el certificado
                        $consulta="SELECT a.id_certificado,a.anio, b.nro_evento,b.fecha,b.estado,c.id_inscripcion,
                                CONCAT(c.nombres_inscripcion,' ',c.apellidos_inscripcion) as nombres_completos,
                                c.dni_inscripcion,c.habilitacion_cert FROM certificado a inner join evento b on a.nro_evento=b.nro_evento
                                 inner join inscripcion c on b.nro_evento=c.nro_evento WHERE b.nro_evento='$nro_evento4' 
                                 and c.dni_inscripcion='$dni_inscrito' and a.id_certificado !='' and b.fecha<='$fecha_hoy'
                                  and b.estado='$estado_evento' and c.habilitacion_cert='habilitado'";
                        if(!$resultado=$miconex->query($consulta))
                            {
                                die ("Ha ocurrido un error en:[".$miconex->error."]");
                            }
                        if($fila=$resultado->fetch_assoc())
                            {
                                echo "<script>alertify.success('Usuario encontrado');</script>"; //codigo de js alertify
                                 
                ?>
            <!-- Mostrar datos en caso exista el inscrito-->
            <div class='alert alert-success container' role='alert'>Usted ha sido habilitado para obtener el certificado</div>
                <form class="container" method="post" action="certificado.php" enctype="multipart/form-data">
                    <table class="table table-hover">
                    <thead>
                        <tr class="table-secondary">
                            <th scope="col">Nro Incripcion</th>
                            <th scope="col">DNI</th>
                            <th scope="col">Nombres Completos</th>
                            <th scope="col">PDF</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr class="table-success">
                               
                                <td><input type="hidden" name="id_inscripcion" value="<?php echo $fila['id_inscripcion'];?>"><?php echo $fila['id_inscripcion'];?></td>
                                <td><?php echo $fila['dni_inscripcion'];?></td>
                                <td><input type="hidden" name="nombres_completos" value="<?php echo $fila['nombres_completos'];?>"><?php echo $fila['nombres_completos'];?></td>
                                <input type="hidden" name="anio" value="<?php echo $fila['anio'];?>">
                                <input type="hidden" name="id_certificado" value="<?php echo $fila['id_certificado'];?>">
                                <td><button type="submit" class="btn btn-primary mr-4" name="btn_buscar_cert">Descargar</button></td>
                            </tr>                        
                        </tbody>
                    </table>
                </form>
            <?php
                    }
                    else
                    {
                        echo "<script>alertify.error('Usted no esta apto para el certificado');</script>"; //codigo de js alertify
                        echo "<div class='alert alert-danger container' role='alert'>Usted no esta apto para el certificado</div>"; //mensaje
                    }
                }            
            ?>   
        <!-- Fin registrar inscripcion-->
        </div>
    </div>
        <!-- Inicio Pie de Pagina-->
    
        <footer class="footer">
            <p><b>© 2020 OFICINA DE ESTADISTICA E INFORMATICA - CSJAP</b></p>
        </footer>
        
    <script src="js/main.js"></script>
    
  </body>
</html>