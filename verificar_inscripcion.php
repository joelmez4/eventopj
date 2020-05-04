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
  </head>
  <body  background="images/pj2-transparente.png">
  
   
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
         
    ?>   
    
 
    <nav style="background-image: url('images/pj2.png'); background-repeat: repeat-x;  background-size: 40px 40px;">
        <img src="images/pj2.png" width="40" height="40"  alt="">
    </nav>
    
<div style="min-height: 100vh;">
    
        <div class="container-fluid">
            <div class="text-center mt-2 container">
                <div class=" p-2 d-inline d-sm-inline-block"><img src="images/pj.jpg" class=""></div>
                <div class="p-2 d-inline d-sm-inline-block text-uppercase"><h4><strong><em><?php echo $nombre_completo_evento; ?></em></strong></h4></div>
        
            </div>
            <div class="text-center container">
                <div class="p-4 d-inline d-sm-inline-block"><strong>Fecha: <?php echo fecha_mostrar2($fila['fecha']); ?></strong></div>
                <div class="p-4 d-inline d-sm-inline-block"><strong>Hora: <?php echo hora_mostrar($fila['hora']); ?></strong></div>
            </div>
            <?php }?>
        
            <form class="container mt-2" method="post" action="">
            <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><strong>Ingrese DNI:</strong></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control mb-2" name="dni_inscrito" maxlength="8" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                    </div>
                    <input type="hidden" name="nro_evento1" value="<?php echo $nro_evento; ?>">
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-primary mr-4" name="btn_buscar_inscrito">Buscar</button>
                        <a class="btn btn-secondary" href="eventos_activos.php" role="button">Regresar</a>
                    </div>
                   
                </div> 
            </form>
          
                <?php
                    if(isset($_POST['btn_buscar_inscrito']))
                    {
                        $dni_inscrito=$_POST['dni_inscrito'];
                        $nro_evento1=$_POST['nro_evento1'];
                        $consulta="select id_inscripcion,dni_inscripcion,nombres_inscripcion,apellidos_inscripcion,fecha_inscripcion,
                                    hora_inscripcion,b.nro_evento,b.tipo_evento,b.nombre_evento from inscripcion a inner join 
                                    evento b on a.nro_evento=b.nro_evento where b.nro_evento='$nro_evento1' and dni_inscripcion='$dni_inscrito'";
                        if(!$resultado=$miconex->query($consulta))
                            {
                                die ("Ha ocurrido un error en:[".$miconex->error."]");
                            }
                        if($fila=$resultado->fetch_assoc())
                            {
                                echo "<script>alertify.success('Usuario encontrado');</script>";
                ?>
          
            <div class="text-danger container"> *Verificacion de datos no es necesario imprimir esta pagina, mejor tome una foto. **Recuerde el numero de ticket**</div>
            <h3 class="display-5 container"><small class="text-muted">NRO TICKET:  <?php echo $fila['id_inscripcion']; ?></small></h3>        
            <form class="container">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><strong>Nombre Completo:</strong></label>
                    <label class="col-sm-9 col-form-label"><?php echo $fila['nombres_inscripcion']." ".$fila['apellidos_inscripcion']; ?></label>             
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><strong>Fecha de Inscripcion:</strong></label>
                    <label class="col-sm-3 col-form-label"><?php echo fecha_mostrar($fila['fecha_inscripcion']); ?></label>
                    <label class="col-sm-3 col-form-label"><strong>Hora de Inscripcion:</strong></label>
                    <label class="col-sm-3 col-form-label"><?php echo hora_mostrar($fila['hora_inscripcion']); ?></label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-uppercase"><strong>Inscrito a <?php echo $fila['tipo_evento'].": ";?></strong></label>
                    <label class="col-sm-9 col-form-label text-uppercase"><em><?php echo $fila['nombre_evento'];?></em></label>
                </div>
            </form>
            <div class='p-3 mb-2 bg-success text-white container'>Se recomienda estar 10 minutos antes para realizar su registro respectivo</div>
            <?php
                    }
                    else
                    {
                        echo "<script>alertify.error('No se encontro usuario');</script>"; 
                        echo "<div class='p-3 mb-2 bg-danger text-white container'>Usted no esta inscrito dirijase a los eventos disponibles de la Corte Superior de Justicia de Apurimac, para realizar la inscripcion respectiva</div>"; 
                    }
                }            
            ?>   
     
        </div>
    </div>
       
    
        <footer class="footer">
            <p><b>© 2020 OFICINA DE ESTADISTICA E INFORMATICA - CSJAP</b></p>
        </footer>
        
    <script src="js/main.js"></script>
    
  </body>
</hmtl>