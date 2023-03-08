<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;  //SMTP::DEBUG_OFF
    $mail->isSMTP();                               
    $mail->Host       = 'smtp.gmail.com';   //cambiar smtp. dependiendo de tu dominio (Leer libreria)
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'instrumentosyvoz@gmail.com';           
    $mail->Password   = 'Asd123.,';                 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
    $mail->Port       = 587;   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('instrumentosyvoz@gmail.com', 'BlackShop');
    $mail->addAddress('victorfernandesrodriguez@gmail.com', 'Sr. Victor');
    
    //Indicar a que Correo te van a responder

    //$mail->addReplyTo('info@example.com', 'Information');
    
    //Enviar copias

    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Agregar ruta para enviar archivos

    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Detalle de su compra';

    $cuerpo = '<h4>Gracias por su compra<4>';
    $cuerpo .= '<p>El ID de su compra es <b>'. $id_transaccion . '</b></p>';
    
    $mail->Body    = utf8_decode($cuerpo);
    $mail->AltBody = 'Le enviamos los detalles de su compra.';

    $mail->setLenguage('es', '../phpmailer/lenguage/phpmailer.lang-es.php');

    $mail->send();
} catch (Exception $e) {
    echo "Error al enviar el correo electronico de la compra: {$mail->ErrorInfo}";
    exit;
}