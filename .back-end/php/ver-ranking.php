<!DOCTYPE html>
<html>
    <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='../estilos/style.css'/>
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (min-width: 530px) and (min-device-width: 481px)'
          href='../estilos/wide.css'/>
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (max-width: 480px)'
          href='../estilos/smartphone.css'/>
    </head>
    <style>
    #ident{
        margin: auto;
        background-color: rgba(10, 56, 75, 0.62);
        width:750px;
        height:156px;
        border:1px solid rgba(10, 131, 169, 0.93);
        padding:10px;
    }

    #t_iden{
        background-color: rgba(255, 255, 255, 0.79);
        width:750px;
        height:156px;
        border:1px solid rgba(10, 131, 169, 0.93);
        padding:10px;
    }
    .user {
        margin: auto;
        color: dodgerblue;
    }
    </style>
    <body>
        <div id='page-wrap'>
        <header class='main' id='h1'>
            <div id='ident' align="center">
                <table id="t_iden" width="64px">
                    <tr>
                        <td>
                            <p align='center' class='user'><strong>Bienvenido: ANONIMO </strong></p>
                        </td>
                    </tr>
                </table>
            </div>
            <span class="right"><a onclick="alert('Cierre de sesion')" href="../.back-end/php/logout.php">Logout</a></span>
        <h2>Quiz: el juego de las preguntas</h2>
    </header>
        <div style="height: auto;">
    <nav class='main' id='n1' role='navigation'>
        <span> <a href='jugar.php'>Jugar</a></span>
        <span><a href='../html/creditos.html'>Creditos</a></span>
    </nav>
    <section class="main" id="s1">

        <div>
            <table>
            <tr>
                <th>
                    Usuario
                </th>
                <th>
                    Puntos
                </th>
            </tr>
<?php
include_once ('.Dbconnect.php');
$query = "SELECT usuario, puntos FROM ranking ORDER BY puntos DESC";
$Query = mysqli_query($conn, $query) or die("Error : " . mysqli_error($conn));
 while($row2=mysqli_fetch_array( $Query))
                   {
                       echo '<tr><td>'. $row2["usuario"]. '</td><td>'. $row2["puntos"]. '</td></tr>';
                   }
?>
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








