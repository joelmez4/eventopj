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
          <div class="d-inline container text-center"><h3><span class="badge badge-light">Generar Certificado</span></h3></div>
          <div class="d-inline container text-center"><h4><span class="badge badge-light"><?php echo $nombre_completo_evento;?></span></h4></div>
          <div class="container text-danger mb-2"> *llena los datos</div>
          <form class="container" method="post" action="" enctype="multipart/form-data">
              <div class="form-group row">
                  <label class="col-sm-3 col-form-label"><strong>Ingrese Nombre Certificado:</strong></label>
                  <div class="col-sm-5">
                      <input type="text" class="form-control mb-2" name="nombre_cert">
                  </div>
                  <input type="hidden" name="codigo_evento" value="<?php echo $nro_evento; ?>">
                  <input type="hidden" name="estado_evento" value="<?php echo $estado_evento; ?>">
                  <input type="hidden" name="fecha_evento" value="<?php echo $fecha_evento; ?>">
                  <input type="hidden" name="fecha_hoy" value="<?php echo fecha_actual(); ?>">
                  <label class="col-sm-2 col-form-label"><strong>Año:</strong></label>
                  <div class="col-sm-2">
                    <select class="form-control" name="ano_cert">
                      <option value="2020">2020</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                    </select>
                  </div>
              </div> 
              <div class="form-group row">
                <label class="col-sm-3 col-form-label"><strong>Escoja una imagen (jpg,png):</strong></label>
                <div class="col-sm-5">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="" name="archivo" required accept="image/*">
                    <label class="custom-file-label" for="validatedCustomFile">-- Formato .png , .jpg --</label>
                  </div>
                </div>
                <script>
                  // Add the following code if you want the name of the file appear on select
                  $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                  });
                </script>
              </div> 
              <div class="form-group row text-center">
                  <div class="col-sm-6">
                      <button type="submit" name="btn_crear_certificado" class="btn btn-primary mb-2 btn-block">Crear Certificado</button>
                  </div>
                  <div class="col-sm-6">
                      <a class="btn btn-success mb-2 btn-block" href="eventos_cerrados.php" role="button">Regresar</a>
                  </div>
              </div>      
          </form>
          <!-- Fin buscador-->
        
        
    
          <?php
            if(isset($_POST['btn_crear_certificado']))
            {
              $nombre_certificado=$_POST['nombre_cert'];
              $ano_certificado=$_POST['ano_cert'];
              $codigo_evento=$_POST['codigo_evento'];
              $estado_evento=$_POST['estado_evento'];
              $fecha_hoy=$_POST['fecha_hoy'];
              $fecha_evento=$_POST['fecha_evento'];
              $consulta="select a.id_certificado,b.nro_evento from certificado a inner join evento b on 
                        a.nro_evento=b.nro_evento where b.nro_evento='$codigo_evento'";
              if(!$resultado=$miconex->query($consulta))
              {
                  die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
              }
              //si encuentra inscrito con el mismo nombre
              if($resultado->num_rows>0)
              {
                  echo "<script>alertify.error('Ya existe un certificado para el presente evento');</script>";
                  echo "<div class='p-3 mb-2 bg-danger text-white container'>Ya existe un certificado para el presente evento</div>"; //mensaje
              }
              elseif($estado_evento=="cerrado" && $fecha_hoy>=$fecha_evento)
              {
                      $consulta="insert into certificado values('','$nombre_certificado','$ano_certificado','$codigo_evento')";
                      if(!$miconex->query($consulta))
                      {
                          die ("no se pudo insertar insertar por error en: [".$miconex->error."]");
                      }
                      else
                      {
                          $id_insert=$miconex->insert_id; //recoge el id que se inserto el la consulta
                          if($_FILES["archivo"]["error"]>0) //si el archivo escogido tipo file es incorrecto o esta vacio
                          {
                              echo "<div class='p-3 mb-2 bg-danger text-white container'>error al cargar archivo<div>"; //mensaje
                          }
                          else //si no hay error en el archivo
                          {
                              //fomatos permitidos a cargar
                              //"application/pdf"
                              $permitidos=array("image/png","image/jpeg"); //permitir solo en fomrato png y pdf
                              $limite_kb=5000;
                              //si el archivo es de tipo pdf o png y no pesa menor que 5000 kb osea 5megas
                              if(in_array($_FILES["archivo"]["type"],$permitidos) && $_FILES["archivo"]["size"]<=$limite_kb*1024)
                              {
                                  //creamos la ruta donde se guardara las imagenes
                                  $ruta='certificado/'.$id_insert.'/'; //nos saldra files/4/ donde 4 la id del certiicado
                                  //nombre del archivo a guardar
                                  $archivo=$ruta.$_FILES["archivo"]["name"]; //saldra files/4/imagen.png la ruta donde se guardara el archivo
                                  //verificar que exista la ruta
                                  if(!file_exists($ruta)) //si no existe la ruta
                                  {
                                      mkdir($ruta); //creamos la ruta osea crea las carpetas , cada archivo que se vaya creando va crear tambien su carpeta
                                  }
                                  //validacion en caso de archivos duplicados
                                  if(!file_exists($archivo)) //si no existe el archivo
                                  {
                                      $resultado=@move_uploaded_file($_FILES["archivo"]["tmp_name"],$archivo); //mueve el archivo que estoy creando en el formulario, que archivo a que ruta lo voy a mover
                                      //tmp_name ese es un nombre temporal que se le da a un archivo cuando lo cargas a un formulario
                                      //archivo es la ruta completa donde se movera el archivo guardado
                                      //la variable resultado retornara un true o un false si es true entonces se guardo correctamente
                                      if($resultado) //si es verdadero
                                      {
                                          echo "<script>alertify.success('Certificado Creado Correctamente');</script>"; //codigo de js alertify
                                          echo "<div class='p-3 mb-2 bg-success text-white container'>Certificado creado correctamente<div>"; //mensaje
                                      }
                                      else{
                                          echo "<div class='p-3 mb-2 bg-danger text-white container'>Error al Guardar<div>"; //mensaje
                                      }
                                  }
                                  else{
                                      echo "<div class='p-3 mb-2 bg-danger text-white container'>el archivo ya existe<div>"; //mensaje
                                  }
                              }   
                              else{
                                  echo "<div class='p-3 mb-2 bg-danger text-white container'>Archivo no permitido o demasiado pesado<div>"; //mensaje
                              } 
                          }
                          
                    }
              }  
              else{
                      echo "<script>alertify.error('no se pudo crear, el evento sigue disponible o no esta cerrado');</script>";//codigo de js alertify
                      echo "<div class='p-3 mb-2 bg-danger text-white container'>no se pudo crear, el evento sigue disponible o no esta cerrado</div>"; //mensaje
                  }  
            }
          ?>
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