<?php session_start(); ?>
<!DOCTYPE html>
<?php

    if(!isset($_SESSION['user'])){
    $_SESSION['user'] = 'invitado';
    $_SESSION['respondidas']  = array();

    include_once ('../../.back-end/.others/.Dbconnect.php');

    $query = "SELECT CodPregunta FROM Preguntas";

    $Query = mysqli_query($conn, $query) or die("Error : ".mysqli_error($conn));

    $array = array();

    while($row = mysqli_fetch_array($Query))
        array_push($array, $row['CodPregunta']);


    $_SESSION['no_respondidas'] = $array;
    $_SESSION['cantidad_preguntas'] = count($array);

    }

    ?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <title>Jugar</title>
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

    function ajaxRequest(){
        var activexmodes=["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"]; //activeX versions to check for in IE
        if (window.ActiveXObject){ //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
            for (var i=0; i<activexmodes.length; i++){
                try{
                    return new ActiveXObject(activexmodes[i]);
                }
                catch(e){
                    //suppress error
                }
            }
        }
        else if (window.XMLHttpRequest) // if Mozilla, Safari etc
            return new XMLHttpRequest();
        else
            return false;
    }

    function ajaxGetPlayQuestion() {
        console.log('TRACE 1: ajaxGetPlayQuestion ')
        var mygetrequest = new XMLHttpRequest();
        mygetrequest.onreadystatechange = function () {
            if (mygetrequest.readyState === 4) {
                if (mygetrequest.status === 200) {
                    document.getElementById("query").innerHTML = mygetrequest.responseText;
                }
                else {
                    alert("An error has occured making the request");
                }
            }
        }
        mygetrequest.open("GET",host_n_path+"/.back-end/php/jugar-preguntas.php", true);
        mygetrequest.send(null);
    }

    function ajaxLike() {
        console.log('TRACE 1: ajaxLike ')
        var mygetrequest = new XMLHttpRequest();
        mygetrequest.onreadystatechange = function () {
            if (mygetrequest.readyState == 4) {
                if (mygetrequest.status == 200 || window.location.href.indexOf("http") == -1) {
                    document.getElementById("botones").innerHTML = mygetrequest.responseText;
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
        console.log('TRACE 1: ajaxLike ')
        var mygetrequest = new XMLHttpRequest();
        mygetrequest.onreadystatechange = function () {
            if (mygetrequest.readyState == 4) {
                if (mygetrequest.status == 200 || window.location.href.indexOf("http") == -1) {
                    document.getElementById("botones").innerHTML = mygetrequest.responseText;
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
            if (mygetrequest.readyState == 4) {
                if (mygetrequest.status == 200 || window.location.href.indexOf("http") == -1) {
                    document.getElementById("respuesta").innerHTML = mygetrequest.responseText;
                }
                else {
                    alert("An error has occured making the request");
                }
            }
        }
        var cod = $('#codigo').val();
        var seleccionada = $('#listaRespuestas option:selected').val();
        mygetrequest.open("GET",host_n_path+"/.back-end/php/comprobar.php?respuesta="+seleccionada+"&cod="+cod, true);
        mygetrequest.send(null);

    }

</script>
<body>
<div id='page-wrap'>
        <header class='main' id='h1'>
            <div id='ident' align="center">
                <table id="t_iden" width="64px">
                    <tr>
                        <td>
                            <p align='center' class='user'><strong>Bienvenido: </strong><?php /*echo $email*/?></p>
                        </td>
                        <td id='td_img' height="64px">
                            <?php /*echo '<img id="u_img" height="128px" src="data:image/type;base64,'.base64_encode( $row['imagen']).' "/>'*/?>
                        </td>
                    </tr>
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
        <div id="query">
            Aqui se jugará
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

