<?php

require '../Config/configbs.php';

if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $token = $_POST['token'];

    $token_tmp = hash_hmac('sha512', $id, KEY_TOKEN);

    if ($token == $token_tmp) {

        if (isset($_SESSION['carrito']['productos'][$id])){
            $_SESSION['carrito']['productos'][$id] += 1;
        } else{
            $_SESSION['carrito']['productos'][$id] = 1;
        }

        $datos['numero'] = count(($_SESSION['carrito']['productos']));
        $datos['Ok'] = true;
    } else {
        $datos['Ok'] = false;
    }
} else {
    $datos['Ok'] = false;
}

echo json_encode($datos);


?>