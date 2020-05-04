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
  
 
      <?php
          include('maqueta/menu.php');   
      ?>
    
    <br/>
    <br/>
    <br/>
    <div style="min-height: 100vh;">
  
 
    
        <div class="container-fluid table-responsive">
        <div class="d-inline container text-center"><h3><span class="badge badge-light">Eventos Cerrados</span></h3></div>
        <div class="container text-danger"> * lista de todos los eventos cerrados que ya culmino, procede a activar certificados</div>
        <form class="container">
            <div class="form-group row container">
            <label for="staticEmail" class="col-form-label"><b>Buscar Evento:</b></label>
            <div class="col-sm-8">
                <input type="text"  class="form-control" id="text_buscar_evento_cerrado" name="text_buscar_evento_cerrado">
            </div>
            </div>
        </form>
        
        <div class="container text-danger"> *Elija el evento y dale luego ver asistentes</div>
       
        <div class="container" id="datos_eventos_cerrados">

        </div>
        </div>
    </div>
  
    <?php
      include('maqueta/footer.php');   
    ?>
    
    <script src="js/jquery.js"></script>
  
    <script src="js/main.js"></script>
   
  
  
  </body>
</hmtl>