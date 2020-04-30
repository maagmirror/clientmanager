<?php
define("username", $_SESSION['name']);

$username = username

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"> <img src="https://www.nibiru.com.uy/img/logo-transparent.png" width="200px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Inicio <i class="fas fa-home"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile <i class="fas fa-user-circle"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="clients.php">Clientes <i class="fas fa-user-clock"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">Registrar <i class="fas fa-sign-in-alt"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Cerrar sesion <i class="fas fa-sign-out-alt"></i></a>
      </li>
    
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user"></i>
          Tú cuenta
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="nav-link" href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a class="nav-link" href="register.php"><i class="fas fa-sign-in-alt"></i>Registrar</a>
        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Cerrar sesion</a>
        </div>
      </li> -->
   
    </ul>
    
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Buscar.." aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 text-center" type="submit">Buscar</button>
    </form>
    -->
  </div>
</nav>