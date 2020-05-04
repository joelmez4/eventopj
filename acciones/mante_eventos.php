  <?php
      
      $id_even=$_POST['nro_evento']; 
      if($id_even!='')
      {
        include('../conexion.php');
        $id_evento=substr($id_even,1,-1); 
        $query="select * from evento where nro_evento='$id_evento'";
        if(!$resultado=$miconex->query($query))
            {
              die ("no se pudo insertar insertar por error en: [".$miconex->error."]");
            }
        if($fila=$resultado->fetch_assoc())
            {
              $nombre_completo_evento=$fila['tipo_evento'].": ".$fila['nombre_evento'];
              echo "<form>
                      <div class='form-group row'>
                        <label for='' class='col-sm-2 col-form-label'><strong>Evento</strong></label>
                        <label for='' class='col-sm-10 col-form-label text-uppercase'><em>".$nombre_completo_evento."</em></label>
                      </div>
                      <div class='form-group row'>
                        <label for='' class='col-sm-2 col-form-label'><strong>Ponentes</strong></label>
                        <label for='' class='col-sm-10 col-form-label text-uppercase'>".$fila['ponentes']."</label>
                      </div>
                      <div class='form-group row'>
                        <label for='' class='col-sm-2 col-form-label'><strong>Lugar</strong></label>
                        <label for='' class='col-sm-10 col-form-label text-uppercase'>".$fila['lugar']."</label>
                      </div>
                      <div class='form-group row'>
                        <label for='' class='col-sm-2 col-form-label'><strong>Direccion</strong></label>
                        <label for='' class='col-sm-10 col-form-label text-uppercase'>".$fila['direccion']."</label>
                      </div>
                      <div class='form-group row'>
                        <label for='' class='col-sm-2 col-form-label'><strong>Fecha</strong></label>
                        <label for='' class='col-sm-10 col-form-label text-uppercase'>".fecha_mostrar2($fila['fecha'])."</label>
                      </div>
                      <div class='form-group row'>
                        <label for='' class='col-sm-2 col-form-label'><strong>Hora de Inicio</strong></label>
                        <label for='' class='col-sm-10 col-form-label text-uppercase'>".hora_mostrar($fila['hora'])."</label>
                      </div>
                    </form>";
            }
          
        echo "<div class='modal-footer'>
              <button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>
              
            </div>";
      }
      else
      {
        echo "<label class='col-sm-10 col-form-label'><strong>No hay datos del evento</strong></label>";
      }

    ?>            
    <!-- IFin PHP para registrar evento -->
 