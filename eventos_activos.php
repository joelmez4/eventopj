<!doctype html>
<html lang="es">
  <head>

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
    ?>   
 
    <nav style="background-image: url('images/pj2.png'); background-repeat: repeat-x;  background-size: 40px 40px;">
        <img src="images/pj2.png" width="40" height="40"  alt="">
    </nav>
   
  <div style="min-height: 100vh;">  
    <div class="container-fluid table-responsive">
      
      <div class="text-center mt-2 container">
        
        <div class=" p-2 d-inline d-sm-inline-block"><img src="images/pj.jpg" class=""></div>
        <div class="p-2 d-inline d-sm-inline-block"><h4><span class="font-weight-bold">EVENTOS ACADEMICOS DE LA CORTE SUPERIOR DE JUSTICIA DE APURIMAC</span></h4></div>
        
      </div>
      <form class="container mt-2">
        <div class="form-group row container">
          <label for="staticEmail" class="col-sm-2 col-form-label"><b>Buscar:</b></label>
          <div class="col-sm-4">
             <input type="text"  class="form-control" id="text_eventos_pj" name="text_eventos_pj">
          </div>
          <p for="" class="col-sm-2 col-form-label"><b>Estado:</b></label>
          <div class="col-sm-4">
            <select class="form-control" id="estado_evento" name="estado_evento">
              <option value="abierto">Abierto</option>
              <option value="cerrado">Cerrado</option>
              <option value="todos">Todos</option>
            </select>
          </div>
        </div>
      </form>
     
      <div class="container" id="datos_eventos_pj">

      </div>
    </div>
    
  </div>
    
  <div class="modal fade" id="modal_detalle_evento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Detalle Evento - CSJ Apurimac</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modal_vereventos">
        


        </div>
      </div>
    </div>
  </div>

  <footer class="footer">
        <p><b>© 2020 OFICINA DE ESTADISTICA E INFORMATICA - CSJAP</b></p>
    </footer>

    <script src="js/main.js"></script>
  </body>
</hmtl>