<?php
session_start();

$respuesta = addslashes(htmlspecialchars($_GET['respuesta']));
$codigo = addslashes(htmlspecialchars($_GET['cod']));
if (!in_array($codigo, $_SESSION['respondidas'])) {
    array_push($_SESSION["respondidas"], $codigo);
    $pos = array_search($codigo, $_SESSION["no_respondidas"]);
    unset($_SESSION["no_respondidas"][$pos]);
}

if ($respuesta === '0') {
    echo '<div id="feedback-comprobar" class="alert alert-success" style="display: inline-block; overflow: hidden" role="alert">
  <h4 class="alert-heading"><div><i class="material-icons">done</i> Bien hecho!</div></h4>
  <hr>
  <p class="mb-0">"Has acertado!"</p>
</div>';
} else {
    echo '<div id="feedback-comprobar" class="alert alert-danger"  style="display: inline-block" role="alert">
  <h4 class="alert-heading"><div><i class="material-icons">not_interested</i> Respuesta incorrecta!</div></h4>
  <hr>
  <p class="mb-0">"Más suerte la proxima vez!"</p>
</div>';
}
?>