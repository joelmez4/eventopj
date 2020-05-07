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
    <div style="min-height: 100vh;">
  
    <!-- Inicio Buscador-->
    
        <div class="container-fluid table-responsive">
        <div class="d-inline container text-center"><h3><span class="badge badge-light">Eventos Abiertos</span></h3></div>
        <div class="container text-danger"> * lista de todos los eventos abiertos</div>
        <form class="container">
            <div class="form-group row container">
            <label for="staticEmail" class="col-form-label"><b>Buscar Evento:</b></label>
            <div class="col-sm-8">
                <input type="text"  class="form-control" id="text_evento_a_cerrar" name="text_evento_a_cerrar">
            </div>
            </div>
        </form>
        <!-- Fin buscador-->

        <!-- Inicio Contenido-->
        <div class="container" id="evento_a_cerrar">

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
</hmtl>