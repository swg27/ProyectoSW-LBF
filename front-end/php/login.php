<?php session_start(); ?>
<!DOCTYPE html>

<?php
if (isset($_SESSION['ID'])){
        echo("<script> window.location.assign('../.Users/php/layout.php') </script>");
}

if(isset($_POST['submiter']) && $_SERVER["REQUEST_METHOD"] == "POST")
{
$email = trim($_POST['email']);
$contrasenha = crypt(trim($_POST['contrasenha']),"asdf");
echo $contrasenha;

if(empty($email))
{
    echo "<script type='text/javascript'>alert('Email vacio');</script>";
} else if(!preg_match("/^[a-zA-Z0-9!@#\$%\^&\*\?_~\/\\\-\_]{6,20}$/", $contrasenha))
{
    echo "<script type='text/javascript'>alert('Error de credenciales 2');</script>";
}else {

include_once '../../.back-end/.others/.Dbconnect.php';

$error = false;

$sql="SELECT email, password FROM users WHERE email='$email' AND password='$contrasenha' ";

if(!mysqli_query($conn, $sql)){
    echo "<script type='text/javascript'>alert('Credenciales incorrectas!');</script>";
    die('Error: ' . mysqli_error($conn));
}

$user = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($user);
$e_mail = $row['email'];
$pass = $row['password'];
mysqli_close($conn);
clearstatcache();

if($contrasenha == $pass && $email == $e_mail) {

    $_SESSION['ID']=$email;
    if($email == 'web000@ehu.es'){
        $_SESSION['usuario']= "PROFESOR";
        $_SESSION['autentificado'] = 'PROFESOR';
        $_SESSION['email'] = $email;
        echo ("<script>alert('El login se ha hecho adecuadamente, ahora puedes modificar preguntas. Bienvenido:'$e_mail)</script>");
        echo("<script> window.location.assign('../.Users/php/cambiarPregunta.php') </script>");
    } else {
        $_SESSION['usuario'] = 'ALUMNO';
        $_SESSION['autentificado'] = 'ALUMNO';
        $_SESSION['email'] = $email;
        echo ("<script>alert('El login se ha hecho adecuadamente, ahora puedes enviar preguntas. Bienvenido:'$e_mail)</script>");
       // echo("<script> window.location.assign('../.Users/php/jugar-entrenamiento.php') </script>");
        echo("<script> window.location.assign('../.Users/php/layout.php') </script>");
    }
   // header("Location: ../.Users/html/layout.php?!=$email&?=$word");
        }else{
    echo "<script type='text/javascript'>alert('Error de credenciales 3');</script>";
}
    }
}
?>

<html>
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <title>Login</title>
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
<body>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <span class="right"><a href="register.php">Registrarse</a></span>
        <h2>Quiz: el juego de las preguntas</h2></br>
        <h3>Login</h3>
    </header>
    <div style="height: auto;">
    <nav class='main' id='n1' role='navigation'>
        <span><a href='layout.php'>Inicio</a></span>
        <span><a href='../html/creditos.html'>Creditos</a></span>
    </nav>
    <section class="main" id="s1">
        <div align="center"><div id="blk" align="center">
                </br>
                <table>
                    <tr>

                        <form id='freg' name='fregister' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="Post" enctype="multipart/form-data">
                            <td>
                                <?php
                                if(isset($error))
                                {
                                ?>
                    <tr>
                        <td id="error"><?php echo $error; ?></td>
                    </tr>
                    <?php
                    }
                    ?>

                    Email*: &nbsp;
                    <br/><input type="text" size="50" id="e-mail" name="email" placeholder="p.e. pepitoXY" value="<?php if(isset($email)){echo $email;} ?>" /></br>
                    Password*: &nbsp;
                    <br/><div align="center"><input type="password" size="50" id="pass" name="contrasenha" placeholder="p.e. ~!dsd%?@#$^*-_/\101-  o password seguro?" value="<?php if(isset($contrasenha)){echo $contrasenha;} ?>"/></br>
                    <br/><input type="submit" id="submiter" name="submiter" value="Enviar" align="center">&nbsp;
                    <input type=reset value="Clear Form"></div></br></br>

                    </td>
                    </form>
                    </tr>
                </table>
            </div>
            <span><a href='../.Users/php/restablecer-contrasena.php'>restablecer contraseña</a></span></div>
    </section>
        <div>
    <footer class='main' id='f1'>
        <p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
        <a href='https://github.com/swg27/'>Link GITHUB</a>
    </footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    function mostrarImagen(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img_destino').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file_url").change(function(){
        mostrarImagen(this);
    });
</script>
</body>
</html>



