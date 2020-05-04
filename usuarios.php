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
            <div class="d-inline container text-center"><h3><span class="badge badge-light">Usuarios Activados</span></h3></div>
            <form class="container">
              <div class="form-group row container">
                <label for="staticEmail" class="col-sm-2 col-form-label"><b>Buscar:</b></label>
                <div class="col-sm-10">
                  <input type="text"  class="form-control" id="text_buscar" name="text_buscar">
                </div>
              </div>
            <form>
        
            <div class="container" id="datos_usuarios">

            </div>
        
            <table class="table table-hover container text-center">
              <tbody>
                <tr>
                  <td colspan="4"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrousuario">Registrar Usuario</button></td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
     
          <?php
            include('maqueta/footer.php');   
          ?>
     
        <div class="modal fade" id="registrousuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Registro de Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              
                <form class="form-inline" method="post">
                  <div class="form-group mb-2">
                    <label for="exampleFormControlInput1">DNI:</label>
                  </div>
                  <div class="form-group mx-3 mb-2 ml-sm-1">
                    <input type="text" class="form-control" placeholder="" id="dni" name="dni">
                  </div>
                  <button type="button" class="btn btn-dark  mx-3 mb-2 ml-sm-1" id="botoncito">Buscar</button>
                </form>
              
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
               
                <form autocomplete="off" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                  <div class="form-row d-flex flex-column flex-sm-row mt-sm-2">
                    <input type="hidden" class="form-control" id="mostrar_dni" name="dni_usuario"> 
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Nombres" id="nombres" name="nombre_usuario">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Apellidos" id="paterno" name="apellidos_usuario">
                    </div>
                  </div>
                  <div class="form-row d-flex flex-column flex-sm-row mt-sm-2">
                    <div class="col">
                      <input type="text" class="form-control" placeholder="nombre de usuario" name="user_name">
                    </div>
                    <div class="col">
                      <select name="tipo_usuario" class="form-control">
                        <option selected>...Seleccione...</option>
                        <option value="usuario">Usuario</option>
                        <option value="administrador">Administrador</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row d-flex flex-column flex-sm-row mt-sm-2">
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Telefono" name="telefono">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Correo PJ" name="correo_pj">
                    </div>
                  </div>
                  <div class="form-row d-flex flex-column flex-sm-row mt-sm-2">
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Cargo" name="cargo">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="registrar" class="btn btn-primary" name="btn_registrar">Registrar</button>
                  </div>
                </form>
                <?php
                    include('acciones/mante_usuario.php'); 
                ?>
            </div>
          </div>
        </div>
      
  
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
  </body>
</hmtl>