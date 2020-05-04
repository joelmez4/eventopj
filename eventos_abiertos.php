<!doctype html>
<html lang="es">
  <head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Hello, world!</title>
  

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/alertify.css">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="js/alertify.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript">
        
        function actualizar(select){
            var val = select.value;
            document.getElementById('inserta_ponentes').value += "Dr. "+val+"\n";
            }   
    </script>
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
        <div class="d-inline container text-center"><h3><span class="badge badge-light">Eventos Abiertos</span></h3></div>
        <div class="container text-danger"> * lista de todos los eventos abiertos y disponibles para hacer su regsistro de entrada y salida</div>
        <form class="container">
            <div class="form-group row container">
            <label for="staticEmail" class="col-form-label"><b>Buscar Evento:</b></label>
            <div class="col-sm-8">
                <input type="text"  class="form-control" id="text_buscar_evento_abierto" name="text_buscar_evento_abierto">
            </div>
            </div>
        </form>
       
        <div class="container text-danger"> *Elija el evento y dale luego en registrar entrada o registrar salida segun corresponda</div>
      
        <div class="container" id="datos_eventos_abiertos">

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