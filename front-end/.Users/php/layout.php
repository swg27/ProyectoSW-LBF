<?php include_once ('../../../.back-end/php/seguridad.php'); ?>
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
        mysqli_close($conn);
        clearstatcache();

         if($email == $row['email']) {

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(function () {
        window.unload = window.onbeforeunload = function() {
            alert("Do you really want to close?");
        };
    });
</script>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
<div id='page-wrap' align="center">
        <header class='main' id='h1'>
            <div id='ident' align="center">
                <table id="t_iden" width="64px">
                    <tr>
                        <td>
                            <div><p align='center' class='user'><strong>Bienvenido: </strong><?php echo $email?></p></div>
                        </td>
                        <td id='td_img' height="64px">
                            '<img id="u_img" height="128px" src='data:image/type;base64,<?php  echo $row['imagen']; ?> '/>
                        </td>
                    </tr>
                </table>
            </div>
            <span class="right"><a onclick="alert('Cierre de sesion')" href="../../../.back-end/php/logout.php">Logout</a></span>
        <h2>Quiz: el juego de las preguntas</h2>
    </header>
        <div style="height: auto;">
    <nav class='main' id='n1' role='navigation'>
        <span><a href='creditos.php'>Creditos</a></span>
        <?php if($_SESSION['usuario'] == 'PROFESOR'){
            echo"<span><a href='cambiarPregunta.php'>Modificar preguntas</a></span>";
        }else if($_SESSION['usuario'] == 'ALUMNO') {
           echo "<span><a href='gestion-preguntas.php'>Gestión de preguntas</a></span>";
        }
        ?>

    </nav>
    <section class="main" id="s1">

        <div>
            Aqui se visualizan las preguntas y los creditos ...
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