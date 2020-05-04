<?php
    require('../conexion.php');
    $salida=""; 
    $query="select nro_evento,tipo_evento,nombre_evento,ponentes,fecha,hora,estado from evento where estado='abierto' ORDER BY fecha DESC";
    if(isset($_POST['consulta'])){
        $q=$miconex->real_escape_string($_POST['consulta']); 
        $query="select nro_evento,tipo_evento,nombre_evento,ponentes,fecha,hora,estado from evento
                where tipo_evento like '%".$q."%' OR nombre_evento like '%".$q."%' ORDER BY fecha DESC";
    }
    if(isset($_POST['estado_evento'])){ 
        $estado=$_POST['estado_evento'];
        if($estado=="abierto") {
            $query="select nro_evento,tipo_evento,nombre_evento,ponentes,fecha,hora,estado from evento where estado='abierto' ORDER BY fecha DESC";
        }
        if($estado=="cerrado") {
            $query="select nro_evento,tipo_evento,nombre_evento,ponentes,fecha,hora,estado from evento where estado='cerrado' ORDER BY fecha DESC";
        }
        if($estado=="todos") {
            $query="select nro_evento,tipo_evento,nombre_evento,ponentes,fecha,hora,estado from evento ORDER BY fecha DESC";
        }

    }
    $resultado=$miconex->query($query); 
    if(!$resultado=$miconex->query($query))
    {
        die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
    }
    if($resultado->num_rows>0){  
             
        $salida.="<p class='lead container'><span>Cantidad de Eventos: <b>".$resultado->num_rows."</b></span></p>";
        while($fila=$resultado->fetch_assoc()) 
            {
                
                    $nombre_evento=$fila['tipo_evento'].': '.$fila['nombre_evento'];
                    $fecha_hora_evento=$fila['fecha'].' '.$fila['hora'];
                    $estado_eventos=$fila['estado'];
                    //seguimos concatenando la variable salida
                    $salida.=" <div class='card border-success mb-3'>
                                        <div class='card-header border-success text-center'>
                                            <strong class='text-uppercase'>Fecha: ".fecha_mostrar2($fila['fecha'])."</strong><strong class='p-5'> Hora: ".hora_mostrar($fila['hora'])."</strong>
                                        </div>
                                        <div class='card'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>".$fila['tipo_evento']."</h5>
                                                <p class='card-text'>".$fila['nombre_evento']."</p>
                                                <p class='card-text'><em>Ponentes: ".$fila['ponentes']."</em></p>";
                                                if($estado_eventos=="abierto"){ 
                                                    $salida.="<div class='form-group row text-center'>
                                                        <div class='col-sm-4'>
                                                            <button type='button' class='btn btn-primary btn-block mb-1' onClick='verdetalle_evento(/".$fila['nro_evento']."/)'><b>Ver Detalles</b></button>
                                                        </div>
                                                        <div class='col-sm-4'>
                                                            <a class='btn btn-success btn-block  mb-1' href='inscripcion.php?id_evento=".$fila['nro_evento']."' role='button'><b>Inscribirme</b></a>
                                                        </div>
                                                        <div class='col-sm-4'>
                                                        <a class='btn btn-secondary btn-block' href='verificar_inscripcion.php?id_evento=".$fila['nro_evento']."' role='button'><b>Verificar Inscripcion</b></a>
                                                        </div>
                                                    </div>";
                                                }
                                                else
                                                {
                                                    $salida.="<div class='form-group row text-center'>
                                                    <div class='col-sm-6'>
                                                        <button type='button' class='btn btn-primary btn-block mb-1' onClick='verdetalle_evento(/".$fila['nro_evento']."/)'><b>Ver Detalles</b></button>
                                                    </div>
                                                    <div class='col-sm-6'>
                                                        <a class='btn btn-secondary btn-block' href='verificar_inscripcion.php?id_evento=".$fila['nro_evento']."' role='button'><b>Verificar Inscripcion</b></a>
                                                    </div>
                                                </div>";
                                                }
                                 
                    $salida.="              </div>
                                        </div>
                                                      
                            </div>";
            }
                                             
    }
    else{
        $salida.="No existen Eventos / Eventos no registrado";
    }
    echo $salida;
        
$miconex->close();
 
?>