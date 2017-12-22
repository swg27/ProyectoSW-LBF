<!DOCTYPE html>
<?php include ('../../.back-end/.others/vars.php'); ?>
<html>
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />
    <title>Registro</title>
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

    <style>
        div #result{
            color: #000000;
        }
        div #result2{
            color: #000000;
        }
    </style>

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../vars.js"></script>
<script>
    var host = 'http://localhost';
    var path = '/SW/ProyectoSW-LBF';
    var host_n_path = getHost();
    var flag1 = false;
    var flag2 = false;

    $(function(){

       switchButton();

        $('#e-mail:input').keydown(function () {
            $('#e-mail:input').css("background-color", "#efa");
            alumnoValido();
            switchButton();
        });
        $('#e-mail:input').keyup(function () {
            $('#e-mail:input').css("background-color", "#93ff9a");
            alumnoValido();
            switchButton();
        });
        $('#pass:input').keydown(function () {
            $('#pass:input').css("background-color", "#efa");
            alumnoValido();
            switchButton();
        });
        $('#pass:input').keyup(function () {
            $('#pass:input').css("background-color", "#93ff9a");
           contrasenaValida();
            switchButton();
        });
        $('#pass:input').click(function () {
            $('#pass:input').css("background-color", "#efa");
            alumnoValido();
            switchButton();
        });
        $('#e-mail:input').mouseover(function () {
            $('#pass:input').css("background-color", "#efa");
            alumnoValido();
            switchButton();
        });

    });

    function switchButton() {
        if(flag1 === true && flag2===true){
            $('#submiter').show();
        }else{
            $('#submiter').hide();
        }
    }

    function alumnoValido() {
            $('#e-mail:input').css("background-color", "#83eedb");
            var mypostrequest=new ajaxRequest();
            mypostrequest.onreadystatechange=function(){
                if (mypostrequest.readyState===4){
                    if (mypostrequest.status===200 || window.location.href.indexOf("http")===-1){
                        if(mypostrequest.responseText.trim() === 'NO'){
                            $('#e-mail:input').css("background-color", "pink");
                            $('#result').css("color", "#850000");
                            flag1 = false;
                            $('#result').text('Lo sentimos, alumno desconocido o no valido.');
                        }else if(mypostrequest.responseText.trim() === 'SI'){
                            $('#e-mail:input').css("background-color", "#5eee67");
                            $('#result').css("color", "#19ba00");
                            flag1 = true;
                            switchButton();
                            $('#result').text('Alumno valido.');
                            //window.location.href='../php/login.php';
                        }else{
                            flag1 = false;
                            $('#result').css("color", "#850000");
                            $('#result').text(mypostrequest.responseText);
                        }
                    }
                    else{
                        alert("An error has occured making the request");
                    }
                }
            };

            var parameters= $('#freg').serialize();
            mypostrequest.open("POST", host_n_path+"/.back-end/php/web-services/alumno-valido.php", true);
            mypostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            mypostrequest.send(parameters);

    }

    function contrasenaValida() {
        $('#pass:input').css("background-color", "#e2e2e2");
        var mypostrequest=new ajaxRequest();
        mypostrequest.onreadystatechange=function(){
            if (mypostrequest.readyState===4){
                if (mypostrequest.status===200 || window.location.href.indexOf("http")===-1){
                    if($('#pass').val() == ''){
                        $('#pass:input').css("background-color", "pink");
                        $('#result2').css("color", "#850000");
                        flag2 = false;
                        $('#result2').text('Contrasena considerada debil.');
                    }else if(mypostrequest.responseText.trim() === 'false'){
                        $('#pass:input').css("background-color", "pink");
                        $('#result2').css("color", "#850000");
                        flag2 = false;
                        $('#result2').text('Contrasena considerada debil.');
                    }else if(mypostrequest.responseText.trim() === 'true'){
                        $('#pass:input').css("background-color", "#5eee67");
                        $('#result2').css("color", "#19ba00");
                        flag2 = true;
                        switchButton();
                        $('#result2').text('contrasena considerada fuerte.');
                        //window.location.href='../php/login.php';
                    }else{
                        flag2 = false;
                        $('#result2').css("color", "#850000");
                        $('#result2').text(mypostrequest.responseText);
                    }
                }
                else{
                    alert("An error has occured making the request");
                }
            }
        };

        var parameters= $('#freg').serialize();
        mypostrequest.open("POST", host_n_path+"/.back-end/php/web-services/cliente-comprobar-contrasena.php", true);
        mypostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        mypostrequest.send(parameters);

    }


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

    function ajaxpost(){
        var mypostrequest=new ajaxRequest();
        mypostrequest.onreadystatechange=function(){
            if (mypostrequest.readyState===4){
                if (mypostrequest.status===200 || window.location.href.indexOf("http")===-1){
                    if(mypostrequest.responseText.trim() === 'NO'){
                        alert('Lo sentimos no puedes registrarte.');
                    }else if(mypostrequest.responseText.trim() === 'SI'){
                        alert('Registro realizado exitosamente');
                       //window.location.href='../php/login.php';
                    }else{
                        alert(mypostrequest.responseText);
                    }
                }
                else{
                    alert("An error has occured making the request");
                }
            }
        };

        var parameters= $('#freg').serialize();
        mypostrequest.open("POST", host_n_path+"/.back-end/php/web-services/obtener-datos-alumnos.php", true);
        mypostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        mypostrequest.send(parameters);
    }


