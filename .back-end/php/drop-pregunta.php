<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php

include_once 'seguridad.php';

if(isset($_SESSION['ID'])){

    include_once '../.others/.Dbconnect.php';

    $cod_pregunta = $_GET['cod_pregunta'];

    $query = "DELETE FROM Preguntas WHERE CodPregunta=$cod_pregunta";
    $QueryPregunta = mysqli_query($conn, $query) or die ('Error : '.mysqli_error($conn));

    echo "Pregunta eliminada";

}





?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>
