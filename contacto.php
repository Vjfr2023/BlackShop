<?php

  require 'config/configbs.php';
  require 'config/dbblackshop.php';
  //session_destroy();

  //Print_r($_SESSION); <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  
  ?>


<!doctype html>
<html lang="en">


  <head>
  <script type="text/javascript" language="Javascript">
		document.oncontextmenu = function(){return false}
	</script>    

  <script type="text/javascript" language="Javascript">
		document.oncontextmenu = function(){return false}
		</script>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="shortcut icon" href="Images/lg.ico" type="ico"/>
    <title>BlackShop</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <meta name="theme-color" content="#712cf9">


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


  <body>
  <header>
    <div class="collapse bg-dark" id="navbarHeader">
      <div class="container">
        <div class="row">
        </div>
      </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container">
        <a href="index.php" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" 
        fill="currentColor" class="bi bi-unity" viewBox="0 0 16 16">  
        <path d="M15 11.2V3.733L8.61 0v2.867l2.503 1.466c.099.067.099.2 0 .234L8.148 6.3c-.099.067-.197.033-.263 0L4.92 4.567c-.099-.034-.099-.2 0-.234l2.504-1.466V0L1 3.733V11.2v-.033.033l2.438-1.433V6.833c0-.1.131-.166.197-.133L6.6 8.433c.099.067.132.134.132.234v3.466c0 .1-.132.167-.198.134L4.031 10.8l-2.438 1.433L7.983 16l6.391-3.733-2.438-1.434L9.434 12.3c-.099.067-.198 0-.198-.133V8.7c0-.1.066-.2.132-.233l2.965-1.734c.099-.066.197 0 .197.134V9.8L15 11.2Z"/>
        </svg>
          <strong>BlackShop</strong>
        </a>

          <div class="">
            <button type="button" class="btn btn-outline-warning" href="login.php">Iniciar Sesion</button>
          </div>
          <div class="">
            <button type="button" class="btn btn-outline-warning" href="registro.php">Crea tu Cuenta</button>
          </div>
          <div class="">
            <button type="button" class="btn btn-outline-warning" href="soporte.php">Soporte Tecnico</button>
          </div>
          <div class="">
            <button type="button" class="btn btn-outline-warning" href="contacto.php">Contacto</button>
          </div>

        <a href="checkout.php" class="btn btn-primary" >
          carrito
          <span id="num_cart" class="badge bg-secondary"><?php echo
          $num_cart; ?></span>
        </a>
      </div>
    </div>


  </header>

  <script>
        function addProducto(id, token){
          let url = 'clases/carrito.php'
          let formData = new FormData()
          formData.append('id', id)
          formData.append('token', token)

          fetch(url, {
              method: 'POST',
              body: formData,
              mode: 'cors'
            }).then(response => response.json())
            .then(data => {
              if(data.ok){
                let elemento = document.getElementById("num_cart")
                elemento.innerHTML = data.numero
              }
            })
          }
      </script>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>