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
    <!-- Inicio Buscador-->
    <div class="container-fluid table-responsive">
      <div class="d-inline container text-center"><h3><span class="badge badge-light">Expositores</span></h3></div>
      <form class="container">
        <div class="form-group row container">
          <label for="staticEmail" class="col-sm-2 col-form-label"><b>Buscar:</b></label>
          <div class="col-sm-6">
             <input type="text"  class="form-control" id="text_buscar_expositor" name="text_buscar_expositor"><br/>
          </div>
          <div class="col-sm-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registroexpositor">Registrar Expositor</button>
          </div>
        </div>
      </form>
      <!-- Fin buscador-->
      <!-- Inicio Contenido-->
      <div class="container" id="datos_expositores">

      </div>
    </div>
  <!-- Fin Contenido-->
  <!-- Inicio Pie de Pagina-->
    <?php
      include('maqueta/footer.php');   
    ?>
  <!-- Fin Pie de Pagina-->
  <!-- Modal para insertar usuario -->
  <div class="modal fade" id="registroexpositor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Registro de Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- formulario buscar dni -->
          <form class="form-inline" method="post">
            <div class="form-group mb-2">
              <label for="exampleFormControlInput1">DNI:</label>
            </div>
            <div class="form-group mx-3 mb-2 ml-sm-1">
              <input type="text" class="form-control" placeholder="" id="dni" name="dni" maxlength="8" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
            </div>
            <button type="button" class="btn btn-dark  mx-3 mb-2 ml-sm-1" id="botoncito">Buscar</button>
          </form>
          <!-- fin formulario buscar dni -->
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
                            $('#mostrar_dni').val((datos[0]));
                            $('#nombres').val((datos[1]));
                            $('#paterno').val((datos[2]+" "+datos[3]));                            
                    }
                });
                return false;
                });
            });
          </script>
          <!-- script busqueda dni -->
          <!-- fin busqueda dni -->
          <!-- formulario registro de datos-->
          <form autocomplete="off" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="form-row d-flex flex-column flex-sm-row mt-sm-2">
               <input type="hidden" class="form-control" id="mostrar_dni" name="dni_expositor"> 
              <div class="col">
                <input type="text" class="form-control" placeholder="Nombres" id="nombres" name="nombres_expositor" required="">
              </div>
              <div class="col">
                <input type="text" class="form-control" placeholder="Apellidos" id="paterno" name="apellidos_expositor" required="">
              </div>
            </div>
            <div class="form-row d-flex flex-column flex-sm-row mt-sm-2">
              <div class="col">
                <input type="text" class="form-control" placeholder="Entidad: Ejemplo CSJ APURIMAC" name="entidad_expositor"  list="listaentidad" required="">
                    <datalist id="listaentidad">
                      <option value="CSJ Apurimac">
                      <option value="Fiscalia">
                    </datalist>
              </div>
            </div>
            <div class="form-row d-flex flex-column flex-sm-row mt-sm-2">
              <div class="col">
                <input type="text" class="form-control" placeholder="Cargo" name="cargo_expositor" required="">
              </div>
            </div>
            <div class="form-row d-flex flex-column flex-sm-row mt-sm-2">
              <div class="col">
                <input type="text" class="form-control" placeholder="correo" name="correo_expositor">
              </div>
              <div class="col">
                <input type="text" class="form-control" placeholder="Celular" name="celular_expositor" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
              </div>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" name="btn_registrar_expositor">Registrar</button>
            </div>
          </form>
          <?php
              include('acciones/mante_expositor.php'); 
          ?>
      </div>
    </div>
  </div>
  <!-- Fin para insertar usuario -->
  <!-- Fin Modal para insertar usuario -->    
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
  </body>
</hmtl>