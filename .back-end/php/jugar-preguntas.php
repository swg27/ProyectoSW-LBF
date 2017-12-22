<?php session_start();

if(isset($_SESSION['user'])){
    include_once('../.others/.Dbconnect.php');

    $queryPlay = "SELECT CodPregunta FROM Preguntas";

    $QueryPlay = mysqli_query($conn, $queryPlay) or die("Error : " . mysqli_error($conn));

    $_SESSION['cantidad_preguntas'] = mysqli_num_rows($QueryPlay);


    $arrayBD = array();

    while($rowPlay = mysqli_fetch_array($QueryPlay))
        array_push($arrayBD, $rowPlay['CodPregunta']);

    $randomNumber = rand(0, count($_SESSION['no_respondidas'])-1);

    if (in_array($_SESSION['no_respondidas'][$randomNumber], $arrayBD)) {

        $cod_pregunta = $_SESSION['no_respondidas'][$randomNumber];

        $queryPlay2 = "SELECT pregunta, respuesta, no_respuesta_1, no_respuesta_2, no_respuesta_3 FROM Preguntas WHERE CodPregunta=$cod_pregunta";

        $QueryPlay2 = mysqli_query($conn, $queryPlay2) or die("Error : ".mysqli_error($conn));

        $rowPlay2 = mysqli_fetch_array($QueryPlay2);


        echo "<form name='fpregunta' id='fpregunta'>";

        echo '</br></br><button type="button" id="comprobar" class="btn btn-success" value="Comprobar pregunta" onClick="ajaxComprobar()">Comprobar pregunta <i class="fa fa-question-circle-o" aria-hidden="true"></i></button></br></br>';
        echo '<input type="hidden" id="codigo" value="'.$cod_pregunta.'"/>';

        $pregunta .= "</br><p align='center' class='btn btn-lg btn-outline-link font-weight-bold' disabled>". htmlspecialchars($rowPlay2['pregunta']) ."</p></br>";

        echo '<div class="alert alert-warning" role="alert">
           '.$pregunta.'
        </div>';


        $correcta .='<option  id="0" value="0">'
            . htmlspecialchars($rowPlay2['respuesta']). '</option>';

        $incorrecta1 .= '<option  id="1" value="1">'
            . htmlspecialchars($rowPlay2['no_respuesta_1']). '</option>';

        $incorrecta2 .= '<option  id="2" value="2">'
            . htmlspecialchars($rowPlay2['no_respuesta_2']). '</option>';

        $incorrecta3 .= '<option  id="3" value="3">'
            . htmlspecialchars($rowPlay2['no_respuesta_3']). '</option>';
        $respuestas = array();

        array_push($respuestas, $correcta, $incorrecta1, $incorrecta2, $incorrecta3);

        echo '<select name="select" class="custom-select btn-primary" id="listaRespuestas"> <option value="sel">Selecione la respuesta correcta</option>';

        for($i = 0 ; $i < 4 ; $i++) {
            $random = rand(0, (count($respuestas)-1));
            echo $respuestas[$random];
            unset($respuestas[$random]);
            sort($respuestas);
        }

        echo '</select></br></br></br>';

        echo '<div id="respuesta"></div>';
        echo '<div id="botones">';
        echo '</br></br><p> Te ha gustado la pregunta?</p></br>';
        echo '<button type="button" id="like" class="btn btn-outline-info blue-gradient" value="Si" onClick="ajaxLike()"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Si, me ha gustado</button> &nbsp;&nbsp;';
        echo '<button type="button" id="dislike" class="btn btn-outline-secondary " value="No" onClick="ajaxDislike()"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> No, no me ha gustado</button></br></br>';
        echo '</div>';

        echo "</form>";

    }else{
        echo "\n la pregunta ha sido borrada intenta nuevamente";
        echo "No contenido el numero $arrayBD[$randomNumber]";
    }
}


?>