<?php
    header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=reporte.xls');
    require('conexion.php');
    $estado_cert=$_POST['estado_certificado'];
    $nro_evento=$_POST['nroevento'];
    $query="";
    if($estado_cert=="todos")
    {
	    $query="SELECT a.id_inscripcion,a.dni_inscripcion,CONCAT(a.apellidos_inscripcion,' ',a.nombres_inscripcion) AS nombres_completos, 
        a.correo,a.telefono,a.habilitacion_cert,a.nro_evento, b.nro_evento,c.id_certificado, c.anio FROM inscripcion a 
        inner join evento b on a.nro_evento=b.nro_evento INNER JOIN certificado c 
        on b.nro_evento=c.nro_evento where b.nro_evento='$nro_evento' 
        ORDER BY nombres_completos ASC";
    }
    elseif($estado_cert=="habilitado")
    {
        $query="SELECT a.id_inscripcion,a.dni_inscripcion,CONCAT(a.apellidos_inscripcion,' ',a.nombres_inscripcion) AS nombres_completos, 
        a.correo,a.telefono,a.habilitacion_cert,a.nro_evento, b.nro_evento,c.id_certificado, c.anio FROM inscripcion a 
        inner join evento b on a.nro_evento=b.nro_evento INNER JOIN certificado c 
        on b.nro_evento=c.nro_evento where b.nro_evento='$nro_evento' AND habilitacion_cert='habilitado' 
            ORDER BY nombres_completos ASC";
    }
    else
    {
        $query="SELECT a.id_inscripcion,a.dni_inscripcion,CONCAT(a.apellidos_inscripcion,' ',a.nombres_inscripcion) AS nombres_completos, 
        a.correo,a.telefono,a.habilitacion_cert,a.nro_evento, b.nro_evento,c.id_certificado, c.anio FROM inscripcion a 
        inner join evento b on a.nro_evento=b.nro_evento INNER JOIN certificado c 
        on b.nro_evento=c.nro_evento where b.nro_evento='$nro_evento' AND habilitacion_cert='deshabilitado' 
        ORDER BY nombres_completos ASC";
    }
    
    $resultado=$miconex->query($query); 
	
    
?>

    <table style="border: 1px solid black">
        <tr style="">
            <th>Nro-Correlativo</th>
            <th>Nombres Completos</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Estado Certificado</th>
        </tr>
        <?php
          while($fila=$resultado->fetch_assoc())  //pasamos los resualdos de la consulta con fetch_assoc a un tipo arreglo de variable fila
           {
            
            
               $correlativo=$fila['id_inscripcion']." --- ".$fila['anio'];
            
                ?>
                    <tr style="">
                        <td><?php echo $correlativo; ?></td>
                        <td><?php echo $fila['nombres_completos']; ?></td>
                        <td><?php echo $fila['correo']; ?></td>
                        <td><?php echo $fila['telefono']; ?></td>
                        <td><?php echo $fila['habilitacion_cert']; ?></td>
                    </tr>	

                <?php
            }

        ?>
    </table>