</script>
<body>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <span class="right"><a href="login.php">Login</a></span>
        <span class="right" style="display:none;"><a href="/logout">Logout</a></span>
        <h2>Quiz: el juego de las preguntas</h2></br>
        <h3>Registro</h3>
    </header>
    <div style="height: auto;">
    <nav class='main' id='n1' role='navigation'>
        <span><a href='layout.php'>Inicio</a></span>
        <span><a href='../html/creditos.html'>Creditos</a></span>
    </nav>
    <section class="main" id="s1">
        <div align="left"><div id="blk" align="center">
                </br>
                <table>
                    <tr>

                        <form id='freg' name='fregister' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="Post" enctype="multipart/form-data">
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
                    <br/>Email*: &nbsp;</br><input type="text" size="50" id="e-mail" name="email" placeholder="p.e. alumnoxyz@ikasle.ehu.eus" value="<?php if(isset($email)){echo $email;} ?>"  <?php if(isset($code) && $code == 1){ echo "autofocus"; }  ?> /></br>
                    <br/>Nombre, Apellidos*: &nbsp;</br><input type="text" size="50" id="name" name="nombre" placeholder="p.e. Nombre, Apellido1 Apellido2 :" value ="<?php if(isset($nombre)){echo $nombre;} ?>"  <?php if(isset($code) && $code == 2){ echo "autofocus"; }  ?>></br>
                    <br/>Username*: &nbsp;</br><input type="text" size="50" id="nick" name="username" placeholder="p.e. pepitoXY" value="<?php if(isset($username)){echo $username;} ?>"  <?php if(isset($code) && $code == 3){ echo "autofocus"; }  ?>></br>
                    <br/>Password*: &nbsp;</br><input type="password" size="50" id="pass" name="contrasenha" placeholder="p.e. ~!dsd%?@#$^*-_/\101-  o password seguro?" value="<?php if(isset($contrasenha)){echo $contrasenha;} ?>"  <?php if(isset($code) && $code == 4){ echo "autofocus"; }  ?>></br>
                    <br/>Repetir password*: &nbsp;</br><input type="password" size="50" id="rep_pass" name="rep_contrasenha" placeholder="p.e. Abcd1234 o password seguro?" value="<?php if(isset($rep_contrasenha)){echo $rep_contrasenha;} ?>"  <?php if(isset($code) && $code == 5){ echo "autofocus"; }  ?>></br>
                    <br/><div align="center"><input type="button" id="submiter" name="submiter" value="Registrarme" align="center"  class="btn btn-outline-primary" onclick="return ajaxpost(this)"/>&nbsp;
                    <input type=reset class="btn btn-outline-primary" value="Clear Form"/></div></br></br>
                    </td>
                    <td>
                        <div style="margin-left: 5%; margin-bottom: 32%">

                            <div align="left">
                                <img id="img_destino" src="../resources/img/default.jpg" alt="Tu imagen" align="center" width="256px"/>
                            </div><br/>
                            <input id="file_url" type="file" name="image" align="center" style="margin-left: 1%;"/><br/>
                        </div>
                    </td>
                    </form>
                    </tr>
                </table>
            </div></div>
        <div>
        <div id="result">!</div>
        <div id="result2">!</div>
        </div>
    </section>
    </div>
    <footer class='main' id='f1'>
        <p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
        <a href='https://github.com/swg27/'>Link GITHUB</a>
    </footer>
    </div>
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