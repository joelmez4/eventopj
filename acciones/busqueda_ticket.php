<?php
    require('../conexion.php');
    $ticket = $_POST['ticket'];
    $nro_evento1=$_POST['nro_evento1'];
    $consulta="SELECT SELECT a.nro_evento,a.tipo_evento,a.nombre_evento,a.fecha,a.hora,a.estado,b.id_inscripcion,
                b.dni_inscripcion,b.nombres_inscripcion,b.apellidos_inscripcion FROM evento a inner join inscripcion b 
                on a.nro_evento=b.nro_evento where a.nro_evento='$nro_evento1' and b.id_inscripcion='$ticket'";
                 if(!$resultado=$miconex->query($consulta))
                 {
                     die ("Ha ocurrido un error en:[".$miconex->error."]");
                 }
             if($fila=$resultado->fetch_assoc())
                 {
                    $data['status'] = 'ok';
                    $data['result'] = $fila;
                 }
                 else{
                    $data['status'] = 'err';
                    $data['result'] = 'errorr';
                }
        //returns data as JSON format
        echo json_encode($data);;

?>