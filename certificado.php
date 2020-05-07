  <?php
           
    $ruta_img="";
    $id_inscripcion=$_POST['id_inscripcion'];
    $id_certificado=$_POST['id_certificado'];
    $nombres_completos=$_POST['nombres_completos'];
    $correlativo=$id_inscripcion."-".$anio=$_POST['anio'];
    $path = "certificado/".$id_certificado;
        if(file_exists($path))
        {
            $directorio = opendir($path);
            while ($archivo = readdir($directorio))
                {
                    if (!is_dir($archivo))
                    {
                        $ruta_img=$path."/".$archivo;
                    }
                }
        }
        else
        {
            echo "<div class='p-3 mb-2 bg-danger text-white container'>No se encuentra la imagen, talvez fue borrado<div>"; //mensaje
        }
        $plantilla_cert='
        <body background>
            <div class="contenedor" >                      
                <div class="texto-encima"><h3>Correlativo: '.$correlativo.'</h3> </div>
                <div class="centrado"> <h1>'.$nombres_completos.'</h1></div>
            </div>
    
        
        </body>';

    //trae todas las clases de mpdf
    require_once('vendor/autoload.php');

    //trae nuestra html que esta como funcion
    

    //trae nuestro css de certificado.css
    $css = file_get_contents('css/certificado.css');

    //inicia constructor de pdf
    $mpdf=new \Mpdf\Mpdf([ 
        //foramto A4 y orientacion orizontal si quisieramos en vertical se pone P
        "mode" => "utf-8", //no obtendras errores con los acentos o caracteres especiales usados en el pdf
        "format"=>"A4-L"
        //"orientation" => "L" tambien funciona como orientacion l

     ]);
  
    //trae por defecto la imagen de nuestro php
   
   //el css
    $mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
    //ponemos como fondo la imagen del certificado
    $mpdf->SetDefaultBodyCSS('background', "url('".$ruta_img."')");
    //para que no se repita la imagen
    $mpdf->SetDefaultBodyCSS('background-repeat',"no-repeat");
    //html en pdpf
    $mpdf->writeHTML($plantilla_cert,\Mpdf\HTMLParserMode::HTML_BODY);

    //pone nombre al archivo y lo manda para ver
    $mpdf->Output("certificado.pdf","D");
  ?>
