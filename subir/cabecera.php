<nav class="<?php echo $_SESSION['color_cabecera'];?>">
  <!-- ICONOS A LA IZQUIERDA -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- ICONOS A LA DERECHA -->
  <ul class="navbar-nav ml-auto">
  <!-- OPCIONES DE USUARIO -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user"></i>
        <span class="badge navbar-badge"><i class="fas fa-sign-out-alt"></i></span>
      </a>
      <div class="dropdown-menu dropdown-menu dropdown-menu-right">
        <a href="/sysgrafica/logout.php" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
        </a>
        <div class="dropdown-divider">
        </div>
      </div>
    </li>
  </ul>
</nav>