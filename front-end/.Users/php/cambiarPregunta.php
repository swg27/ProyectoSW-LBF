<?php include_once ('../../../.back-end/php/seguridadProfesor.php'); ?>
<!DOCTYPE html>
<?php

if(isset($_SESSION['ID']))
{
    $email = $_SESSION['email'];
    if (empty($email)) {
        echo 'error 1';
    } else {

        include_once '../../../.back-end/.others/.Dbconnect.php';

        $error = false;

        $sql = "SELECT email, imagen FROM users WHERE email='$email' ";

        if (!mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'>alert('Credenciales incorrectas!');</script>";
            die('Error: ' . mysqli_error($conn));
        }else{

        $user = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($user);


         if($email == $row['email']) {

        $query = "SELECT CodPregunta, pregunta FROM Preguntas";
        $QueryCollectionPreguntas = mysqli_query($conn, $query) or die ('Error : '.mysqli_error($conn));
?>



<html>
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <title>Preguntas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
          crossorigin="anonymous"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.3/css/mdb.min.cs/s">
    <link rel='stylesheet' type='text/css' href='../../estilos/style.css'/>
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (min-width: 530px) and (min-device-width: 481px)'
          href='../../estilos/wide.css'/>
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (max-width: 480px)'
          href='../../estilos/smartphone.css'/>
    <link rel='stylesheet'
          type='text/css'
          href='../../estilos/structure.css'/>

</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../../vars.js"></script>
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

    function ajaxGet() {
        console.log('TRACE 1: ajaxGet ')
        var mygetrequest = new ajaxRequest();
        mygetrequest.onreadystatechange = function () {
            if (mygetrequest.readyState == 4) {
                if (mygetrequest.status == 200 || window.location.href.indexOf("http") == -1) {
                    document.getElementById("result").innerHTML = mygetrequest.responseText;
                }
                else {
                    alert("An error has occured making the request");
                }
            }
        }
        var cod = $('#listaPreguntas option:selected').val();
        console.log(cod);
        mygetrequest.open("GET",host_n_path+"/.back-end/php/obtenerPregunta.php?cod_pregunta=" + cod, true);
        mygetrequest.send(null);

    }

    function ajaxGetDroplist() {
        console.log('TRACE 1: ajaxGetDroplist ')
        var mygetrequest = new ajaxRequest();
        mygetrequest.onreadystatechange = function () {
            if (mygetrequest.readyState == 4) {
                if (mygetrequest.status == 200 || window.location.href.indexOf("http") == -1) {
                    document.getElementById("queries").innerHTML = mygetrequest.responseText;
                }
                else {
                    alert("An error has occured making the request");
                }
            }
        }
        mygetrequest.open("GET",host_n_path+"/.back-end/php/droplist-preguntas.php", true);
        mygetrequest.send(null);

    }

    function ajaxPost(){
        console.log('TRACE 1: ajaxPost()');
        var mypostrequest=new ajaxRequest();
        mypostrequest.onreadystatechange=function(){
            if (mypostrequest.readyState===4){
                if (mypostrequest.status===200 || window.location.href.indexOf("http")===-1){
                    document.getElementById("blk").innerHTML = mypostrequest.responseText;
                }
                else{
                    alert("An error has occured making the request");
                }
            }
        };
        console.log('TRACE 2: ajaxPost()');
        var cod_pregunta = $('#listaPreguntas option:selected').val();
        var userId = encodeURIComponent(document.getElementById("e-mail").value);
        var nivel = encodeURIComponent(document.getElementById("lvl").value);
        var tema = encodeURIComponent(document.getElementById("tm").value);
        var pregunta = encodeURIComponent(document.getElementById("Qst").value);
        var respuesta = encodeURIComponent(document.getElementById("ans").value);
        var incorrecta1 = encodeURIComponent(document.getElementById("noAns1").value);
        var incorrecta2 = encodeURIComponent(document.getElementById("noAns2").value);
        var incorrecta3 = encodeURIComponent(document.getElementById("noAns3").value);
        var parameters="cod_pregunta="+cod_pregunta+"&email="+userId+"&level="+nivel+"&tema="+tema+"&question="+pregunta+"&correctAns="+respuesta+"&incorrectAns1="+incorrecta1+"&incorrectAns2="+incorrecta2+"&incorrectAns3="+incorrecta3;
       console.log(parameters);
        mypostrequest.open("POST", host_n_path+"/.back-end/php/actualizarPregunta.php", true);
        mypostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        mypostrequest.send(parameters);

        console.log('TRACE N: ajaxPost()');
        ajaxGet();
    }

    function ajaxDrop() {
        console.log('TRACE 1: ajaxGet ')
        var mygetrequest = new ajaxRequest();
        mygetrequest.onreadystatechange = function () {
            if (mygetrequest.readyState == 4) {
                if (mygetrequest.status == 200 || window.location.href.indexOf("http") == -1) {
                    document.getElementById("result").innerHTML = mygetrequest.responseText;
                }
                else {
                    alert("An error has occured making the request");
                }
            }
        }
        var cod = $('#listaPreguntas option:selected').val();
        console.log(cod);
        mygetrequest.open("GET",host_n_path+"/.back-end/php/drop-pregunta.php?cod_pregunta=" + cod, true);
        mygetrequest.send(null);

        ajaxGetDroplist();
    }

</script>
<body>
<div id='page-wrap'>
        <header class='main' id='h1'>
            <div id='ident' align="center">
                <table id="t_iden" width="64px">
                    <tr>
                        <td>
                            <p align='center' class='user'><strong>Bienvenido: </strong><?php echo $email?></p>
                        </td>
                        <td id='td_img' height="64px">
                            <?php echo '<img id="u_img" height="128px" src="data:image/type;base64,'.base64_encode( $row['imagen']).' "/>';?>
                        </td>
                    </tr>
                </table>
            </div>
        <span class="right"><a onclick="alert('Cierre de sesion')" href="../../../.back-end/php/logout.php">Logout</a></span>
        <h2>Quiz: el juego de las preguntas</h2>
    </header>
        <div style="height: auto;">
    <nav class='main' id='n1' role='navigation'>
        <span><a href='layout.php'>Inicio</a></span>
        <span><a href='creditos.php'>Creditos</a></span>

    </nav>
    <section class="main" id="s1">

        <div id="queries">
           <form name="fpregunta" id="fpregunta">
               <?php
                   echo '<select name="select" id="listaPreguntas" class="custom-select btn-outline-primary" onchange="ajaxGet()">
                                <option value="">Selecione [cod] de la pregunta.</option>';
                   while($row2=mysqli_fetch_array( $QueryCollectionPreguntas))
                   {
                   echo '<option id="' . htmlspecialchars($row2['CodPregunta']) . '" value="' . htmlspecialchars($row2['CodPregunta']) . '">['
                       . htmlspecialchars($row2['CodPregunta']).'] '. '</option>';
                   }
                   echo '</select>';
                ?>
           </form>
            <div id="result" align="center" "></div>
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

<?php

         }else
                {
    echo "\n Solo pueden acceder usuarios registrados. \n";
    echo "<a href='../../php/register.php'>Registrarse</a>";
            }
        }
    }
}
else
    {
    echo "\n Error";
}
?>