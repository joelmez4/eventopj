<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Hello, world!</title>
  

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/alertify.css">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="js/alertify.js"></script>
    <script src="js/bootstrap.js"></script>
   
  </head>
  <body background="images/pj2-transparente.png"> 
  
    <!-- Inicio conexion con base de datos-->
  
    <!-- Fin conexion con base de datos-->
    <!-- inicio menu -->
      <?php
          include('maqueta/menu.php');   
      ?>
    <!-- fin menu -->
    <br/>
    <br/>
    <br/>
    <?php
          $nro_evento=$_GET['id_evento'];
          $consulta="select nro_evento,tipo_evento,nombre_evento,fecha,estado from evento where nro_evento='$nro_evento'";
          if(!$resultado=$miconex->query($consulta))
          {
              die ("Ha ocurrido un error en:[".$miconex->error."]");
          }
          if($fila=$resultado->fetch_assoc())
          {
              $nombre_completo_evento=$fila['tipo_evento']." : ".$fila['nombre_evento'];
              $fecha_evento=$fila['fecha'];
              $estado_evento=$fila['estado'];
          }   
    ?>
    <div style="min-height: 100vh;">
  
    <!-- Inicio Buscador-->
    
        <div class="container-fluid table-responsive">
            <div class="d-inline container text-center"><h3><span class="badge badge-light"><?php echo $nombre_completo_evento;?></span></h3></div>
            <div class="d-inline container text-center"><h4><span class="badge badge-light"></span>Lista de Inscritos</h4></div>
            <div class="container text-danger"> *realice la busqueda por apellidos y/o dni</div>
            <form class="container" id="formulario_inscritos" method="post" action="reporte_inscritos_xls.php">
                <div class="form-group row container">
                    <label for="staticEmail" class="col-form-label"><b>Buscar Evento:</b></label>
                    <div class="col-sm-3 mb-2">
                        <input type="text"  class="form-control" id="text_buscar_inscrito" name="text_buscar_inscrito">
                        <input type="hidden" id="id_evento3" name="nroevento" value="<?php echo $nro_evento; ?>">
                    </div>
                    <label for="staticEmail" class="col-form-label"><b>Certificado:</b></label>
                    <div class="col-sm-2 mb-1">
                      <select class="form-control" id="estado_certificado" name="estado_certificado">
                        <option value="todos">Todos</option>
                        <option value="habilitado">Habilitado</option>
                        <option value="no_habilitado">No habilitado</option>
                      </select>
                    </div>
                    <div class="col-sm-2">
                        <a class='btn btn-danger btn-block mb-2' href='eventos_cerrados.php' role='button'>Regresar</a>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" id="btn_reporte_inscrito" class="btn btn-success btn-block">Excel</button>
                    </div>
                </div>
            </form>
            <!-- Fin buscador-->

            <!-- Inicio Contenido-->
            <div class="container" id="datos_inscritos_eventos">

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
   
    <!-- Scrip para hora - time -->  
  
  </body>
</html>