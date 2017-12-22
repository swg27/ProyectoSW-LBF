<?php include_once ('seguridadProfesor.php'); ?>
<!DOCTYPE html>
<html>
<?php
if(isset($_SESSION['ID'])){

    include_once ('../.others/.Dbconnect.php');

    $query = "SELECT CodPregunta, pregunta FROM Preguntas";
    $QueryCollectionPreguntas = mysqli_query($conn, $query) or die ('Error : '.mysqli_error($conn));

echo "<form name='fpregunta' id='fpregunta'>";

                   echo '<select name="select" id="listaPreguntas" onchange="ajaxGet()">
                                <option value="">Selecione [cod] de la pregunta.</option>';
                   while($row2=mysqli_fetch_array( $QueryCollectionPreguntas))
                   {
                       echo '<option id="' . htmlspecialchars($row2['CodPregunta']) . '" value="' . htmlspecialchars($row2['CodPregunta']) . '">['
                           . htmlspecialchars($row2['CodPregunta']).'] '. '</option>';
                   }
                   echo '</select>';

echo "</form>";
echo "<div id='result' align='center' ></div>";
    
    
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>
