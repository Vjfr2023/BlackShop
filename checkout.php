<?php

  require 'config/configbs.php';
  require 'config/dbblackshop.php';
  $db = new Database();
  $con = $db ->conectar();

  $productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

  
  //Print_r($_SESSION);

  $lista_carrito = array();

if($productos != null){
    foreach($productos as $clave => $cantidad){
        $sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad FROM productos WHERE 
        id=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
}

//session_destroy();


  
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


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
    crossorigin="anonymous">

    <meta name="theme-color" content="#712cf9">

    <script type="text/javascript" language="Javascript">
		document.oncontextmenu = function(){return false}
		</script>


  </head>

  <style>

  body {
    background-image: url("https://images.pexels.com/photos/5632402/pexels-photo-5632402.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1");
    background-size: 100% 100%;
    background-repeat: no-repeat;
    background-position: center center;
    background-attachment: fixed;
  }

</style>

  <body>
  <header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="opacity: 90%;">
      <div class="container-fluid">
          <a href="index.php" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" 
            fill="currentColor" class="bi bi-unity" viewBox="0 0 16 16">  
            <path d="M15 11.2V3.733L8.61 0v2.867l2.503 1.466c.099.067.099.2 0 .234L8.148 6.3c-.099.067-.197.033-.263 0L4.92 4.567c-.099-.034-.099-.2 0-.234l2.504-1.466V0L1 3.733V11.2v-.033.033l2.438-1.433V6.833c0-.1.131-.166.197-.133L6.6 8.433c.099.067.132.134.132.234v3.466c0 .1-.132.167-.198.134L4.031 10.8l-2.438 1.433L7.983 16l6.391-3.733-2.438-1.434L9.434 12.3c-.099.067-.198 0-.198-.133V8.7c0-.1.066-.2.132-.233l2.965-1.734c.099-.066.197 0 .197.134V9.8L15 11.2Z"/>
            </svg>
              <strong>BlackShop</strong>
          </a>
        <a href="index.php"><button class="btn btn-outline-warning me-2" aria-expanded="false">Inicio</button></a>
        <a href="perfil.php"><button class="btn btn-info me-2" aria-expanded="false">Perfil</button></a>

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
                <li><a href="categorias/page1.php" class="dropdown-item">Electronica</a></li>
                <li><a href="categorias/page2.php" class="dropdown-item">Computacion</a></li>
                <li><a href="categorias/page3.php" class="dropdown-item">Smart Home</a></li>
                <li><a href="categorias/page4.php" class="dropdown-item">VideoJuegos</a></li>
                <li><a href="categorias/page5.php" class="dropdown-item">Accesorios</a></li>
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
            Carrito
            <span id="num_cart" class="badge bg-secondary"><?php echo
            $num_cart; ?></span>
          </a>
        </div>
      </div>
    </nav>
  </div>

  </header>

<main>


    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lista_carrito == null){
                        echo '<tr><td colspan-"5" class="text-center"><b>Lista Vacia</b></td></tr>';
                    } else {
                        $total = 0;
                        foreach($lista_carrito as $producto){
                            $_id = $producto['id'];
                            $nombre = $producto['nombre'];
                            $precio = $producto['precio'];
                            $descuento = $producto['descuento'];
                            $cantidad = $producto['cantidad'];
                            $precio_desc = $precio - (($precio * $descuento) / 100);
                            $subtotal = $cantidad * $precio_desc;
                            $total += $subtotal;
                    ?>

                    <tr>
                        <td><?php echo $nombre; ?></td>
                        
                        <td><?php echo MONEDA . number_format($precio_desc,2,'.',','); ?></td>

                        <td>
                            <input type="number" min="1" max="10" step="1" value="<?php echo 
                            $cantidad ?>"size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)">
                        </td>

                        <td>
                            <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . 
                            number_format($subtotal, 2, '.',','); ?></div>
                        </td>

                        <td><a id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo
                        $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a></td>
                    </tr>
                <?php } ?>

                <tr>
                  <td colspan="3"></td>
                  <td colspan="2">
                    <p class="h2" id="total"><?php echo MONEDA . number_format($total, 2, '.', ',');?></p>
                  </td>
                </tr>
                </tbody>
            <?php } ?>
            </table>
        </div>

        <?php if($lista_carrito != null){ ?>
          <div class="row">
              <div class="col-md-5 offset-md-7 d-grid gap-2">
                  <a class="btn btn-primary btn-lg" href="pago.php">Realizar Pago</a>
              </div>
          </div>
        <?php } ?>
      
    </div>

</main>

<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="eliminaModalLabel">Alerta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Desea eliminar el producto de la lista?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="btn-elimina" type="button" class="btn btn-danger" onclick="eliminar()">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<script>
  let eliminaModal = document.getElementById('eliminaModal')
  eliminaModal.addEventListener('show.bs.modal', function(event) {
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id')
    let buttonElimina = eliminaModal.querySelector('.modal-fooder #btn-elimina')
    buttonElimina.value = id
  })
      
      function actualizaCantidad(cantidad, id){
        let url = 'clases/actualizar_carrito.php'
        let formData = new FormData()
        formData.append('action', 'agregar')
        formData.append('id', id)
        formData.append('cantidad', cantidad)

        fetch(url, {
          method: 'POST',
          body: formData,
          mode: 'cors'
        }).then(response => response.json())
        .then(data => {
          if(data.ok){

            let divsubtotal = document.getElementById('subtotal_' + id)
            divsubtotal.innerHTML = data.sub

            let total = 0.00
            let list = document.getElementsByName('subtotal[')

            for(let i = 0; i < list.length; i++){
              total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''))
            }

            total = new Intl.NumberFormat('en-US', {
              mininumFractionDigits: 2
            }).format(total)
            document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total

          }
        })
      }

      function eliminar() {

        let botonElimina =document.getElementById('btn-elimina')
        let id = botonElimina.value

        let url = 'clases/actualizar_carrito.php'
        let formData = new FormData()
        formData.append('action', 'eliminar')
        formData.append('id', id)

        fetch(url, {
          method: 'POST',
          body: formData,
          mode: 'cors'
        }).then(response => response.json())
        .then(data => {
          if (data.ok) {

          }
        })
      }

    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>