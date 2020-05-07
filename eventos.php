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
    <script type="text/javascript">
        //para insertar ponentes en el text area cuando se selecciones en el combo box
        function actualizar(select){
            var val = select.value;
            document.getElementById('inserta_ponentes').value += "Dr. "+val+"\n";
            }   
    </script>
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
      <div class="d-inline container text-center"><h3><span class="badge badge-light">Eventos</span></h3></div>
      <div class="container text-danger"> * busqueda por nombre evento y/o fechas asignadas </div>
      <form class="container">
        <div class="form-group row container">
          <label for="staticEmail" class="col-form-label"><b>Buscar:</b></label>
          <div class="col-sm-4">
             <input type="text"  class="form-control" id="text_buscar_evento" name="text_buscar_evento">
          </div>
          <label for="staticEmail" class="col-form-label Dark link"><b>DESDE:</b></label>
          <div class="col-sm-3">
             <input type="date"  class="form-control" id="text_fechaini_evento" name="text_fechaini_evento">
          </div>
          <label for="staticEmail" class="col-form-label Dark link"><b>HASTA:</b></label>
          <div class="col-sm-3">
             <input type="date"  class="form-control" id="text_fechafin_evento" name="text_fecha_fin_evento"><br/>
          </div>
          <div class="col-sm-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registroevento">Registrar Evento</button>
          </div>
        </div>
      </form>
      <!-- Fin buscador-->
      <!-- Inicio Contenido-->
      <div class="container" id="datos_eventos">

      </div>
    </div>
  <!-- Fin Contenido-->
  <!-- Inicio Pie de Pagina-->
    <?php
      include('maqueta/footer.php');   
    ?>
  <!-- Fin Pie de Pagina-->
  <!-- Modal para insertar evento -->
  <div class="modal fade" id="registroevento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Registro de Evento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- formulario registro evento-->
          <form class="form" method="POST" action="">
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Tipo de Evento</label>
                <div class="col-sm-9">
                  <select name="tipo_evento" class="form-control" required="">
                    <option selected>...Seleccione una Opcion...</option>
                    <option value="Curso">Curso</option> 
                    <option value="Seminario">Seminario</option>
                    <option value="Seminario Taller">Seminario Taller</option>
                    <option value="Charla">Charla</option>    
                    <option value="Charla Informativa">Charla Informativa</option>                   
                    <option value="Reunion">Reunion</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Nombre del Evento</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" required="" name="nombre_evento" placeholder="Ejemplo: Lavado de Activos en el VRAE">
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-1 col-form-label">Ponentes:</label>
                <div class="col-sm-5">
                  <select name="" class="form-control" onChange="actualizar(this)">
                    <option selected>...Seleccione una Opcion...</option>
                    <?php
                      $carga_expositores="select nombre_completo from expositor";
                      $resultado=$miconex->query($carga_expositores); // ejecutamos la consulta y lo guardamos en la variable resultado
                      if(!$resultado=$miconex->query($carga_expositores))
                      {
                          die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
                      }
                      if($resultado->num_rows>0){
                        while($fila=$resultado->fetch_assoc()) //pasamos los resualdos de la consulta con fetch_assoc a un tipo arreglo de variable fila
                        {
                          echo "<option id=''>".$fila['nombre_completo']."</option>";
                        }
                      }
                      else
                      {
                        echo "<option id=' '>no se pudo cargar datos</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="col-sm-6">
                  <textarea class="form-control" id="inserta_ponentes" name="ponentes" rows="2" placeholder="<--- seleccione un ponente"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="container text-danger">
                  * En caso no se encuentre el expositor registralo aqui: 
                  <a class="btn btn-primary" href="expositor.php" role="button">Ir a Registro de Expositores</a> 
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Lugar del Evento</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="" placeholder="Ejemplo:Auditorio Jose Maria Arguedas" name="lugar_evento" list="listalugar">
                  <datalist id="listalugar">
                    <option value="Auditorio Jose Maria Arguedas de la Corte Superior de Justicia de Apurimac">
                    <option value="Auditorio de Andahuaylas..">
                  </datalist>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Direccion del Evento:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="" placeholder="Ejemplo:Av. Diaz Barcenas" name="direccion_evento" list="listadireccion">
                  <datalist id="listadireccion">
                    <option value="Av. Diaz Barcenas Nro 100">
                    <option value="Av. Ayacucho">
                  </datalist>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="">Fecha</label>
                  <input type="date" class="form-control" id="" name="fecha_evento">
                </div>
                <div class="form-group col-md-6">
                  <label for="">Hora</label>
                  <select name="hora_evento" class="form-control">
                      <?php
                        //bucle para la hora de 08:00 a 08:00 PM
                        for ($date = strtotime("08:00 AM"); $date <= strtotime("08:00 PM"); $date = strtotime("+30 minutes", $date)) {
                          echo '<option value="'.date("h:i A", $date).'">'.date("h:i A", $date).'</option>';
                        }
                      ?>
                  </select>
                </div>
              </div>
         <!-- fin formularioregistro evento -->
          
          <!-- fin busqueda dni -->
          <!-- formulario registro de datos -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" name="btn_registrar_evento">Registrar</button>
            </div>
          </form>
          <?php
             if(isset($_POST['btn_registrar_evento']))
             {
               $tipo_evento=$_POST['tipo_evento'];
               $nombre_evento=$_POST['nombre_evento'];
               $ponentes=$_POST['ponentes']; 
               $lugar_evento=$_POST['lugar_evento'];
               $direccion_evento=$_POST['direccion_evento'];
               $fecha_evento=$_POST['fecha_evento'];
               $hora_evento=hora_bd($_POST['hora_evento']); //llamar a hora_bs para insertar en laa base de datos
              
               //consulta para insertar evento
                 $consulta="insert into evento values('','$tipo_evento','$nombre_evento','$ponentes','$lugar_evento','$direccion_evento','$fecha_evento','$hora_evento','abierto')";
                 if(!$miconex->query($consulta))
                 {
                   die ("no se pudo insertar insertar por error en: [".$miconex->error."]");
                 }
                 else
                 {
                   echo "<script>alertify.success('Registrado Correctamente');</script>"; //codigo de js alertify
                 }
               
             }
          ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin para insertar usuario -->
  <!-- Fin Modal para insertar usuario -->    
    <script src="js/jquery.js"></script>
  
    <script src="js/main.js"></script>
   
    <!-- Scrip para hora - time -->  
  
  </body>
</hmtl>