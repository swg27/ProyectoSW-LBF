<?php
$codigo = $_GET['cod'];
include_once ('../.others/.Dbconnect.php');
$queryDislike="UPDATE Preguntas SET likes = likes+1 WHERE CodPregunta = $codigo";
$QueryDislike = mysqli_query($conn, $queryDislike) or die("Error : ".mysqli_error($conn));

echo '<div id="feedback-comprobar" class="alert alert-primary" style="display: inline-block; overflow: hidden" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <h5 class="alert-heading"><div><i class="fa fa-smile-o" aria-hidden="true"></i>&nbsp;
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star-half-full" aria-hidden="true"></i>
  </div></h5>
  <hr>
  <p class="mb-0">Gracias por tu valoración!</i></p>
 

</div>';

?>