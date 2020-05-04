<?php
    require('../conexion.php');
    $salida=""; 
    $query="select nro_evento,tipo_evento,nombre_evento,fecha,hora,estado from evento where estado='cerrado' ORDER BY fecha DESC";
    if(isset($_POST['consulta'])){
        $q=$miconex->real_escape_string($_POST['consulta']);
        $query="select nro_evento,tipo_evento,nombre_evento,fecha,hora,estado from evento
                where estado='cerrado' AND tipo_evento like '%".$q."%' OR nombre_evento like '%".$q."%' ORDER BY fecha DESC";
    }
    $resultado=$miconex->query($query); 
    if(!$resultado=$miconex->query($query))
    {
        die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
    }
    if($resultado->num_rows>0){  
        $salida.="<p class='lead'><span>Cantidad de Eventos Cerrados: <b>".$resultado->num_rows."</b></span></p>
                <table class='table table-hover table-active container mt-0 table-sm'>
                    <thead class='thead-dark'>
                        <tr>
                            <th scope='col' class='text-center align-middle'>Nombre del Evento</th>
                            <th scope='col' class='text-center align-middle'>Fecha</th>
                            <th scope='col' class='text-center align-middle'>Hora</th>
                            <th scope='col' class='text-center align-middle'>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>"; 
        while($fila=$resultado->fetch_assoc()) 
            {
                
                $salida.=" <tr>
                                <td class='text-justify align-middle'>".$fila['tipo_evento'].": ".$fila['nombre_evento']."</td>
                                <td class='align-middle'>".fecha_mostrar2($fila['fecha'])."</td>
                                <td class='align-middle'>".hora_mostrar($fila['hora'])."</td>
                                <td class='text-center '>
                                    <a class='btn btn-primary btn-block mb-2' href='registrar_entrada_evento.php?id_evento=".$fila['nro_evento']."' role='button'>Ver Inscritos</a>
                                </td>
                            </tr>";
            }     
        $salida.="</tbody></table>";                            
    }
    else{
        $salida.="No existen Eventos / Eventos no registrado";
    }
    echo $salida;
        
$miconex->close();
 
?>