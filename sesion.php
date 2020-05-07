<?php
      session_start();
      if($_SESSION['id_usuario']=="")
      {
          header("Location: index.php");    
      } 
      $nombre_usuario_sesion= $_SESSION['nombre'];
?> 