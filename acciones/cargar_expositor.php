<?php
    require('../conexion.php');
    $salida=""; //todo lo que se mostrara en la pagina de index.php
    $query="select id_expositor,dni,nombre_completo,entidad,cargo,correo,celular from expositor";
    if(isset($_POST['consulta'])){
        $q=$miconex->real_escape_string($_POST['consulta']); //cuestion de seguridad por si en la caj de texto viene un caracter especial
        $query="select id_expositor,dni,nombre_completo,entidad,cargo,correo,celular from expositor 
                where dni like '%".$q."%' OR nombre_completo like '%".$q."%' OR entidad like '%".$q."%' OR correo like '%".$q."%'";
    }
    $resultado=$miconex->query($query); // ejecutamos la consulta y lo guardamos en la variable resultado
    if(!$resultado=$miconex->query($query))
    {
        die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
    }
    if($resultado->num_rows>0){  //si se encontro un elemento en la consulta
        //concatenamos la variable salida puesto que salida es lo que mostrara al final en la pagina index.htmls
        //class=d-none d-sm-block ---Solo cuando sea pequeño que se ocultela columna-->
        $salida.="<p class='lead'><span>Cantidad de Usuarios: <b>".$resultado->num_rows."</b></span></p>
                <table class='table table-hover table-active container mt-0 table-sm'>
                    <thead class='thead-dark'>
                        <tr>
                            <th scope='col'>DNI</th>
                            <th scope='col'>Nombre Completo</th>
                            <th scope='col' class='d-none d-sm-block'>Entidad</th>
                            <th scope='col'>Cargo</th>
                            <th scope='col'>Correo</th>
                            <th scope='col' class='d-none d-sm-block'>Celular</th> 
                            <th scope='col'>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>"; 
        while($fila=$resultado->fetch_assoc()) //pasamos los resualdos de la consulta con fetch_assoc a un tipo arreglo de variable fila
            {
                //seguimos concatenando la variable salida
                $salida.=" <tr>
                                <td>".$fila['dni']."</td>
                                <td>".$fila['nombre_completo']."</td>
                                <td class='d-none d-sm-block'>".$fila['entidad']."</td>
                                <td>".$fila['cargo']."</td>
                                <td>".$fila['correo']."</td>
                                <td class='d-none d-sm-block'>".$fila['celular']."</td>
                                <td>
                                    <a class='btn btn-primary' href='index.php?idusuario=".$fila['id_expositor']."' role='button' data-toggle='modal' data-target='#verusuario'><img src='icons/ver.png' class='rounded mx-auto d-block' alt='...'></a>
                                    <a class='btn btn-success' href='ver_video.php?codigo=".$fila['id_expositor']."' role='button'><img src='icons/actualizar.png' class='rounded mx-auto d-block' alt='...'></a>
                                    <a class='btn btn-danger' href='ver_video.php?codigo=".$fila['id_expositor']."' role='button'><img src='icons/eliminar.png' class='rounded mx-auto d-block' alt='...'></a>
                                </td>
                            </tr>";
            }     
        $salida.="</tbody></table>";                            
    }
    else{
        $salida.="No existen datos del usuario / Usuario no registrado";
    }
    echo $salida;
    $miconex->close();
?>