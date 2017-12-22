<?php
//Inicio la sesión
session_start();
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
if(isset($_SESSION["usuario"])){
	if($_SESSION["usuario"] != "ALUMNO"){
 //si no existe, envio a la página de autentificación
echo "<script> window.location.assign('../../php/login.php') </script>";
 //además salgo de este script
 exit(0);
	}
}else if(!isset($_SESSION["usuario"])){
echo "<script> window.location.assign('../../php/login.php') </script>";
}
?> 