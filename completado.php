<?php

require 'config/configbs.php';
require 'config/dbblackshop.php';
$db = new Database();
$con = $db ->conectar();

$id_transaccion = isset($_GET['key']) ? $_GET['key'] : '0';

$error = '';
if ($id_transaccion == ''){
  $error = 'Error al procesar la peticion';
}else{

  $sql = $con->prepare("SELECT count(id) FROM compra WHERE id_transaccion=? AND status=?");
  $sql->execute([$id_transaccion, 'COMPLETED']);
  if ($sql->fetchColumn() > 0) {

    $sql = $con->prepare("SELECT id, fecha, email, total FROM compra WHERE id_transaccion=? AND status=?
    LIMIT 1");
    $sql->execute([$id_transaccion, 'COMPLETED']);
    $row = $sql->fetch(PDO::FETCH_ASSOC);

    $idCompra = $row['id'];
    $total = $row['total'];
    $fecha = $row['fecha'];

    $sqlDet = $con->prepare("SELECT nombre, precio, cantidad FROM detalle_compra WHERE id_compra = ?");
    $sqlDet->execute([$idCompra]);
  } else {
$error = 'Error al comprobar la compra';
  }
}


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

            <?php if(strlen($error) > 0) { ?>
            <div class="row">
                <div class="col">
                    <h3><?php echo $error; ?></h3>
                </div>
            </div>

            <?php } else { ?>

                <div class="row">
                    <div class="col">
                        <b>Folio de la compra: </b><?php echo $id_transaccion; ?><br>
                        <b>Fecha de la compra: </b><?php echo $fecha; ?><br>
                        <b>Total: </b><?php echo MONEDA . number_format($total, 2, '.', ','); ?><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Producto</th>
                                    <th>Importe</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php while($row_det = $sqlDet->fetch(PDO::FETCH_ASSOC)) { 
                                    $importe = $row_det['precio'] * $row_det['cantidad']; ?>
                                    <tr>
                                        <td><?php echo $row_det['cantidad']; ?></td>
                                        <td><?php echo $row_det['nombre']; ?></td>
                                        <td><?php echo $importe; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
        </div>
</body>

</html>