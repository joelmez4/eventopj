<script type="text/javascript">
        function cambiar_a_cerrado(id_evento)
        {
            //ventana confirmar
            if(confirm("¿Estas seguro que desea eliminar la videoconferencia ["+id_evento+"]")==true)
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }
    
    </script>
<?php
    require('../conexion.php');
    $salida=""; //todo lo que se mostrara en la pagina de index.php
    $query="select nro_evento,tipo_evento,nombre_evento,fecha,hora,estado from evento where estado='abierto' ORDER BY fecha DESC";
    if(isset($_POST['consulta'])){
        $q=$miconex->real_escape_string($_POST['consulta']); //cuestion de seguridad por si en la caj de texto viene un caracter especial
        $query="select nro_evento,tipo_evento,nombre_evento,fecha,hora,estado from evento
                where estado='abierto' AND tipo_evento like '%".$q."%' OR nombre_evento like '%".$q."%' ORDER BY fecha DESC";
    }
    $resultado=$miconex->query($query); // ejecutamos la consulta y lo guardamos en la variable resultado
    if(!$resultado=$miconex->query($query))
    {
        die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
    }
    if($resultado->num_rows>0){  //si se encontro un elemento en la consulta
        //concatenamos la variable salida puesto que salida es lo que mostrara al final en la pagina index.htmls
        //class=d-none d-sm-block ---Solo cuando sea pequeño que se ocultela columna-->
        $salida.="<p class='lead'><span>Cantidad de Eventos Abiertos: <b>".$resultado->num_rows."</b></span></p>
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
        while($fila=$resultado->fetch_assoc()) //pasamos los resualdos de la consulta con fetch_assoc a un tipo arreglo de variable fila
            {
                //seguimos concatenando la variable salida
                $salida.=" <tr>
                                <td class='text-justify align-middle'>".$fila['tipo_evento'].": ".$fila['nombre_evento']."</td>
                                <td class='align-middle'>".fecha_mostrar2($fila['fecha'])."</td>
                                <td class='align-middle'>".hora_mostrar($fila['hora'])."</td>
                                <td class='text-center '>
                                <a class='btn btn-danger btn-block mb-2' onclick='return cambiar_a_cerrado(".$fila['nro_evento'].");'
                                href='habilitacion_certificado/cambiar_evento.php?id_evento=".$fila['nro_evento']."' role='button'>Cerrar evento</a>
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