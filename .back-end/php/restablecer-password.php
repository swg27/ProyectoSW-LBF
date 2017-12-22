<?php
session_start();
if(isset($_POST['email'])){
$to      = addslashes(htmlspecialchars(trim($_POST['email'])));
$subject = 'restablecer contraseña. Juego de las preguntas';
$message = 'hola, has perdido tu contraseña, por ello te proporcianamos una forma de recuperarla, click el siguiente enlace -> http://localhost/SW/ProyectoSW-LBF/front-end/.Users/php/nueva-contrasena.php';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();


    $_SESSION['email'] = $to;
    $_SESSION['Recuperar']='true';
echo "Se te ha enviado un email para recuperar la contraseña.";
mail($to, $subject, $message, $headers);

}

?>