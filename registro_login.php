<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Hello, world!</title>

  
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/alertify.css">
    <script src="js/alertify.js"></script>
    
    
  </head>
  <body background="images/pj3-transparente.png">
   
    <div id="login">
        
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <div class="text-center mb-2"><img src="images/pj.jpg" class=""></div>
                            <h3 class="text-center">Registro de Usuario</h3>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Ingrese DNI:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control mb-2" name="dni_usuario" maxlength="8">
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-dark" name="btn_buscar_dni_usuario">Buscar</button>
                                </div>                                
                            </div> 
                        </form>
                        <?php
                            if(isset($_POST['btn_buscar_dni_usuario']))
                            {
                                $dni_usuario=$_POST['dni_usuario'];
                                $consulta="select * from usuario where dni_usuario='$dni_usuario'";
                                if(!$resultado=$miconex->query($consulta))
                                {
                                    die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
                                }
                                //si encuentra inscrito con el mismo nombre
                                if($resultado->num_rows==0)
                                {
                                    echo "<script>alertify.error('no existe usuario, comuniquese con el administrador del sistema');</script>";//codigo de js alertify
                                    echo "<div class='alert alert-danger container' role='alert'>no existe usuario, comuniquese con el administrador del sistema</div>"; //mensaje
                                }
                                if($fila=$resultado->fetch_assoc())
                                {
                                    if($fila['password']!="")
                                    {
                                        echo "<script>alertify.error('El usuario ya existe, coordine con el administrador para cambiar su contraseña');</script>";//codigo de js alertify
                                        echo "<div class='alert alert-danger container' role='alert'>El usuario ya existe, coordine con el administrador para cambiar su contraseña</div>"; //mensaje
                                    }
                                    else
                                    {
                                        echo "<script>alertify.success('Encontrado');</script>"; //codigo de js alertify
                                        echo "<div class='alert alert-success container' role='alert'>Por favor ingrese su contraseña</div>"; //mensaje
                        ?>
                        <form id="" class="form" action="" method="post">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Usuario:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control mb-2" name="text_usuario" value="<?php echo $fila['id_usuario']; ?>">
                                </div>                             
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Ingrese Contraseña:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control mb-2" name="text_password">
                                </div>  
                                <label class="col-sm-4 col-form-label">Repita Contraseña:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control mb-2" name="text_repassword">
                                </div>                             
                            </div> 
                             <div class="form-group row">
                                <div class="col-sm-6">
                                    <input class="btn btn-primary btn-block mb-2" name="btn_registrar_usuario" type="submit" value="Registrar">
                                </div>
                                <div class="col-sm-6">
                                    <a class="btn btn-danger btn-block" href="index.php" role="button">Regresar</a>
                                </div>
                            </div>                           
                        </form>
                        <?php
                                    }
                                }
                            }
                        if(isset($_POST['btn_registrar_usuario']))
                            {
                                $id_usuario=$_POST['text_usuario'];
                                $password=$_POST['text_password'];
                                $repassword=$_POST['text_repassword'];
                                if($password==$repassword)
                                {
                                    $password_md5=md5($password);
                                       
                                    $consulta1="UPDATE usuario SET password='$password_md5' WHERE id_usuario='$id_usuario'";
                                    if(!$miconex->query($consulta1))
                                    {
                                        die ("no se pudo insertar usuario [".$miconex->error."]");
                                    }

                                    else
                                    {
                                        echo "<script>alertify.success('Registrado correctamete');</script>"; //codigo de js alertify
                                        echo "<div class='alert alert-success container' role='alert'>Registrado Correctamente</div>"; //mensaje
                                       // Duerme durante cinco segundos.
                                        //sleep(5); pero no muestra mensaje
                                       //Establecer el encabezado de actualización utilizando PHP.
                                        header("refresh:3;url=index.php"); //si muestra mensaje
                                    }
                                }
                                else
                                {
                                    echo "<script>alertify.success('No coinciden claves');</script>"; //codigo de js alertify; //mensaje
                                }
                            }
                    ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>

</hmtl>