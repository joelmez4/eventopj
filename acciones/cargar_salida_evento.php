<?php
    require('../conexion.php');
    $salida=""; //todo lo que se mostrara en la pagina de index.php
    $nro_evento=$_POST['nro_evento_salida'];
    $query="SELECT id_asistente,dni_asistente,CONCAT(nombres_asistente,' ',apellidos_asistente) AS nombres_completos, 
            fecha_ingreso,hora_ingreso,hora_salida,nro_evento FROM asistentes_evento where nro_evento='$nro_evento' 
            ORDER BY hora_salida DESC";
    if(isset($_POST['consulta'])){
        $q=$miconex->real_escape_string($_POST['consulta']); //cuestion de seguridad por si en la caj de texto viene un caracter especial
        $query="SELECT id_asistente,dni_asistente,CONCAT(nombres_asistente,' ',apellidos_asistente) AS nombres_completos, 
        fecha_ingreso,hora_ingreso,hora_salida,nro_evento FROM asistentes_evento where nro_evento='$nro_evento' AND 
        dni_asistente like '%".$q."%' OR CONCAT(nombres_asistente,' ',apellidos_asistente) like '%".$q."%' ORDER BY
         hora_salida DESC";
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
                            <th scope='col' class='text-center align-middle'><div class='d-none d-sm-block'>DNI</div></th>
                            <th scope='col' class='text-center align-middle'>Nombres Completos</th>
                            <th scope='col' class='text-center align-middle'>Fecha</th>
                            <th scope='col' class='text-center align-middle'>Hora Ingreso</th>
                            <th scope='col' class='text-center align-middle'>Hora Salida</th>
                            <th scope='col' class='text-center align-middle'>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>"; 
        while($fila=$resultado->fetch_assoc()) //pasamos los resualdos de la consulta con fetch_assoc a un tipo arreglo de variable fila
            {
                //seguimos concatenando la variable salida
                $salida.=" <tr>
                                <td class='text-center align-middle'><div class='d-none d-sm-block'>".$fila['dni_asistente']."</div></td>
                                <td class='text-justify align-middle'>".$fila['nombres_completos']."</td>
                                <td class='text-center align-middle'>".fecha_mostrar($fila['fecha_ingreso'])."</td>
                                <td class='text-center align-middle'>".hora_mostrar($fila['hora_ingreso'])."</td>
                                <td class='text-center align-middle'>".hora_mostrar($fila['hora_salida'])."</td>
                                <td class='text-center align-middle '>
                                    <a class='btn btn-primary mb-2' href='index.php?idusuario=".$fila['nro_evento']."' role='button' data-toggle='modal' data-target='#verusuario'><img src='icons/ver.png' class='rounded mx-auto d-block' alt='...'></a>
                                    <a class='btn btn-success mb-2' href='ver_video.php?codigo=".$fila['nro_evento']."' role='button'><img src='icons/actualizar.png' class='rounded mx-auto d-block' alt='...'></a>
                                    <a class='btn btn-danger mb-2' href='ver_video.php?codigo=".$fila['nro_evento']."' role='button'><img src='icons/eliminar.png' class='rounded mx-auto d-block' alt='...'></a>
                                </td>
                            </tr>";
            }     
        $salida.="</tbody></table>";                            
    }
    else{
        $salida.="No existen Asistentes  en este evento";
    }
    echo $salida;
        
$miconex->close();
 
?>