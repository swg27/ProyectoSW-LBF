<?php session_start(); ?>
<!DOCTYPE html>
<?php

include_once ('../../.back-end/.others/.Dbconnect.php');

if(!isset($_SESSION['user'])){
    $_SESSION['user'] = 'invitado';
    $_SESSION['respondidas']  = array();
    $_SESSION['temas_usados'] = array();
    $_SESSION['cantidad_preguntas_respondidas'] = 0;
    $_SESSION['aciertos_actual'];
    $_SESSION['fallos_actual'];
    $_SESSION['aciertos'] = 0;
    $_SESSION['fallos'] = 0;
    $_SESSION['complejidad'];
    $_SESSION['complejidad_total']['sum'] = 0;
    $_SESSION['complejidad_total']['cant'] = 0;
    $_SESSION['activar_alert'] = false;
    $_SESSION['tema_actual'];
    $_SESSION['puntos'] = 0;

    $query = "SELECT CodPregunta FROM Preguntas";

    $Query = mysqli_query($conn, $query) or die("Error : ".mysqli_error($conn));

    $array = array();

    while($row = mysqli_fetch_array($Query))
        array_push($array, $row['CodPregunta']);

    $_SESSION['no_respondidas'] = $array;
    $_SESSION['cantidad_preguntas'] = count($array);

}


$queryT = "SELECT tema FROM Preguntas GROUP BY tema";
$QueryCollectionTemas = mysqli_query($conn, $queryT) or die ('Error : '.mysqli_error($conn));

?>
<html>
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <title>Jugar Competición</title>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
          crossorigin="anonymous"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.3/css/mdb.min.cs/s">
    <link rel='stylesheet' type='text/css' href='../estilos/style.css'/>
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (min-width: 530px) and (min-device-width: 481px)'
          href='../estilos/wide.css'/>
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (max-width: 480px)'
          href='../estilos/smartphone.css'/>
    <link rel='stylesheet'
          type='text/css'
          href='../estilos/structure.css'/>

</head>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../vars.js"></script>
<script>

    var host = 'http://localhost';
    var path = '/SW/ProyectoSW-LBF';
    var host_n_path = getHost();

    function ajaxGetPlayQuestion(c) {
        console.log('TRACE 1: ajaxGetPlayQuestion ')
        var mygetrequest = new XMLHttpRequest();
        mygetrequest.onreadystatechange = function () {
            if (mygetrequest.readyState === 4) {
                if (mygetrequest.status === 200) {
                    $('#query').html(mygetrequest.responseText);
                }
                else {
                    alert("An error has occured making the request");
                }
            }
        }
        var tema = $('#listaTemas option:selected').val();
        var temas = "temas";
        if(c){
            mygetrequest.open("GET",host_n_path+"/.back-end/php/jugar-obtener-pregunta-competicion.php?alert=true&tema="+tema, true);
        }else{
            mygetrequest.open("GET",host_n_path+"/.back-end/php/jugar-obtener-pregunta-competicion.php?tema="+tema, true);
        }
        mygetrequest.send(null);
    }

    function ajaxLike() {
        console.log('TRACE 1: ajaxLike ')
        var mygetrequest = new XMLHttpRequest();
        mygetrequest.onreadystatechange = function () {
            if (mygetrequest.readyState === 4) {
                if (mygetrequest.status === 200) {
                    $("#botones").html(mygetrequest.responseText);
                }
                else {
                    alert("An error has occured making the request");
                }
            }
        }
        var cod = $('#codigo').val();
        mygetrequest.open("GET",host_n_path+"/.back-end/php/like.php?cod="+cod, true);
        mygetrequest.send(null);

    }
    function ajaxDislike() {
        console.log('TRACE 1: ajaxDislike ')
        var mygetrequest = new XMLHttpRequest();
        mygetrequest.onreadystatechange = function () {
            if (mygetrequest.readyState === 4) {
                if (mygetrequest.status === 200) {
                    $("#botones").html(mygetrequest.responseText);
                }
                else {
                    alert("An error has occured making the request");
                }
            }
        }
        var cod = $('#codigo').val();
        mygetrequest.open("GET",host_n_path+"/.back-end/php/dislike.php?cod="+cod, true);
        mygetrequest.send(null);

    }
    function ajaxComprobar() {
        console.log('TRACE 1: ajaxLike ')

        var mygetrequest = new XMLHttpRequest();
        mygetrequest.onreadystatechange = function () {
            if (mygetrequest.readyState === 4) {
                if (mygetrequest.status === 200) {
                    $("#respuesta").html(mygetrequest.responseText);
                    if(seleccionada === '0'){
                        $('#comprobar').prop('disabled', true);
                        $('#listaRespuestas').prop('disabled', true);
                        $('#info-media').prop('disabled', false);
                    }

                }
                else {
                    alert("An error has occured making the request");
                }
            }
        }
        var cod = $('#codigo').val();
        var seleccionada = $('#listaRespuestas option:selected').val();
        mygetrequest.open("GET",host_n_path+"/.back-end/php/comprobar-competicion.php?respuesta="+seleccionada+"&cod="+cod, true);
        mygetrequest.send(null);
    }

    function guardarUsuario() {
        var username = $('#username').val();
        var mygetrequest = new XMLHttpRequest();
        mygetrequest.onreadystatechange = function () {
            if (mygetrequest.readyState === 4) {
                if (mygetrequest.status === 200) {
                    alert(mygetrequest.responseText);
                    $('#welcome-user').html(username);
                    $('#username-container').html('<div align="center" style="margin: auto;"><button type="button" id="update-score" class="btn btn-outline-primary"  value="Guardar puntuacion" onclick="guardarPuntuacion()" ><i class="fa fa-save" aria-hidden="true"></i> Guardar Puntuación</button></div>');
                }
                else {
                    alert("An error has occured making the request");
                }
            }
        }

        mygetrequest.open("GET", host_n_path + "/.back-end/php/guardar-usuario-jugar.php?username="+username, true);
        mygetrequest.send(null);
    }

    function guardarPuntuacion() {
        var mygetrequest = new XMLHttpRequest();
        mygetrequest.onreadystatechange = function () {
            if (mygetrequest.readyState === 4) {
                if (mygetrequest.status === 200) {
                    alert(mygetrequest.responseText);
                }
                else {
                    alert("An error has occured making the request");
                }
            }
        }
        mygetrequest.open("GET", host_n_path + "/.back-end/php/actualizar-ranking.php", true);
        mygetrequest.send(null);
    }


    function printSel() {
        alert($('#listaTemas option:selected').val());
    }

