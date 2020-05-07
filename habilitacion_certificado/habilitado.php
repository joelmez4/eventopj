<?php
    require('../conexion.php');
    $nro_evento=$_GET['codigo'];
    $id_inscrito=$_GET['id_inscrito'];
    $consulta3="UPDATE inscripcion SET habilitacion_cert='habilitado' 
        WHERE id_inscripcion='$id_inscrito' and nro_evento='$nro_evento'";
     if(!$miconex->query($consulta3))
     {
         die ("no se pudo insertar insertar por error en: [".$miconex->error."]");
     }
     else
     {  
         
        echo "<script>alert('Certificado Habilitado');</script>";  
        echo "<script>window.location='/proyecto/ver_inscritos.php?id_evento=$nro_evento';</script>";  
         //header("location:/proyecto/ver_inscritos.php?id_evento=$nro_evento"); //si muestra mensaje
       

     }
?>