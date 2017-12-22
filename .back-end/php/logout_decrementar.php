<?php session_start(); ?>
<?php

include_once 'seguridad.php';

if(isset($_SESSION['ID']))
{
    $email = $_SESSION['email'];
    if (empty($email)) {
        echo 'error 1';
    }  else {

        include_once '../.others/.Dbconnect.php';

        $sql = "SELECT email FROM users WHERE email='$email'";

        if (!mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'>alert('Credenciales incorrectas!');</script>";
            die('Error: ' . mysqli_error($conn));
        }else{

            $user = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($user);

            if($email == $row['email']) {

                $sqlUpdate = "UPDATE users SET isOn=0 WHERE email='$email'";
                $on = mysqli_query($conn, $sqlUpdate);

                $count = new SimpleXMLElement("<counter><contador></contador></counter>");

                $counter = simplexml_load_file('../xml/contador.xml');
                $contador = $counter->children();
                $count->contador=$counter->contador[0]-1;
                $domxml = new DOMDocument('1.0');
                $domxml->preserveWhiteSpace = false;
                $domxml->formatOutput = true;
                $domxml->loadXML($count->asXML()); /* $xml es nuestro SimpleXMLElement a guardar*/
                $domxml->save('../xml/contador.xml');

                session_unset();
                session_destroy();
                echo '<meta http-equiv="refresh" content="0; URL=../../front-end/php/layout.php">';

 }else
            {
                echo " Solo pueden acceder usuarios registrados. ";
                echo "<a href='../../front-end/php/register.php'>Registrarse</a>";
            }
        }
    }
}
else
{
    echo "Error";
}

?>
