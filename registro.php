<?php

  require 'config/configbs.php';
  require 'config/dbblackshop.php';
  $db = new Database();
  $con = $db ->conectar();

  $sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
  $sql->execute();
  $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

  //session_destroy();

  //Print_r($_SESSION); <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlackShop registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
    crossorigin="anonymous">
    <link href="css/stylelogin.css" rel="stylesheet">

    <script type="text/javascript" language="Javascript">
		document.oncontextmenu = function(){return false}
		</script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
</head>
<div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="opacity: 90%;">
      <div class="container-fluid">
          <a href="index.php" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" 
            fill="currentColor" class="bi bi-unity" viewBox="0 0 16 16">  
            <path d="M15 11.2V3.733L8.61 0v2.867l2.503 1.466c.099.067.099.2 0 .234L8.148 6.3c-.099.067-.197.033-.263 0L4.92 4.567c-.099-.034-.099-.2 0-.234l2.504-1.466V0L1 3.733V11.2v-.033.033l2.438-1.433V6.833c0-.1.131-.166.197-.133L6.6 8.433c.099.067.132.134.132.234v3.466c0 .1-.132.167-.198.134L4.031 10.8l-2.438 1.433L7.983 16l6.391-3.733-2.438-1.434L9.434 12.3c-.099.067-.198 0-.198-.133V8.7c0-.1.066-.2.132-.233l2.965-1.734c.099-.066.197 0 .197.134V9.8L15 11.2Z"/>
            </svg>
              <strong>BlackShop</strong>
          </a>
        <a href="index.php"><button class="btn btn-outline-warning" aria-expanded="false">Inicio</button></a>
        <a href="login.php"><button class="btn btn-dark" aria-expanded="false">Iniciar Sesion</button></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Categorias
              </button>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a href="page1.php" class="dropdown-item">Electronica</a></li>
                <li><a href="page2.php" class="dropdown-item">Computacion</a></li>
                <li><a href="page3.php" class="dropdown-item">Accesorios</a></li>
              </ul>
            </li>
          </ul>
        <button class="btn btn-dark" aria-expanded="false">Soporte</button>
        <a href="info.php"><button class="btn btn-dark" aria-expanded="false">Informacion</button></a>
        </div>
          <a href="checkout.php" class="btn btn-primary" >
            carrito
            <span id="num_cart" class="badge bg-secondary"><?php echo
            $num_cart; ?></span>
          </a>
        </div>
      </div>
    </nav>
  </div>

<body class="text-center">
  <?php if(!empty($message)): ?>
    <p><?= $message ?></p>
  <?php endif; ?>
    
<main class="form-signin w-100 m-auto">

  <form action="register.php" method="POST">

    <h1 class="h3 mb-3 fw-normal">Crear Cuenta</h1>
    <br>
    
    <div class="form-floating">
      <input type="username" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Nombre Completo</label>
    </div> 
    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Ingresa Tu Email</label>
    </div>
    <div class="form-floating">
      <input type="session_name" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Ingresa Tu Usuario</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Ingresa una Contraseña</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Confirme tu Contraseña</label>
    </div>
    <br><br>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Registrarme</button>

    <p class="mt-5 mb-3 text-muted">&copy; Derechos Reservados Victor Fernandes</p>

  </form>
</main>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" 
crossorigin="anonymous"></script>
    
</body>
</html>