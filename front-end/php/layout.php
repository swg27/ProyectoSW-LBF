<!DOCTYPE html>
<html>
<head>
    <meta
            name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <title>Preguntas</title>
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
<script>
    function irAJugarEntrenamiento() {
        window.location.href = 'jugar-entrenamiento.php';
    }

    function irAJugarCompeticion() {
        window.location.href = 'jugar-competicion.php';
    }
</script>
<body>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <div>
        <span class="right"><a href="register.php">Registrarse</a></span>
        <span class="right"><a href="login.php">Login</a></span></br>
        <span class="right"><a href="../.Users/php/restablecer-contrasena.php">Restablecer contraseña</a></span><br/>
        <div class="alert alert-info" disable><h2>Quiz: el juego de las preguntas</h2></div>
        </div>
    </header>
    <div style="height: auto;">
        <nav class='main' id='n1' role='navigation'>
            <span><a href='jugar-entrenamiento.php'>Jugar</a></span>
            <br/><br/>
            <span><a href='../html/creditos.html'>Creditos</a></span>
        </nav>
        <section class="main" id="s1">
            <br/>

            <div data-spy="scroll" data-target="#score-table" align="center" style="width: 80%;margin: auto;" class="list-group">
                <div id="feedback-comprobar" class="alert alert-success" align="center" style="display: inline-block; overflow: hidden" role="alert">
                    <h4 class="alert-heading"><div><i class="fa fa-trophy" aria-hidden="true"></i> Top 10</div></h4>
                    <hr>
                    <p class="mb-0">"¿No estas en el top 10?"<br/> ¿Que esperas para empezar a jugar?</p>
                </div>
                <div align="center" >
                    <button type="button" class="btn btn-outline-info" style="width: 25%;" onclick="irAJugarEntrenamiento()">Jugar entrenamiento <i class="fa fa-play-circle-o" aria-hidden="true"></i></button>
                <br/><br/>
                <button type="button" class="btn btn-outline-info" style="width: 35%;" onclick="irAJugarCompeticion()">Jugar competición +score <i class="fa fa-futbol-o" aria-hidden="true"></i></button>
                </div>
                <table id="score-table" class="table table-striped table-dark scrollspy" data-offset="0" style="width: 75%;height: 50%; margin: auto;">
                    <thead>
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Puntuación</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include_once('../../.back-end/.others/.Dbconnect.php');
                    $query = "SELECT usuario, puntos FROM ranking ORDER BY puntos DESC, usuario ASC";
                    $Query = mysqli_query($conn, $query) or die("Error : " . mysqli_error($conn));
                    $n = 0;
                    while($row2=mysqli_fetch_array( $Query))
                    {
                        echo '<tr><td>'. $row2["usuario"]. '</td><td>'. $row2["puntos"]. '</td></tr>';
                        $n++;
                        if($n > 0 && !($n < 10))
                            break;
                    }
                    ?>
                    </tbody>
                </table>
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
