<?php session_start(); ?>
<?php

if(isset($_SESSION['Recuperar'])){

    if(isset($_POST['email']) && $_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['email']);
        $username = trim($_POST['username']);
        $contrasenha = crypt(trim($_POST['contrasenha']), "asdf");
        $rep_contrasenha = crypt(trim($_POST['rep_contrasenha']), "asdf");

        if (empty($email)) {
            echo 'Email vacio';
        } else if (!preg_match("/^(([a-zA-Z]{1,}\ ){1,10})([a-zA-Z]{1,})$/", $nombre)) {
            echo 'El nombre no cumple con lo establecido';
        } else if ($rep_contrasenha !== $contrasenha) {
            echo 'Las contraseña no concuerdan entre si';
        } else {

            require_once('../../../nusoap/src/nusoap.php');

            $pass = addslashes(htmlspecialchars(trim($_POST['contrasenha'])));
            $ns2 = "http://localhost/SW/ProyectoSW-LBF/.back-end/php/web-services/comprobar-contrasena.php?wsdl";
            $soapclient2 = new nusoap_client($ns2, true);

            $passIsValid = $soapclient2->call('verifyPassword', array('pass' => $pass));


            if ($passIsValid === 'VALIDA') {

                include_once '../../../.back-end/.others/.Dbconnect.php';

                $pass = crypt($contrasenha, 'asdf');

                $sql = "UPDATE users SET password='$pass' WHERE email='$email'";

                $query = mysqli_query($conn, $sql) or die ('Error' . mysqli_error($conn));

                session_destroy();

                mysqli_close($conn);

                header("Location: ../../php/login.php");

                exit();
            }

        }

    }
                    ?>
    <form name="fnueva-contrasena" id="fnueva-contrasena" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="Post">
    Email*: &nbsp;</br><input type="text" size="50" id="e-mail" name="email" placeholder="p.e. alumnoxyz@ikasle.ehu.eus" value="<?php if(isset($email)){echo $email;} ?>"  <?php if(isset($code) && $code == 1){ echo "autofocus"; }  ?> /></br>
    Nuevo Password*: &nbsp;</br><input type="password" size="50" id="pass" name="contrasenha" placeholder="p.e. ~!dsd%?@#$^*-_/\101-  o password seguro?" value="<?php if(isset($contrasenha)){echo $contrasenha;} ?>"  <?php if(isset($code) && $code == 4){ echo "autofocus"; }  ?>></br>
    Repetir nuevo password*: &nbsp;</br><input type="password" size="50" id="rep_pass" name="rep_contrasenha" placeholder="p.e. Abcd1234 o password seguro?" value="<?php if(isset($rep_contrasenha)){echo $rep_contrasenha;} ?>"  <?php if(isset($code) && $code == 5){ echo "autofocus"; }  ?>></br>
    <input type="submit" id="submiter" name="submiter" value="Enviar" align="center"  />&nbsp;
    <input type=reset value="Clear Form"/></br></br>
    </form>
    <?php


}

?>