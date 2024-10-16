<?php
    require_once("c://xampp/htdocs/login/view/head/head.php");
?>


<div class="fondo_menu">
    <div class="container-fluid ">
      <nav class="navbar navbar-expand-lg navbar-dark ">
          <div class="container-fluid ">
            <a class="navbar-brand" href="panelControl.php">Inicio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          <?php if(empty($_SESSION['usuario'])) : ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">Productos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Conctátanos</a>
                    </li>            
                  </ul>
              <form class="d-flex" role="search">
                <input class="form-control_main me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-success" type="submit" style="background-color: #ABF600; border-color: #ABF600;">Buscar</button>

              </form>
              <a href="/login/view/home/login.php" class="boton" >Iniciar Sesión</a>
              <a href="/login/view/home/signup.php" class="boton" >Registarte</a>
            </div>

            <?php else: ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="subirVideo.php">Agregar información</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Editar perfil</a>
                    </li>            
                  </ul>
              <form class="d-flex" role="search">
                <input class="form-control_main me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-success" type="submit" style="background-color: #ABF600; border-color: #ABF600;">Buscar</button>

              </form>
              <a href="/login/view/home/logout.php" class="boton" >Cerrar sesión</a>
            </div>

            
          </div>
        </nav>
      </div>
    </div>

    

    <?php endif ?>
<div class="fondo">
    
