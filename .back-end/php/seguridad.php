<?php
//Inicio la sesión
session_start();
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
if(isset($_SESSION["autentificado"])){
	if(($_SESSION["autentificado"] != "ALUMNO") && ($_SESSION["autentificado"] != "PROFESOR")){
 //si no existe, envio a la página de autentificación
echo "<script> window.location.assign(layout.php) </script>";
 //además salgo de este script
 exit(0);
	}
}else if(!isset($_SESSION["autentificado"])){
echo "<script> window.location.assign('../../html/layout.html') </script>";
}
?>

