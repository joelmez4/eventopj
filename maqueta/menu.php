 <!-- inicio menu -->
    <?php
      require('conexion.php');     
      session_start();
      if($_SESSION['id_usuario']=="")
      {
          header("Location: index.php");    
      } 
      $nombre_usuario_sesion= $_SESSION['nombre'];
    ?>  
    <div class="container-fluid bg-dark fixed-top text-center">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark container">
            <a class="navbar-brand align-middle" href="#">
                <img src="images/pj.png" width="50" height="50" class="d-inline-block " alt="">
                CSJ Apurimac - Eventos <div class="d-xs-none d-sm-inline d-lg-inline d-md-inline d-xl-inline">Academicos</div> 
            </a>
            <button class="navbar-toggler"  type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link text-white bg-dark rounded" href="eventos.php">Inicio</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white bg-dark rounded" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Eventos
                        </a>
                        <div class="dropdown-menu bg-dark text-center  " style="border:none;" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white bg-dark rounded" href="eventos_abiertos.php">Eventos Abiertos</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-white bg-dark rounded" href="eventos_cerrados.php">Eventos Cerrados</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-white bg-dark rounded" href="cerrar_evento.php">Cerrar Eventos</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-white bg-dark rounded" href="eventos_activos.php">Ir a Eventos Web</a>
                        </div>
                    </li>
                    <a class="nav-item nav-link text-white bg-dark rounded" href="expositor.php">Expositor</a>
                    <a class="nav-item nav-link text-white bg-dark rounded" href="usuarios.php">Usuarios</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white bg-dark rounded" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $nombre_usuario_sesion; ?>
                        </a>
                        <div class="dropdown-menu bg-dark text-center  " style="border:none;" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white bg-dark rounded" href="#">Ver Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-white bg-dark rounded" href="#">Modificar Datos</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-white bg-dark rounded" href="maqueta/cerrar_sesion.php">Cerrar Sesion</a>
                        </div>
                    </li>
                </div>
            </div>
        </nav>
    </div>
    <!-- fin menu -->