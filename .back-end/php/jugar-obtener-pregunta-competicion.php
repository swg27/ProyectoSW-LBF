<?php session_start();

if(isset($_SESSION['user'])){
    include_once('../.others/.Dbconnect.php');

    $tema = addslashes(htmlspecialchars($_GET['tema']));
    $_SESSION['tema_actual'] = $tema;

    if(!isset($_SESSION['temas_usados'][$tema]))
        $_SESSION['temas_usados'][$tema] = 0;

    if(!isset($_SESSION['complejidad'][$tema]))
        $_SESSION['complejidad'][$tema] = 0;

    if(!isset($_SESSION['aciertos_actual'][$tema]))
        $_SESSION['aciertos_actual'][$tema] = 0;

    if(!isset($_SESSION['fallos_actual'][$tema]))
        $_SESSION['fallos_actual'][$tema] = 0;

    $queryPlay = "SELECT CodPregunta FROM Preguntas WHERE tema='$tema'";

    $QueryPlay = mysqli_query($conn, $queryPlay) or die("Error : " . mysqli_error($conn));

    $_SESSION['cantidad_preguntas'] = mysqli_num_rows($QueryPlay);

    $arrayBD = array();

    while($rowPlay = mysqli_fetch_array($QueryPlay))
        array_push($arrayBD, $rowPlay['CodPregunta']);

    if($_SESSION['temas_usados'][$tema] < 3 && $_SESSION['cantidad_preguntas'] > 0 && $_SESSION['temas_usados'][$tema] < count($arrayBD)){


        $randomNumber = rand(0, count($arrayBD)-1);

        if (in_array($arrayBD[$randomNumber], $_SESSION['no_respondidas'])) {

            $_SESSION['temas_usados'][$tema] = $_SESSION['temas_usados'][$tema]+1;

            echo $tema," : ",$_SESSION['temas_usados'][$tema];
            $cod_pregunta = $arrayBD[$randomNumber];

            $queryPlay2 = "SELECT CodPregunta, dificultad,pregunta, respuesta, no_respuesta_1, no_respuesta_2, no_respuesta_3 FROM Preguntas WHERE tema='$tema' AND CodPregunta=$cod_pregunta";

            $QueryPlay2 = mysqli_query($conn, $queryPlay2) or die("Error : ".mysqli_error($conn));

            $rowPlay2 = mysqli_fetch_array($QueryPlay2);

            $_SESSION['complejidad'][$tema] = $_SESSION['complejidad'][$tema] + $rowPlay2['dificultad'];
            $_SESSION['complejidad_total']['sum'] = $_SESSION['complejidad_total']['sum'] + $rowPlay2['dificultad'];
            $_SESSION['complejidad_total']['cant'] = $_SESSION['complejidad_total']['cant'] + 1;

            echo "<form name='fpregunta' id='fpregunta'>";

            if($_SESSION['temas_usados'][$tema] == 3){
                echo '</br></br><button type="button" id="comprobar" class="btn btn-success" value="Comprobar pregunta" onClick="ajaxComprobar()">Comprobar pregunta <i class="fa fa-question-circle-o" aria-hidden="true"></i></button></br></br>';
                echo '</br><button type="button" id="info-media" class="btn btn-info" value="info-media" disabled onClick="return ajaxGetPlayQuestion(true)">Obtener informacion sobre la media de las preguntas <i class="fa fa-gamepad" aria-hidden="true"></i></button></br></br>';
            }else{
                echo '</br></br><button type="button" id="comprobar" class="btn btn-success" value="Comprobar pregunta" onClick="ajaxComprobar()">Comprobar pregunta <i class="fa fa-question-circle-o" aria-hidden="true"></i></button></br></br>';
            }
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
            echo "</br>";
            echo "\n la pregunta ha sido borrada intenta nuevamente";
            echo "\n No contenido el numero $arrayBD[$randomNumber]";
        }

    }else if($tema == "Sel $ null"){
        echo '</br></br>
              <div id="feedback-no-tema" class="alert alert-danger"  style="display: inline-block" role="alert">
                <h4 class="alert-heading"><div><i class="material-icons">free_breakfast</i> Seleccione tema</div></h4>
                <hr>
             <p class="mb-0">"No ha elegido un tema aún!"</p>
            </div>';
    }else{

        $med_complejidad = number_format($_SESSION['complejidad'][$tema] / $_SESSION['temas_usados'][$tema],2);
        $med_complejidad_total = number_format($_SESSION['complejidad_total']['sum']/$_SESSION['complejidad_total']['cant'],2);
        echo '</br></br>
             <div id="feedback-info-usuario" class="alert alert-success" style="display: inline-block; overflow: hidden" role="alert">
                 <h4 class="alert-heading"><div><i class="fa fa-gamepad" aria-hidden="true"></i> Complejidad media total de las preguntas : '.$med_complejidad_total.' </br> Complejidad media de las preguntas del tema actual : '.$med_complejidad.' </div></h4>
                  <hr>
                <p class="mb-0">Aciertos Totales : '.$_SESSION['aciertos'].' | Fallos Totales:  '.$_SESSION['fallos'].'   </p>
                 <hr>
                <p class="mb-0">Aciertos : '.$_SESSION['aciertos_actual'][$tema].' | Fallos:  '.$_SESSION['fallos_actual'][$tema].'   </p>
                </div></br>';
        if(!isset($_GET['alert'])){
            echo '<div id="feedback-max-preguntas" class="alert alert-danger"  style="display: inline-block" role="alert">
                <h4 class="alert-heading"><div><i class="material-icons">group_work</i> Seleccione otro tema</div></h4>
                <hr>
                <p class="mb-0">"Has superado el máximo de preguntas permitdas sobre este tema!"</p>
            </div>';
        }
    }
}


?>