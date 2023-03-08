<?php

  require '../config/configbs.php';
  require '../config/dbblackshop.php';
  $db = new Database();
  $con = $db ->conectar();

  $sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
  $sql->execute();
  $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

  //session_destroy();

  //Print_r($_SESSION); <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  
  ?>


<!doctype html>
<html lang="en">


  <head>    

  <script type="text/javascript" language="Javascript">
		document.oncontextmenu = function(){return false}
		</script>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="shortcut icon" href="Images/lg.ico" type="ico"/>
    <title>BlackShop</title>

    <link href="Css/extras.css" rel="stylesheet"> 


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <meta name="theme-color" content="#712cf9">
    
  </head>


  <body>
  <header>
    
  <div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="opacity: 90%;">
      <div class="container-fluid">
          <a href="../index.php" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" 
            fill="currentColor" class="bi bi-unity" viewBox="0 0 16 16">  
            <path d="M15 11.2V3.733L8.61 0v2.867l2.503 1.466c.099.067.099.2 0 .234L8.148 6.3c-.099.067-.197.033-.263 0L4.92 4.567c-.099-.034-.099-.2 0-.234l2.504-1.466V0L1 3.733V11.2v-.033.033l2.438-1.433V6.833c0-.1.131-.166.197-.133L6.6 8.433c.099.067.132.134.132.234v3.466c0 .1-.132.167-.198.134L4.031 10.8l-2.438 1.433L7.983 16l6.391-3.733-2.438-1.434L9.434 12.3c-.099.067-.198 0-.198-.133V8.7c0-.1.066-.2.132-.233l2.965-1.734c.099-.066.197 0 .197.134V9.8L15 11.2Z"/>
            </svg>
              <strong>BlackShop</strong>
          </a>
          <a href="login.php"><button class="btn btn-outline-light me-2" aria-expanded="false">Iniciar Sesion</button></a>
          <a href="registro.php"><button class="btn btn-warning" aria-expanded="false">Crear Cuenta</button></a>

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
                <li><a href="page3.php" class="dropdown-item">Smart Home</a></li>
                <li><a href="page4.php" class="dropdown-item">VideoJuegos</a></li>
                <li><a href="page5.php" class="dropdown-item">Accesorios</a></li>
              </ul>
            </li>
          </ul>
        <button class="btn btn-dark" aria-expanded="false">Soporte</button>
        <a href="info.php"><button class="btn btn-dark" aria-expanded="false">Informacion</button></a>
        </div>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" style="width: 400px;">
          <a class="navbar-brand d-flex align-items-center">
              <input class="form-control form-control-dark text-bg-dark" type="search" placeholder="Buscador" aria-label="Search">
              <button type="submit" class="btn btn-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>    
              </button>
          </a>
        </form>
          <a href="checkout.php" class="btn btn-primary" >
            carrito
            <span id="num_cart" class="badge bg-secondary"><?php echo
            $num_cart; ?></span>
          </a>
        </div>
      </div>
    </nav>
  </div>
  

  </header>

  <main>
    
  <style>
      .carousel-inner img {
          width: 100%;
          max-height: 300px;
      }

      .carousel-inner{
      height: 300px;
      }
    </style>


  <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="Images/promos/principal.jpg" alt="">
      </div>
      <div class="carousel-item">
        <img src="Images/promos/carnaval.jpg" alt="">
      </div>
      <div class="carousel-item">
        <img src="Images/promos/love.jpg" alt="">
      </div>
      <div class="carousel-item">
        <img src="Images/promos/vacaciones.jpg" alt="">
      </div>
    </div>
  </div>


    <h2 style="padding-left: 60px; color:dodgerblue">Oferta del dia</h2>
    <div class="linea"></div>

      <div class="container">
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-4">
          <?php foreach($resultado as $row) { ?>
            <div class="col">
              <div class="card shadow-sm">
                <?php

                $id = $row[('id')];
                $imagen = "Images/productos/".  $id . "/Principal.jpg" ;

                if(!file_exists($imagen)) {
                  $imagen = "Images/not-found.png";
                }
                ?>
                <img src="<?php echo $imagen; ?>" class="d-block w-100">
                <div class="card-body">
                  <h5 class="card-tittle"><?php echo $row['nombre']; ?></h5>
                  <p class="card-text">$ <?php echo number_format($row['precio'], 2, '.', ','); ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="detalles.php?id=<?php echo $row[('id')];?>&token=<?php echo hash_hmac('sha512', $row['id'], KEY_TOKEN);?>" class="btn btn-primary">Detalles</a>
                    </div>

                      <button class="btn btn-outline-success" type="button" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha512', $row['id'], KEY_TOKEN); ?>')"> Agregar </button>

                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>

  </main>

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