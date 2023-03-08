<?php

#Inicio de Conexion con la Base de Datos.

  require 'Config/configbs.php';
  require 'Config/dbblackshop.php';

#Crea una Nueva Conexion con la Base de Datos.

  $db = new Database();
  $con = $db ->conectar();

#Realiza una Solicitud al Token y al Id de los articulos.

  $id = isset($_GET['id']) ? $_GET['id'] : '';
  $token = $_GET['token'] ? $_GET['token'] : '';

#Si en caso de no realizar conexion con los datos solicitados de la Base de Datos, entonces, Muestra mensaje de Error.

  if($id == '' || $token == ''){
    echo 'Error al procesar la solicitud';
    exit;
  } else {

#Realiza un tipo de Cifrado en los datos solicitados.

    $token_tmp = hash_hmac('sha512', $id, KEY_TOKEN);

#Proceso Exitoso, pasa a la siguiente etapa: Realiza consulta de los datos a ser consultados de la Base de Datos.

    if($token == $token_tmp){

        $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND Activo=1");
        $sql->execute([$id]);
        if ($sql->fetchColumn() > 0) {

            $sql = $con->prepare("SELECT nombre, descripcion, precio, descuento FROM productos WHERE id=? AND activo=1
            LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);

            #Consulta Nombre de Articulos.

            $Nombre = $row['nombre'];

            #Consulta Descripcion de Articulos a Consultar.

            $Descripcion = $row['descripcion'];

            #Consulta Precio de Articulos a Consultar.

            $precio = $row['precio'];

            #Consulta Aplica Descuento.

            $Descuento = $row['descuento'];

            #Consulta Formula para generar el descuento.

            $precio_desc = $precio - (($precio * $Descuento) / 100);

            #Directorio donde se ubican las imagenes a mostrar en Detalles (Aplica modo Carrusel de Imagenes).

            $dir_images = 'Images/productos/' . $id . '/';

            #Nombre de la imagen que va a Tomar como (Principal) segun el directorio que se coloco anteriormente.

            $rutaIng = $dir_images . 'principal.jpg';

            #Si en tal caso, no se encuentra la imagen, mostrara la siguiente imagen.

            if(!file_exists($rutaIng)){
                $rutaIng = 'Images/logo-lobo.jpg';
            }

            #Codigo para Mostrar el resto de las Imagenes ubicadas en la carpeta que se direcciono anteriormente.

            $images = array();
            $dir = dir($dir_images);

            #Formatos compatibles con las Imagenes que seran mostradas segun los establecido anteriormente.

            while(($archivo = $dir->read()) != false){
                if($archivo != 'principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))){
                    $images[] = $dir_images . $archivo;
                }
            }

            #Finaliza consulta y cierra.

            $dir->close();

        }
    } else {

      #Si en tal caso, ocurrio algun error al iniciar en entrelazamiento u/o Conexion con 
      #la Base de Datos, Muestra el siguiente Error.
        echo 'Error al procesar la solicitud';
        exit;
    }
  }

  //print_r($_SESSION);

?>

<!doctype html>
<html lang="en">
  <head>    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="shortcut icon" href="Images/lg.ico" type="ico"/>
    <title>BlackShop</title> 

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <script type="text/javascript" language="Javascript">
		document.oncontextmenu = function(){return false}
		</script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
    crossorigin="anonymous">

<meta name="theme-color" content="#712cf9">

    
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
      <a href="clases/carrito.php" class="btn btn-primary">
        Carrito<span id="num_cart" class="badge bg-secondary"><?php echo
        $num_cart ?></span>
      </a>
    </div>
  </div>
</header>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-1" >
                    <div id="carouselImages" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?php echo $rutaIng;?>" class="d-block w-100">
                            </div>

                            <?php foreach($images as $img) { ?>
                                <div class="carousel-item">
                                    <img src="<?php echo $img; ?>" class="d-block w-100">

                                </div>
                            <?php } ?>

                        </div>
                        
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguente</span>
                    </button>
                </div>
                
                </div>
                <div class="col-md-6 order-md-2" >
                    <h2><?php echo $Nombre; ?></h2>

                    <?php if($Descuento > 0) { ?>
                        <p><del><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></del></p>
                        <h2>
                            <?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?>
                            <small class="text-success"><?php echo $Descuento; ?>% Descuento</small>
                        </h2>
                    
                    <?php } else { ?> 


                        <h2><?php echo MONEDA . number_format($precio, 2, '.', ',');?></h2>
                    <?php } ?>
                    <p class="lead">
                        <?php echo $Descripcion; ?>
                    </p>

                    <div class="d-grid gap-3 col-10 mx-auto">
                        <button class="btn btn-primary" type="button">Comprar Ahora</button>
                        <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo $id; ?>, '<?php echo $token_tmp; ?>')"> Agregar al Carrito </button>
                    </div>

                </div>
            </div>
        </div>

    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
      
  </body>
</html>