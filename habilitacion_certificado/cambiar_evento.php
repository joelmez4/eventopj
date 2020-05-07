<?php
            require('../conexion.php');
            session_start();
            if($_SESSION['id_usuario']=="")
            {
                header("Location: index.php");    
            }
            $id_evento=$_GET['id_evento'];
  
            $consulta="UPDATE evento SET estado='cerrado' 
            WHERE nro_evento='$id_evento'";
            if(!$miconex->query($consulta))
            {
                die("No se pudo cerrar el estado por error en [".$miconex->error."]");
            }
            else
            {
                echo "<script>alert('Evento cerrado');</script>";  
                echo "<script>window.location='../cerrar_evento.php';</script>";  
                //header("location:/proyecto/ver_inscritos.php?id_evento=$nro_evento"); //si muestra mensaje
            }
      
        
        ?>