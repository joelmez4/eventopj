<script type="text/javascript">
        function deshabilitar_certificado(dni_inscrito)
        {
            //ventana confirmar
            if(confirm("¿Estas seguro que desea deshabilitar certificado a ["+dni_inscrito+"]")==true)
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
    $nro_evento=$_POST['nro_evento_cerrado'];
    $query="SELECT id_inscripcion,dni_inscripcion,CONCAT(apellidos_inscripcion,' ',nombres_inscripcion) AS nombres_completos, 
            correo,telefono,habilitacion_cert,nro_evento FROM inscripcion where nro_evento='$nro_evento' 
            ORDER BY nombres_completos ASC";
    if(isset($_POST['consulta'])){
        $q=$miconex->real_escape_string($_POST['consulta']); //cuestion de seguridad por si en la caj de texto viene un caracter especial
        $query="SELECT id_inscripcion,dni_inscripcion,CONCAT(apellidos_inscripcion,' ',nombres_inscripcion) AS nombres_completos, 
        correo,telefono,habilitacion_cert,nro_evento FROM inscripcion where nro_evento='$nro_evento'  AND 
        dni_inscripcion like '%".$q."%' OR CONCAT(apellidos_inscripcion,' ',nombres_inscripcion) like '%".$q."%' 
        ORDER BY nombres_completos ASC";
    }
    if(isset($_POST['estado_certificado'])){ // si las fechas desde y hasta existen entonces
        $estado_certificado=$_POST['estado_certificado'];
        if($estado_certificado=="todos") {
            $query="SELECT id_inscripcion,dni_inscripcion,CONCAT(apellidos_inscripcion,' ',nombres_inscripcion) AS nombres_completos, 
            correo,telefono,habilitacion_cert,nro_evento FROM inscripcion where nro_evento='$nro_evento' 
            ORDER BY nombres_completos ASC";
        }
        if($estado_certificado=="habilitado") {
            $query="SELECT id_inscripcion,dni_inscripcion,CONCAT(apellidos_inscripcion,' ',nombres_inscripcion) AS nombres_completos, 
            correo,telefono,habilitacion_cert,nro_evento FROM inscripcion where nro_evento='$nro_evento' AND habilitacion_cert='habilitado' 
            ORDER BY nombres_completos ASC";
        }
        if($estado_certificado=="no_habilitado") {
            $query="SELECT id_inscripcion,dni_inscripcion,CONCAT(apellidos_inscripcion,' ',nombres_inscripcion) AS nombres_completos, 
            correo,telefono,habilitacion_cert,nro_evento FROM inscripcion where nro_evento='$nro_evento' AND habilitacion_cert='deshabilitado' 
            ORDER BY nombres_completos ASC";
        }

    }
    $resultado=$miconex->query($query); // ejecutamos la consulta y lo guardamos en la variable resultado
    if(!$resultado=$miconex->query($query))
    {
        die ("No se pudo ejecutar la consulta por error en:[".$miconex->error."]");
    }
    if($resultado->num_rows>0){  //si se encontro un elemento en la consulta
        //concatenamos la variable salida puesto que salida es lo que mostrara al final en la pagina index.htmls
        //class=d-none d-sm-block ---Solo cuando sea pequeño que se ocultela columna-->
        $salida.="<p class='lead'><span>Cantidad de Inscritos: <b>".$resultado->num_rows."</b></span></p>
                <table class='table table-hover table-active container mt-0 table-sm'>
                    <thead class='thead-dark'>
                        <tr>
                            <th scope='col' class='text-center align-middle'>DNI</th>
                            <th scope='col' class='text-center align-middle'>Nombres Completos</th>
                            <th scope='col' class='text-center align-middle'><div class='d-none d-sm-block'>Correo</div></th>
                            <th scope='col' class='text-center align-middle'>Telefono</th>
                            <th scope='col' class='text-center align-middle'>Certificado</th>
                            <th scope='col' class='text-center align-middle'>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>"; 
        while($fila=$resultado->fetch_assoc()) //pasamos los resualdos de la consulta con fetch_assoc a un tipo arreglo de variable fila
            {
                //seguimos concatenando la variable salida
                $salida.=" <tr>
                                <td class='text-center align-middle'>".$fila['dni_inscripcion']."</td>
                                <td class='text-justify align-middle'>".$fila['nombres_completos']."</td>
                                <td class='text-center align-middle'><div class='d-none d-sm-block'>".$fila['correo']."</div></td>
                                <td class='text-center align-middle'>".$fila['telefono']."</td>
                                <td class='text-center align-middle'>".$fila['habilitacion_cert']."</td>
                                <td class='text-center align-middle'>
                                    <form method='post'>
                                        <input type='hidden' name='nro_evento' value='".$fila['nro_evento']."'> 
                                        <input type='hidden' name='id_inscrito' value='".$fila['id_inscripcion']."'> 
                                        <a class='btn btn-primary mb-2' href='habilitacion_certificado/habilitado.php?codigo=".$fila['nro_evento']."&id_inscrito=".$fila['id_inscripcion']."' role='button'>Habilitar Certificado</a>
                                        <a class='btn btn-secondary mb-2' onclick='return deshabilitar_certificado(".$fila['dni_inscripcion'].");' 
                                        href='habilitacion_certificado/deshabilitado.php?codigo=".$fila['nro_evento']."&id_inscrito=".$fila['id_inscripcion']."' role='button'>Deshabilitar Certificado</a>
                                    </form>
                                </td>
                            </tr>";
            }     
        $salida.="</tbody></table>";  
                               
    }
    else{
        $salida.="No existen inscritos  en este evento";
    }
    echo $salida;
        
$miconex->close();
 
?>