<?php
    require('../conexion.php');
    $salida=""; //todo lo que se mostrara en la pagina de index.php
    $query="select nro_evento,tipo_evento,nombre_evento,lugar,direccion,fecha,hora,estado from evento ORDER BY fecha DESC";
    if(isset($_POST['consulta'])){
        $q=$miconex->real_escape_string($_POST['consulta']); //cuestion de seguridad por si en la caj de texto viene un caracter especial
        $query="select nro_evento,tipo_evento,nombre_evento,lugar,direccion,fecha,hora,estado from evento
                where tipo_evento like '%".$q."%' OR nombre_evento like '%".$q."%' OR lugar like '%".$q."%' ORDER BY fecha DESC";
    }
    if((isset($_POST['desde'])) & (isset($_POST['hasta']))){ // si las fechas desde y hasta existen entonces
        $desde=$_POST['desde']; //scamos la variable de la fecha inicio
        $hasta=$_POST['hasta']; //sacamos la variable de la fecha fin
        $query="select nro_evento,tipo_evento,nombre_evento,lugar,direccion,fecha,hora,estado from evento where
        fecha BETWEEN '$desde' AND '$hasta' ORDER BY fecha DESC";
    }
    $resultado=$miconex->query($query); // ejecutamos la consulta y lo guardamos en la variable resultado
    if(!$resultado=$miconex->query($query))
    {
        die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
    }
    if($resultado->num_rows>0){  //si se encontro un elemento en la consulta
        //concatenamos la variable salida puesto que salida es lo que mostrara al final en la pagina index.htmls
        //class=d-none d-sm-block ---Solo cuando sea pequeño que se ocultela columna-->
        $salida.="<p class='lead'><span>Cantidad de Eventos: <b>".$resultado->num_rows."</b></span></p>
                <table class='table table-hover table-active container mt-0 table-sm'>
                    <thead class='thead-dark'>
                        <tr>
                            <th scope='col' class='text-center align-middle'>Tipo Evento</th>
                            <th scope='col' class='text-center align-middle'>Nombre del Evento</th>
                            <th scope='col' class='text-center align-middle'>Lugar</th>
                            <th scope='col' class='text-center align-middle'><div class='d-none d-sm-block'>Direccion</div></th>
                            <th scope='col' class='text-center align-middle'>Fecha</th>
                            <th scope='col' class='text-center align-middle'>Hora</th>
                            <th scope='col' class='text-center align-middle'>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>"; 
        while($fila=$resultado->fetch_assoc()) //pasamos los resualdos de la consulta con fetch_assoc a un tipo arreglo de variable fila
            {
                //seguimos concatenando la variable salida
                $salida.=" <tr>
                                <td>".$fila['tipo_evento']."</td>
                                <td class='text-justify'>".$fila['nombre_evento']."</td>
                                <td class='text-justify'>".$fila['lugar']."</td>
                                <td class='text-justify'><div class='d-none d-sm-block'>".$fila['direccion']."</div></td>
                                <td>".fecha_mostrar($fila['fecha'])."</td>
                                <td>".hora_mostrar($fila['hora'])."</td>
                                <td class='text-center '>
                                    <a class='btn btn-primary mb-2' href='index.php?idusuario=".$fila['nro_evento']."' role='button' data-toggle='modal' data-target='#verusuario'><img src='icons/ver.png' class='rounded mx-auto d-block' alt='...'></a>
                                    <a class='btn btn-success mb-2' href='ver_video.php?codigo=".$fila['nro_evento']."' role='button'><img src='icons/actualizar.png' class='rounded mx-auto d-block' alt='...'></a>
                                    <a class='btn btn-danger' href='ver_video.php?codigo=".$fila['nro_evento']."' role='button'><img src='icons/eliminar.png' class='rounded mx-auto d-block' alt='...'></a>
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