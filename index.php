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
        <?php
        require('conexion.php');
        ?>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <div class="text-center mb-2"><img src="images/pj.jpg" class=""></div>
                            <h3 class="text-center">Acceso al Sistema</h3>
                            <div class="form-group">
                                <label for="username" class="">Usuario:</label><br>
                                <input type="text" name="username" id="username" required="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="">Contraseña:</label><br>
                                <input type="password" name="password" required="" id="password" class="form-control">                                
                            </div>
                            <div class="form-group">
                                <a href="registro_login.php" class="">Quiero Registrarme</a>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="ingresar" class="btn btn-info btn-block" value="Ingresar">
                            </div>
                        </form>
                    <?php
                        session_start();
                        
                        if(isset($_POST['ingresar']))
                        {
                            $username=$_POST['username'];
                            $password=md5($_POST['password']);
                            $consulta="select * from usuario where id_usuario='".$username."' and password='".$password."'";
                            $query=mysqli_query($miconex,$consulta);
                            $contador=mysqli_num_rows($query);
                            if($contador==1)
                            {
                                $fila=$query->fetch_assoc();
                                $nombre=$fila['nombres_user'];
                                $id_usuario=$fila['id_usuario'];
                                $tipo_usuario=$fila['tipo'];
                                $_SESSION['nombre']=$nombre; // Iniciando la sesion
                                $_SESSION['id_usuario']=$id_usuario;
                                $_SESSION['tipo']=$tipo_usuario;
                                echo "<script>alertify.success('Usuario Encontrado');</script>"; //codigo de js alertify
                                echo "<div class='alert alert-success container' role='alert'>Usuario encontrado, redireccionando...</div>"; //mensaje
                                // Duerme durante cinco segundos.
                                 //sleep(5); pero no muestra mensaje
                                //Establecer el encabezado de actualización utilizando PHP.
                                echo "<script>setTimeout(function () {
                                    // Redirigir con JavaScript
                                    window.location.href= 'eventos.php';
                                 }, 3000);</script>";
                                
                            }
                            else
                            {                
                                echo "<script>alertify.error('No se encontro usuario');</script>"; //codigo de js alertify
                                echo "<div class='alert alert-success container' role='alert'>No se encontro usuario</div>"; //mensaje
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