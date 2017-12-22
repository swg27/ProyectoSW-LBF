<?php
session_start();

$respuesta = addslashes(htmlspecialchars($_GET['respuesta']));
$codigo = addslashes(htmlspecialchars($_GET['cod']));
if(!in_array($codigo, $_SESSION['respondidas'])){
    $_SESSION['cantidad_preguntas_respondidas'] = $_SESSION['cantidad_preguntas_respondidas']+1;
    array_push($_SESSION["respondidas"], $codigo);
    $pos = array_search($codigo,$_SESSION["no_respondidas"] );
    unset($_SESSION["no_respondidas"][$pos] );
}

if(isset($_SESSION['temas_usados'])){
    $tema = $_SESSION['tema_actual'];
    if($_SESSION['temas_usados'][$tema] == 3){

    }
}

if ($respuesta === '0'){
    $_SESSION['aciertos_actual'][$tema] = $_SESSION['aciertos_actual'][$tema]+1;
    $_SESSION['aciertos'] = $_SESSION['aciertos']+1;
    $_SESSION['puntos'] = $_SESSION['puntos'] + 1;
    echo '<div id="feedback-comprobar" class="alert alert-success" style="display: inline-block; overflow: hidden" role="alert">
  <h4 class="alert-heading"><div><i class="material-icons">done</i> Bien hecho!</div></h4>
  <hr>
  <p class="mb-0">"Has acertado!"</p>
</div>';
} else {
    $_SESSION['fallos'] = $_SESSION['fallos']+1;
    $_SESSION['fallos_actual'][$tema] = $_SESSION['fallos_actual'][$tema]+1;
    $_SESSION['puntos'] = $_SESSION['puntos'] - 1;
    echo '<div id="feedback-comprobar" class="alert alert-danger"  style="display: inline-block" role="alert">
  <h4 class="alert-heading"><div><i class="material-icons">not_interested</i> Respuesta incorrecta!</div></h4>
  <hr>
  <p class="mb-0">"Más suerte la proxima vez!"</p>
</div>';
}
echo'</br>';
echo "\naciertos : $_SESSION[aciertos]";
echo "\nfallos : $_SESSION[fallos]";

?>