<?php include_once ('../../../.back-end/php/seguridad.php'); ?>
<!DOCTYPE html>
<?php

if(isset($_SESSION['ID']))
{
    $email =$_SESSION['email'];
    if (empty($email)) {
        echo 'error 1';
    }else {
//ob_start();
//session_start();

        include_once '../../../.back-end/.others/.Dbconnect.php';

        $error = false;

        $sql = "SELECT email, imagen FROM users WHERE email='$email'";

        if (!mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'>alert('Credenciales incorrectas!');</script>";
die('Error: ' . mysqli_error($conn));
}else{

    $user = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($user);
    mysqli_close($conn);
    clearstatcache();

    if($email == $row['email']) {



            ?>

<html xmlns="http://www.w3.org/1999/html">
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Creditos</title>
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
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
        <div id='ident' align="center">
            <table id="t_iden" width="64px">
                <tr>
                    <td>
                        <p align='center' class='user'><?echo $email?></p>
                    </td>
                    <td id='td_img' height="64px">
                        <?php echo '<img id="u_img" height="128px" src="data:image/type;base64,'.base64_encode( $row['imagen']).' "/>'?>
                    </td>
                </tr>
            </table>
        </div>
        <span class="right"><a onclick="alert('Cierre de sesion')" href="../../../.back-end/php/logout.php">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
      <div style="height: auto;">
      <nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></span><br/><br/>
          <?php if($_SESSION['usuario'] == 'PROFESOR'){
              echo"<span><a href='cambiarPregunta.php'>Modificar preguntas</a></span>";
          }else if($_SESSION['usuario'] == 'ALUMNO') {
              echo "<span><a href='gestion-preguntas.php'>Gestión de preguntas</a></span>";
          }
          ?>
	</nav>
          <section class="main" id="s1">
              <div align="center" >
                  [Creditos]</br>
                  Autores: Sebastian & Sergio</br>
                  Especialidad: Ingeniería de Software</br>
                  Foto:</br><img src="../resources/img/two-monkeys.jpg" target="_blank" width="30%" height="25%"></br>
                  </br>En el mapa se marcan los municipios de ambos participantes y la localización de la facultad
                  </br></br><div align="center" id ="map" style="width: 75%; height: 45%; margin-left: 1%;"></div>
              </div>

          </section>
      </div>
	<footer class='main' id='f1'>
		<p><a href="https://es.wikipedia.org/wiki/Quiz">Que es un Quiz?</a></p>
		<a href="https://github.com/swg27/">Link GITHUB</a>
	</footer>
  </div>
  <script>

    var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: 43.3118111, lng: -1.9885133}
        });

        // NOTE: This uses cross-domain XHR, and may not work on older browsers.
        map.data.loadGeoJson(
            'map.geojson');
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDs-9wWNPXfKHHVXN3yh1XVj1k414-VVww&callback=initMap">
    </script>
    
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