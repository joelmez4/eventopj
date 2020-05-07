<?php
      if(isset($_POST['btn_registrar_expositor']))
      {
        $dni_expositor=$_POST['dni_expositor'];
        $nombre_completo=$_POST['nombres_expositor']." ".$_POST['apellidos_expositor'];
        $entidad=$_POST['entidad_expositor']; //primary key de la tabla usuarios
        $cargo_expositor=$_POST['cargo_expositor'];
        $correo_expositor=$_POST['correo_expositor'];
        $celular_expositor=$_POST['celular_expositor'];
       
        //consulta para buscar si ya existe un usuario con el mismo nombre
        $consulta="select * from expositor where dni='$dni_expositor'";
        if(!$resultado=$miconex->query($consulta))
        {
          die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
        }
        //si encuentra un usuario con el mismo nombre
        if($resultado->num_rows>0)
        {
          echo "<script>alertify.error('Ya existe el expositor con el mismo nombre, no se pudo insertar');</script>";
        }
        //si no encuentra un usuario con el mismo usuario
        else
        {
          $consulta="insert into expositor values('','$dni_expositor','$nombre_completo','$entidad','$cargo_expositor','$correo_expositor','$celular_expositor')";
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
 