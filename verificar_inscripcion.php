<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Certificados</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/alertify.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/alertify.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- custom styles CERTIFICATES -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <style media="screen">
      .certificates {


        top: 65%;
    left: 20%;
    transform: translate(-50% , -50%);
    position: absolute;
      }

      #layout_certificate {
        background-color: white;
      }
    </style>
  </head>
  <body  background="images/pj2-transparente.png">


    <?php
        require('conexion.php');
        $nro_evento=$_GET['id_evento'];
        $consulta="select nro_evento,tipo_evento,nombre_evento,fecha,hora,estado from evento where nro_evento='$nro_evento'";
        if(!$resultado=$miconex->query($consulta))
        {
            die ("Ha ocurrido un error en:[".$miconex->error."]");
        }
        if($fila=$resultado->fetch_assoc())
        {
            $nombre_completo_evento=$fila['tipo_evento']." : ".$fila['nombre_evento'];

    ?>


    <nav style="background-image: url('images/pj2.png'); background-repeat: repeat-x;  background-size: 40px 40px;">
        <img src="images/pj2.png" width="40" height="40"  alt="">
    </nav>

<div style="min-height: 100vh;">

        <div class="container-fluid">
            <div class="text-center mt-2 container">
                <div class=" p-2 d-inline d-sm-inline-block"><img src="images/pj.jpg" class=""></div>
                <div class="p-2 d-inline d-sm-inline-block text-uppercase"><h4><strong><em><?php echo $nombre_completo_evento; ?></em></strong></h4></div>

            </div>
            <div class="text-center container">
                <div class="p-4 d-inline d-sm-inline-block"><strong>Fecha: <?php echo fecha_mostrar2($fila['fecha']); ?></strong></div>
                <div class="p-4 d-inline d-sm-inline-block"><strong>Hora: <?php echo hora_mostrar($fila['hora']); ?></strong></div>
            </div>
            <?php }?>

            <form class="container mt-2" method="post" action="">
            <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><strong>Ingrese DNI:</strong></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control mb-2" name="dni_inscrito" maxlength="8" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                    </div>
                    <input type="hidden" name="nro_evento1" value="<?php echo $nro_evento; ?>">
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-primary mr-4" name="btn_buscar_inscrito">Buscar</button>
                        <a class="btn btn-secondary" href="eventos_activos.php" role="button">Regresar</a>
                    </div>

                </div>
            </form>

                <?php
                    if(isset($_POST['btn_buscar_inscrito']))
                    {
                        $dni_inscrito=$_POST['dni_inscrito'];
                        $nro_evento1=$_POST['nro_evento1'];
                        $consulta="select id_inscripcion,dni_inscripcion,nombres_inscripcion,apellidos_inscripcion,fecha_inscripcion,
                                    hora_inscripcion,b.nro_evento,b.tipo_evento,b.nombre_evento from inscripcion a inner join
                                    evento b on a.nro_evento=b.nro_evento where b.nro_evento='$nro_evento1' and dni_inscripcion='$dni_inscrito'";
                        if(!$resultado=$miconex->query($consulta))
                            {
                                die ("Ha ocurrido un error en:[".$miconex->error."]");
                            }
                        if($fila=$resultado->fetch_assoc())
                            {
                                echo "<script>alertify.success('Usuario encontrado');</script>";
                ?>

                        <div class="text-danger container"> *Verificacion de datos no es necesario imprimir esta pagina, mejor tome una foto. **Recuerde el numero de ticket**</div>
                        <h3 class="display-5 container"><small class="text-muted">NRO TICKET:  <?php echo $fila['id_inscripcion']; ?></small></h3>
                        <form class="container">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><strong>Nombre Completo:</strong></label>
                                <label class="col-sm-9 col-form-label"><?php echo $fila['nombres_inscripcion']." ".$fila['apellidos_inscripcion']; ?></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><strong>Fecha de Inscripcion:</strong></label>
                                <label class="col-sm-3 col-form-label"><?php echo fecha_mostrar($fila['fecha_inscripcion']); ?></label>
                                <label class="col-sm-3 col-form-label"><strong>Hora de Inscripcion:</strong></label>
                                <label class="col-sm-3 col-form-label"><?php echo hora_mostrar($fila['hora_inscripcion']); ?></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-uppercase"><strong>Inscrito a <?php echo $fila['tipo_evento'].": ";?></strong></label>
                                <label class="col-sm-9 col-form-label text-uppercase"><em><?php echo $fila['nombre_evento'];?></em></label>
                            </div>
                        </form>
                        <div class='p-3 mb-2 bg-success text-white container'>Se recomienda estar 10 minutos antes para realizar su registro respectivo</div>

                        <!-- some code added -->

                        <div class="certificates">
                        <!--[if gte vml 1]><v:rect id="_x0000_s1025" style='position:absolute;left:25.45pt;
                         top:44.87pt;width:792.23pt;height:538.41pt;z-index:1' o:preferrelative="t"
                         filled="f" stroked="f" insetpen="t" o:cliptowrap="t">
                         <v:imagedata src="ecertificado/image305.emz"
                          o:title=""/>
                         <v:path o:extrusionok="f"/>
                         <o:lock v:ext="edit" aspectratio="t"/>
                        </v:rect><![if gte mso 9]><o:OLEObject Type="Embed" ShapeID="_x0000_s1025"
                         DrawAspect="Content" ObjectID="1">
                        </o:OLEObject>
                        <![endif]><![endif]--><![if !vml]><span style='position:absolute;z-index:1;
                        left:34px;top:60px;width:1056px;height:718px'><img id="layout_certificate" width=1056 height=718
                        src="ecertificado/image3051.png" v:shapes="_x0000_s1025"></span><![endif]><!--[if gte vml 1]><v:rect
                         id="_x0000_s1026" style='position:absolute;left:391.25pt;top:16.56pt;width:60pt;
                         height:61.5pt;z-index:2' o:preferrelative="t" filled="f" stroked="f"
                         insetpen="t" o:cliptowrap="t">
                         <v:imagedata src="ecertificado/image299.emz"
                          o:title=""/>
                         <v:path o:extrusionok="f"/>
                         <o:lock v:ext="edit" aspectratio="t"/>
                        </v:rect><![if gte mso 9]><o:OLEObject Type="Embed" ShapeID="_x0000_s1026"
                         DrawAspect="Content" ObjectID="0">
                        </o:OLEObject>
                        <![endif]><![endif]--><![if !vml]><span style='position:absolute;z-index:2;
                        left:522px;top:22px;width:80px;height:82px'><img width=80 height=82
                        src="ecertificado/image2991.png" v:shapes="_x0000_s1026"></span><![endif]><!--[if gte vml 1]><v:rect
                         id="_x0000_s1027" style='position:absolute;left:271.22pt;top:78.06pt;width:333.65pt;
                         height:89.3pt;z-index:3;mso-wrap-distance-left:2.88pt;mso-wrap-distance-top:2.88pt;
                         mso-wrap-distance-right:2.88pt;mso-wrap-distance-bottom:2.88pt'
                         o:preferrelative="t" filled="f" fillcolor="#5b9bd5 [1]" stroked="f"
                         strokecolor="black [0]" strokeweight="2pt" o:cliptowrap="t">
                         <v:fill color2="white [7]"/>
                         <v:stroke color2="white [7]">
                          <o:left v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:top v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:right v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:bottom v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:column v:ext="view" color="black [0]" color2="white [7]"/>
                         </v:stroke>
                         <v:imagedata src="ecertificado/image308.png"
                          o:title="" gain="109227f" blacklevel="-6554f"/>
                         <v:shadow color="black [0]"/>
                         <o:extrusion v:ext="view" backdepth="0" viewpoint="0,0" viewpointorigin="0,0"/>
                         <o:lock v:ext="edit" aspectratio="t"/>
                        </v:rect><![endif]--><![if !vml]><span style='position:absolute;z-index:3;
                        left:362px;top:104px;width:445px;height:119px'><img width=445 height=119
                        src="ecertificado/image3081.png" v:shapes="_x0000_s1027"></span><![endif]><!--[if gte vml 1]><v:shapetype
                         id="_x0000_t202" coordsize="21600,21600" o:spt="202" path="m,l,21600r21600,l21600,xe">
                         <v:stroke joinstyle="miter"/>
                         <v:path gradientshapeok="t" o:connecttype="rect"/>
                        </v:shapetype><v:shape id="_x0000_s1028" type="#_x0000_t202" style='position:absolute;
                         left:74.96pt;top:196.18pt;width:134.61pt;height:26.61pt;z-index:4;
                         mso-wrap-distance-left:2.88pt;mso-wrap-distance-top:2.88pt;
                         mso-wrap-distance-right:2.88pt;mso-wrap-distance-bottom:2.88pt' filled="f"
                         fillcolor="#5b9bd5 [1]" stroked="f" strokecolor="black [0]" strokeweight="2pt"
                         o:cliptowrap="t">
                         <v:fill color2="white [7]"/>
                         <v:stroke color2="white [7]">
                          <o:left v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:top v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:right v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:bottom v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:column v:ext="view" color="black [0]" color2="white [7]"/>
                         </v:stroke>
                         <v:shadow color="black [0]"/>
                         <o:extrusion v:ext="view" backdepth="0" viewpoint="0,0" viewpointorigin="0,0"/>
                         <v:textbox style='mso-column-margin:2mm' inset="2.88pt,2.88pt,2.88pt,2.88pt"/>
                        </v:shape><![endif]--><![if !vml]><span style='position:absolute;z-index:4;
                        left:100px;top:262px;width:179px;height:35px'>

                        <table cellpadding=0 cellspacing=0>
                         <tr>
                          <td width=179 height=35 style='vertical-align:top'><![endif]>
                          <div v:shape="_x0000_s1028" style='padding:2.88pt 2.88pt 2.88pt 2.88pt'
                          class=shape>
                          <p class=MsoNormal><span lang=es-PE style='font-size:16.0pt;line-height:119%;
                          font-family:"Times New Roman";language:es-PE'>OTORGADO A:</span></p>
                          </div>
                          <![if !vml]></td>
                         </tr>
                        </table>

                        </span><![endif]><!--[if gte vml 1]><v:shapetype id="_x0000_t32" coordsize="21600,21600"
                         o:spt="32" o:oned="t" path="m,l21600,21600e" filled="f">
                         <v:path arrowok="t" fillok="f" o:connecttype="none"/>
                         <o:lock v:ext="edit" shapetype="t"/>
                        </v:shapetype><v:shape id="_x0000_s1029" type="#_x0000_t32" style='position:absolute;
                         left:74.96pt;top:295.78pt;width:691.42pt;height:0;z-index:5;
                         mso-wrap-distance-left:2.88pt;mso-wrap-distance-top:2.88pt;
                         mso-wrap-distance-right:2.88pt;mso-wrap-distance-bottom:2.88pt'
                         o:connectortype="straight" strokecolor="#c00000" strokeweight="2pt">
                         <v:stroke color2="white [7]">
                          <o:left v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:top v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:right v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:bottom v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:column v:ext="view" color="black [0]" color2="white [7]"/>
                         </v:stroke>
                         <v:shadow color="black [0]"/>
                         <o:extrusion v:ext="view" backdepth="0" viewpoint="0,0" viewpointorigin="0,0"/>
                        </v:shape><![endif]--><![if !vml]><span style='position:absolute;z-index:5;
                        left:98px;top:393px;width:926px;height:3px'><img width=926 height=3
                        src="ecertificado/image314.png" v:shapes="_x0000_s1029"></span><![endif]><!--[if gte vml 1]><v:shape
                         id="_x0000_s1030" type="#_x0000_t202" style='position:absolute;left:74.96pt;
                         top:304.55pt;width:691.42pt;height:102pt;z-index:6;mso-wrap-distance-left:2.88pt;
                         mso-wrap-distance-top:2.88pt;mso-wrap-distance-right:2.88pt;
                         mso-wrap-distance-bottom:2.88pt' filled="f" fillcolor="#5b9bd5 [1]" stroked="f"
                         strokecolor="black [0]" strokeweight="2pt" o:cliptowrap="t">
                         <v:fill color2="white [7]"/>
                         <v:stroke color2="white [7]">
                          <o:left v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:top v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:right v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:bottom v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:column v:ext="view" color="black [0]" color2="white [7]"/>
                         </v:stroke>
                         <v:shadow color="black [0]"/>
                         <o:extrusion v:ext="view" backdepth="0" viewpoint="0,0" viewpointorigin="0,0"/>
                         <v:textbox style='mso-column-margin:2mm' inset="2.88pt,2.88pt,2.88pt,2.88pt"/>
                        </v:shape><![endif]--><![if !vml]><span style='position:absolute;z-index:6;
                        left:100px;top:406px;width:922px;height:136px'>

                        <table cellpadding=0 cellspacing=0>
                         <tr>
                          <td width=922 height=136 style='vertical-align:top'><![endif]>
                          <div v:shape="_x0000_s1030" style='padding:2.88pt 2.88pt 2.88pt 2.88pt'
                          class=shape>
                          <p class=MsoNormal style='text-align:justify;text-justify:inter-word;
                          text-align:justify;text-justify:inter-word'><span lang=es-PE
                          style='font-size:16.0pt;font-family:"Times New Roman";language:es-PE'>Por haber participado como </span><span
                          lang=es-PE style='font-size:16.0pt;font-family:"Times New Roman";font-weight:
                          bold;language:es-PE'>Asistente<!--[if PUB]>$!0````<![endif]--></span><span
                          lang=es-PE style='font-size:16.0pt;font-family:"Times New Roman";language:
                          es-PE'>, en el curso denominado </span><span lang=es-PE style='font-size:
                          16.0pt;font-family:"Times New Roman";font-weight:bold;language:es-PE'></span><span
                          lang=es-PE style='font-size:16.0pt;font-family:"Times New Roman";font-weight:
                          bold;text-transform:uppercase;language:es-PE'><?php echo $fila['nombre_evento'];?></span><span
                          lang=es-PE style='font-size:16.0pt;font-family:"Times New Roman";font-weight:
                          bold;language:es-PE'></span><span lang=es-PE style='font-size:16.0pt;
                          font-family:"Times New Roman";language:es-PE'>, realizado en el Auditorio de la Universidad Alas Peruanas - Filial Andahuaylas, el día 17 de diciembre de 2019, con una duración de 04 horas lectivas; evento organizado por la Presidencia y la Administración del Módulo Penal de la Corte Superior de Justicia de Apurímac.</span></p>
                          </div>
                          <![if !vml]></td>
                         </tr>
                        </table>

                        </span><![endif]><!--[if gte vml 1]><v:shape id="_x0000_s1031" type="#_x0000_t202"
                         style='position:absolute;left:479.37pt;top:406.55pt;width:4in;height:22.69pt;
                         z-index:7;mso-wrap-distance-left:2.88pt;mso-wrap-distance-top:2.88pt;
                         mso-wrap-distance-right:2.88pt;mso-wrap-distance-bottom:2.88pt' filled="f"
                         fillcolor="#5b9bd5 [1]" stroked="f" strokecolor="black [0]" strokeweight="2pt"
                         o:cliptowrap="t">
                         <v:fill color2="white [7]"/>
                         <v:stroke color2="white [7]">
                          <o:left v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:top v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:right v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:bottom v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:column v:ext="view" color="black [0]" color2="white [7]"/>
                         </v:stroke>
                         <v:shadow color="black [0]"/>
                         <o:extrusion v:ext="view" backdepth="0" viewpoint="0,0" viewpointorigin="0,0"/>
                         <v:textbox style='mso-column-margin:2mm' inset="2.88pt,2.88pt,2.88pt,2.88pt"/>
                        </v:shape><![endif]--><![if !vml]><span style='position:absolute;z-index:7;
                        left:639px;top:542px;width:384px;height:30px'>

                        <table cellpadding=0 cellspacing=0>
                         <tr>
                          <td width=384 height=30 style='vertical-align:top'><![endif]>
                          <div v:shape="_x0000_s1031" style='padding:2.88pt 2.88pt 2.88pt 2.88pt'
                          class=shape>
                          <p class=MsoNormal style='text-align:right;text-align:right'><span
                          lang=es-PE style='font-size:16.0pt;line-height:119%;font-family:"Times New Roman";
                          language:es-PE'>Andahuaylas, 17 de diciembre de 2019</span></p>
                          </div>
                          <![if !vml]></td>
                         </tr>
                        </table>

                        </span><![endif]><!--[if gte vml 1]><v:shape id="_x0000_s1032" type="#_x0000_t202"
                         style='position:absolute;left:74.96pt;top:486.12pt;width:316.29pt;height:58.19pt;
                         z-index:8;mso-wrap-distance-left:2.88pt;mso-wrap-distance-top:2.88pt;
                         mso-wrap-distance-right:2.88pt;mso-wrap-distance-bottom:2.88pt' filled="f"
                         fillcolor="#5b9bd5 [1]" stroked="f" strokecolor="black [0]" strokeweight="2pt"
                         o:cliptowrap="t">
                         <v:fill color2="white [7]"/>
                         <v:stroke color2="white [7]">
                          <o:left v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:top v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:right v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:bottom v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:column v:ext="view" color="black [0]" color2="white [7]"/>
                         </v:stroke>
                         <v:shadow color="black [0]"/>
                         <o:extrusion v:ext="view" backdepth="0" viewpoint="0,0" viewpointorigin="0,0"/>
                         <v:textbox style='mso-column-margin:2mm' inset="2.88pt,2.88pt,2.88pt,2.88pt"/>
                        </v:shape><![endif]--><![if !vml]><span style='position:absolute;z-index:8;
                        left:100px;top:648px;width:422px;height:78px'>

                        <table cellpadding=0 cellspacing=0>
                         <tr>
                          <td width=422 height=78 style='vertical-align:top'><![endif]>
                          <div v:shape="_x0000_s1032" style='padding:2.88pt 2.88pt 2.88pt 2.88pt'
                          class=shape>
                          <p class=MsoNormal style='text-align:center;margin-bottom:0pt;text-align:
                          center'><span lang=es-PE style='language:es-PE'>_____________&#31;&#31;&#31;&#31;____________________________</span></p>
                          <p class=MsoNormal style='text-align:center;margin-bottom:0pt;text-align:
                          center'><span lang=es-PE style='font-size:11.0pt;font-family:"Times New Roman";
                          language:es-PE'>Henry Cama Godoy</span></p>
                          <p class=MsoNormal style='text-align:center;margin-bottom:0pt;text-align:
                          center'><span lang=es-PE style='font-family:"Times New Roman";language:es-PE'>Presidente</span></p>
                          <p class=MsoNormal style='text-align:center;margin-bottom:0pt;text-align:
                          center'><span lang=es-PE style='font-family:"Times New Roman";language:es-PE'>Corte Superior de Justicia de Apurímac</span></p>
                          </div>
                          <![if !vml]></td>
                         </tr>
                        </table>

                        </span><![endif]><!--[if gte vml 1]><v:shape id="_x0000_s1033" type="#_x0000_t202"
                         style='position:absolute;left:451.25pt;top:486.12pt;width:315.13pt;height:58.19pt;
                         z-index:9;mso-wrap-distance-left:2.88pt;mso-wrap-distance-top:2.88pt;
                         mso-wrap-distance-right:2.88pt;mso-wrap-distance-bottom:2.88pt' filled="f"
                         fillcolor="#5b9bd5 [1]" stroked="f" strokecolor="black [0]" strokeweight="2pt"
                         o:cliptowrap="t">
                         <v:fill color2="white [7]"/>
                         <v:stroke color2="white [7]">
                          <o:left v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:top v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:right v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:bottom v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:column v:ext="view" color="black [0]" color2="white [7]"/>
                         </v:stroke>
                         <v:shadow color="black [0]"/>
                         <o:extrusion v:ext="view" backdepth="0" viewpoint="0,0" viewpointorigin="0,0"/>
                         <v:textbox style='mso-column-margin:2mm' inset="2.88pt,2.88pt,2.88pt,2.88pt"/>
                        </v:shape><![endif]--><![if !vml]><span style='position:absolute;z-index:9;
                        left:602px;top:648px;width:420px;height:78px'>

                        <table cellpadding=0 cellspacing=0>
                         <tr>
                          <td width=420 height=78 style='vertical-align:top'><![endif]>
                          <div v:shape="_x0000_s1033" style='padding:2.88pt 2.88pt 2.88pt 2.88pt'
                          class=shape>
                          <p class=MsoNormal style='text-align:center;margin-bottom:0pt;text-align:
                          center'><span lang=es-PE style='language:es-PE'>_____________&#31;&#31;&#31;&#31;____________________________</span></p>
                          <p class=MsoNormal style='text-align:center;margin-bottom:0pt;text-align:
                          center'><span lang=es-PE style='font-size:11.0pt;font-family:"Times New Roman";
                          language:es-PE'>Christian Farfán Segovia</span></p>
                          <p class=MsoNormal style='text-align:center;margin-bottom:0pt;text-align:
                          center'><span lang=es-PE style='font-family:"Times New Roman";language:es-PE'>Administrador del Módulo Penal</span></p>
                          <p class=MsoNormal style='text-align:center;margin-bottom:0pt;text-align:
                          center'><span lang=es-PE style='font-family:"Times New Roman";language:es-PE'>Corte Superior de Justicia de Apurímac</span></p>
                          </div>
                          <![if !vml]></td>
                         </tr>
                        </table>

                        </span><![endif]><!--[if gte vml 1]><v:shape id="_x0000_s1034" type="#_x0000_t202"
                         style='position:absolute;left:762.32pt;top:549.97pt;width:36.46pt;height:9.3pt;
                         z-index:10;mso-wrap-distance-left:2.88pt;mso-wrap-distance-top:2.88pt;
                         mso-wrap-distance-right:2.88pt;mso-wrap-distance-bottom:2.88pt' filled="f"
                         fillcolor="#5b9bd5 [1]" stroked="f" strokecolor="black [0]" strokeweight="2pt"
                         o:cliptowrap="t">
                         <v:fill color2="white [7]"/>
                         <v:stroke color2="white [7]">
                          <o:left v:ext="view" color="black [0]" color2="white [7]" weight="2pt"
                           joinstyle="miter"/>
                          <o:top v:ext="view" color="black [0]" color2="white [7]" weight="2pt"
                           joinstyle="miter"/>
                          <o:right v:ext="view" color="black [0]" color2="white [7]" weight="2pt"
                           joinstyle="miter"/>
                          <o:bottom v:ext="view" color="black [0]" color2="white [7]" weight="2pt"
                           joinstyle="miter"/>
                          <o:column v:ext="view" color="black [0]" color2="white [7]"/>
                         </v:stroke>
                         <v:shadow color="black [0]"/>
                         <o:extrusion v:ext="view" backdepth="0" viewpoint="0,0" viewpointorigin="0,0"/>
                         <v:textbox style='mso-column-margin:2mm' inset=".016mm,.016mm,.016mm,.016mm"/>
                        </v:shape><![endif]--><![if !vml]><span style='position:absolute;z-index:10;
                        left:1016px;top:733px;width:49px;height:13px'>

                        <table cellpadding=0 cellspacing=0>
                         <tr>
                          <td width=49 height=13 valign=middle style='vertical-align:top'><![endif]>
                          <div v:shape="_x0000_s1034" style='padding:.0453pt .0453pt .0453pt .0453pt'
                          class=shape>
                          <p class=MsoNormal style='text-align:right;margin-bottom:0pt;text-align:right'><span
                          lang=es-PE style='font-family:"Edwardian Script ITC";color:#262626;
                          language:es-PE'>otpa</span></p>
                          </div>
                          <![if !vml]></td>
                         </tr>
                        </table>

                        </span><![endif]><!--[if gte vml 1]><v:shape id="_x0000_s1035" type="#_x0000_t202"
                         style='position:absolute;left:49.8pt;top:544.97pt;width:339.25pt;height:9.9pt;
                         z-index:11;mso-wrap-distance-left:2.88pt;mso-wrap-distance-top:2.88pt;
                         mso-wrap-distance-right:2.88pt;mso-wrap-distance-bottom:2.88pt' filled="f"
                         fillcolor="#5b9bd5 [1]" stroked="f" strokecolor="black [0]" strokeweight="2pt"
                         o:cliptowrap="t">
                         <v:fill color2="white [7]"/>
                         <v:stroke color2="white [7]">
                          <o:left v:ext="view" color="black [0]" color2="white [7]" weight="2pt"
                           joinstyle="miter"/>
                          <o:top v:ext="view" color="black [0]" color2="white [7]" weight="2pt"
                           joinstyle="miter"/>
                          <o:right v:ext="view" color="black [0]" color2="white [7]" weight="2pt"
                           joinstyle="miter"/>
                          <o:bottom v:ext="view" color="black [0]" color2="white [7]" weight="2pt"
                           joinstyle="miter"/>
                          <o:column v:ext="view" color="black [0]" color2="white [7]"/>
                         </v:stroke>
                         <v:shadow color="black [0]"/>
                         <o:extrusion v:ext="view" backdepth="0" viewpoint="0,0" viewpointorigin="0,0"/>
                         <v:textbox style='mso-column-margin:2mm' inset=".016mm,.016mm,.016mm,.016mm"/>
                        </v:shape><![endif]--><![if !vml]><span style='position:absolute;z-index:11;
                        left:66px;top:727px;width:453px;height:13px'>

                        <!--
                        <table cellpadding=0 cellspacing=0>
                         <tr>
                          <td width=453 height=13 valign=middle style='vertical-align:top'><![endif]>
                          <div v:shape="_x0000_s1035" style='padding:.0453pt .0453pt .0453pt .0453pt'
                          class=shape>
                          <p class=MsoNormal style='margin-bottom:0pt'><span lang=es-PE
                          style='font-size:8.0pt;font-family:"Times New Roman";color:#3F3F3F;
                          language:es-PE'>Nota: Registrado y elaborado por la Lic. Soledad Loayza Ayala� Analista del NCPP de Apur�mac.</span></p>
                          </div>
                          <![if !vml]></td>
                         </tr>
                        </table>
                      -->


                        </span><![endif]><!--[if gte vml 1]><v:shape id="_x0000_s1037" type="#_x0000_t202"
                         style='position:absolute;left:75.74pt;top:247.14pt;width:691.4pt;height:52.27pt;
                         z-index:13;visibility:visible;mso-wrap-distance-left:2.88pt;
                         mso-wrap-distance-top:2.88pt;mso-wrap-distance-right:2.88pt;
                         mso-wrap-distance-bottom:2.88pt' filled="f" fillcolor="#5b9bd5 [1]" stroked="f"
                         strokecolor="black [0]" strokeweight="2pt" o:cliptowrap="t">
                         <v:fill color2="white [7]"/>
                         <v:stroke color2="white [7]">
                          <o:left v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:top v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:right v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:bottom v:ext="view" color="black [0]" color2="white [7]"/>
                          <o:column v:ext="view" color="black [0]" color2="white [7]"/>
                         </v:stroke>
                         <v:shadow color="black [0]"/>
                         <o:extrusion v:ext="view" backdepth="0" viewpoint="0,0" viewpointorigin="0,0"/>
                         <v:textbox style='mso-column-margin:2mm' inset="2.88pt,2.88pt,2.88pt,2.88pt"/>
                        </v:shape><![endif]--><![if !vml]><span style='position:absolute;z-index:13;
                        left:101px;top:330px;width:922px;height:69px'>

                        <table cellpadding=0 cellspacing=0>
                         <tr>
                          <td width=922 height=69 style='vertical-align:top'><![endif]>
                          <div v:shape="_x0000_s1037" style='padding:2.88pt 2.88pt 2.88pt 2.88pt'
                          class=shape>
                          <p class=MsoNormal style='text-align:center;text-align:center'><span
                          lang=es-PE style='font-size:24.0pt;line-height:119%;font-family:"Arial Black";
                          font-weight:bold;language:es-PE'><?php echo $fila['nombres_inscripcion']." ".$fila['apellidos_inscripcion']; ?><!--[if PUB]>$`@````<![endif]--></span></p>
                          </div>
                          <![if !vml]></td>
                         </tr>
                        </table>

                        </span><![endif]>
                        </div>

                        <!-- Example single danger button -->

                          <div class="row">
                            <div class="col-sm">

                            </div>
                            <div class="col-sm">

                            </div>
                            <div class="col-sm">
                              <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Descargar
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="#">Formato PDF</a>
                                  <a class="dropdown-item" href="#">Formato JPG</a>
                                </div>
                              </div>
                            </div>
                          </div>



            <?php
                    }
                    else
                    {
                        echo "<script>alertify.error('No se encontro usuario');</script>";
                        echo "<div class='p-3 mb-2 bg-danger text-white container'>Usted no esta inscrito dirijase a los eventos disponibles de la Corte Superior de Justicia de Apurimac, para realizar la inscripcion respectiva</div>";
                    }
                }
            ?>

        </div>
    </div>
    <!-- Example single danger button -->

<!--
        <footer class="footer">
            <p><b>© 2020 OFICINA DE ESTADISTICA E INFORMATICA - CSJAP</b></p>
        </footer>
-->
    <script src="js/main.js"></script>

  </body>
</hmtl>
