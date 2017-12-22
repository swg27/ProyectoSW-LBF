<?php session_start();
include_once ('../.others/.Dbconnect.php');
if(isset($_SESSION['username']))
    $usuario = $_SESSION['username'];
if(!isset($_SESSION['username']))
    $usuario = addslashes(htmlspecialchars($_GET['username']));
$_SESSION['username'] = $usuario;
$puntos = $_SESSION['puntos'];
$query = "SELECT usuario FROM ranking WHERE usuario='$usuario'";
$Query = mysqli_query($conn, $query) or die("Error : " . mysqli_error($conn));
$respuesta = array();

while($row2=mysqli_fetch_array($Query)){
    array_push($respuesta, $row2['usuario']);}

if (in_array($usuario, $respuesta)){
    $queryActualizar = "UPDATE ranking SET puntos = puntos + $puntos WHERE usuario = '$usuario'";
    mysqli_query($conn, $queryActualizar) or die ("Error : " . mysqli_error($conn));
   echo "Puntuación actualizada, ahora puedes ver tu puntuación actualizada en el ranking!";
} else {
    $queryInsertar = "INSERT INTO ranking VALUES ('$usuario' , $puntos)";
    mysqli_query($conn, $queryInsertar) or die ("Error : " . mysqli_error($conn));
   echo "Usuario introducido, ahora puedes verte en el ranking!";
}

?>