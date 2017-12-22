<?php session_start();
include_once ('../.others/.Dbconnect.php');
$usuario = $_SESSION['username'];
$puntos = $_SESSION['puntos'];
$query = "SELECT usuario FROM ranking WHERE usuario = '$usuario'";
$Query = mysqli_query($conn, $query) or die("Error : " . mysqli_error($conn));
$respuesta = array();

while($row2=mysqli_fetch_array($Query))
                   {
                    array_push($respuesta, $row2['usuario']);
                   }
if (in_array($usuario, $respuesta)){
    $queryActualizar = "UPDATE ranking SET puntos = puntos + $puntos WHERE usuario = '$usuario'";
    mysqli_query($conn, $queryActualizar) or die ("Error : " . mysqli_error($conn));
    echo "Puntuación introducida, ahora puedes verte en el ranking $_SESSION[username]!";
} else {
    $queryInsertar = "INSERT INTO ranking VALUES ('$usuario' , $puntos)";
    mysqli_query($conn, $queryInsertar) or die ("Error : " . mysqli_error($conn));
    echo "Puntuación actualizada, ahora puedes verte en el ranking $_SESSION[username]!";
}
?>