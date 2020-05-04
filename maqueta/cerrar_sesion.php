<?php
  session_start();
  unset($_SESSION["nombre"]); 
  unset($_SESSION["id_usuario"]);
  unset($_SESSION["tipo"]);
  session_destroy();
  header("Location: ../index.php");
  exit;
?>
