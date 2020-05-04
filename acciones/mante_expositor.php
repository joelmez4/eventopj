<?php
      if(isset($_POST['btn_registrar_expositor']))
      {
        $dni_expositor=$_POST['dni_expositor'];
        $nombre_completo=$_POST['nombres_expositor']." ".$_POST['apellidos_expositor'];
        $entidad=$_POST['entidad_expositor']; 
        $cargo_expositor=$_POST['cargo_expositor'];
        $correo_expositor=$_POST['correo_expositor'];
        $celular_expositor=$_POST['celular_expositor'];
       
       
        $consulta="select * from expositor where dni='$dni_expositor'";
        if(!$resultado=$miconex->query($consulta))
        {
          die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
        }
       
        if($resultado->num_rows>0)
        {
          echo "<script>alertify.error('Ya existe el expositor con el mismo nombre, no se pudo insertar');</script>";
        }
        
        else
        {
          $consulta="insert into expositor values('','$dni_expositor','$nombre_completo','$entidad','$cargo_expositor','$correo_expositor','$celular_expositor')";
          if(!$miconex->query($consulta))
          {
            die ("no se pudo insertar insertar por error en: [".$miconex->error."]");
          }
          else
          {
            echo "<script>alertify.success('Registrado Correctamente');</script>"; 
          }
        }
      }
    ?>            
  
 