</script>
<body>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <div id='ident' align="center">
            <table id="t_iden" width="64px">
                <tr>
                    <td>
                        <div align='center' class='user'><strong>Bienvenido: </strong><p id="welcome-user"><?php if(isset($_SESSION['username']))echo $_SESSION['username']; ?></p></div>

                        <?php if(!(isset($_SESSION['username']))){
                            echo '<div id="username-container" class="input-group" align="center" style="width: 55%;margin: auto;">
                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                        <input type="text" id="username" class="form-control" placeholder="Ingresa un username" aria-label="Username" aria-describedby="basic-addon1"/>
                        <button type="button" id="in-user" class="btn btn-outline-primary"  value="Guardar usuario" onclick="guardarUsuario()" ><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                    </div>';
                        }else{
                            echo '<div align="center" id="update-score-cointainer" ><button type="button" id="update-score" class="btn btn-outline-primary"  value="Guardar puntuacion" onclick="guardarPuntuacion()" ><i class="fa fa-save" aria-hidden="true"></i> Guardar Puntuación</button></div>';
                        }?>
                    </td>
                    <td id='td_img' height="64px">
                        <?php /*echo '<img id="u_img" height="128px" src="data:image/type;base64,'.base64_encode( $row['imagen']).' "/>'*/?>
                    </td>
                </tr>

            </table>
            <table>

            </table>
        </div>
        <div class="alert alert-info" disable><h2>Quiz: el juego de las preguntas</h2></div>
    </header>
    <div style="height: auto;">
        <nav class='main' id='n1' role='navigation'>
            <span><a href='layout.php'>Home</a></span>
            <br/><br/>
            <span><a href='../html/creditos.html'>Creditos</a></span>

        </nav>
        <section class="main" id="s1">
            <form id="fjugar" name="fjugar">
                </br><button type="button" class="btn btn-outline-primary" value="Obtener pregunta" onclick="return ajaxGetPlayQuestion()">Obtener pregunta <i class="fa fa-circle-o-notch" aria-hidden="true"></i></button>


            </form>
            <div id="temas">
                <h5>Tema:</h5>
                <form name="fTemas" id="fTemas">
                    <?php
                    echo '<select name="selectTema" id="listaTemas" class="custom-select btn-outline-primary" >
                                <option value="Sel $ null">Selecionar tema</option>';
                    while($rowTms=mysqli_fetch_array($QueryCollectionTemas))
                    {
                        echo '<option id="'.htmlspecialchars($rowTms['tema']).'" value="'.htmlspecialchars($rowTms['tema']).'">'.htmlspecialchars($rowTms['tema']).'</option>';
                    }
                    echo '</select>';
                    ?>
                </form>

                <div id="query">
                    Aqui se jugará
                </div>
            </div>

        </section>
    </div>
    <footer class='main' id='f1'>
        <p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
        <a href='https://github.com/swg27/'>Link GITHUB</a>
    </footer>
</div>



</body>
</html>

