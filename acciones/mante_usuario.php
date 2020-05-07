  <?php
      if(isset($_POST['btn_registrar']))
      {
        $dni_usuario=$_POST['dni_usuario'];
        $nombre_usuario=$_POST['nombre_usuario'];
        $apellidos_usuario=$_POST['apellidos_usuario'];
        $user_name=$_POST['user_name']; //primary key de la tabla usuarios
        $tipo_usuario=$_POST['tipo_usuario'];
        $telefono=$_POST['telefono'];
        $correo_pj=$_POST['correo_pj'];
        $cargo=$_POST['cargo'];
        //consulta para buscar si ya existe un usuario con el mismo nombre
        $consulta="select * from usuario where id_usuario='$user_name'";
        if(!$resultado=$miconex->query($consulta))
        {
          die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
        }
        //si encuentra un usuario con el mismo nombre
        if($resultado->num_rows>0)
        {
          echo "<script>alertify.error('Ya existe usuario con el mismo nombre, no se pudo insertar');</script>";
        }
        //si no encuentra un usuario con el mismo usuario
        else
        {
          $consulta="insert into usuario values('$user_name','','$dni_usuario','$nombre_usuario','$apellidos_usuario','$cargo','$tipo_usuario','$correo_pj','$telefono')";
          if(!$miconex->query($consulta))
          {
            die ("no se pudo insertar insertar por error en: [".$miconex->error."]");
          }
          else
          {
            echo "<script>alertify.success('Registrado Correctamente');</script>"; //codigo de js alertify
          }
        }
      }
    ?>            
    <!-- IFin PHP para registrar usuario -->

