<!DOCTYPE html>
<html>
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <title>Restablecer contraseña</title>
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
<div id='page-wrap' style="margin: auto;" align="center">
    <header class='main' id='h1'>
        <h2>Quiz: el juego de las preguntas</h2>
    </header>
    <div style="height: auto;margin: auto;">
        <nav class='main' id='n1' role='navigation'>
            <span><a href='../../php/layout.php'>Inicio</a></span>
            <span><a href='../../html/creditos.html'>Creditos</a></span>
        </nav>
        <section class="main" id="s1">

            <div>
               <form name="frestablecer" id="frestablecer" action="../../../.back-end/php/restablecer-password.php" method="Post">
                   Email*: &nbsp;</br><input type="text" size="50" id="e-mail" name="email" placeholder="p.e. alumnoxyz@ikasle.ehu.eus" value="<?php if(isset($email)){echo $email;} ?>"  <?php if(isset($code) && $code == 1){ echo "autofocus"; }  ?> /></br>
                  <input type="submit" id="submiter" name="submiter" value="Enviar" align="center" />&nbsp;
                   <input type=reset value="Clear Form"/></br></br>
               </form>
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