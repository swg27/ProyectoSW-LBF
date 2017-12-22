<!DOCTYPE html>

<html>
<head>
<style>
    .check_error{
        color: red;
    }
</style>
</head>


<?php

if(isset($_POST['email'])) {
    $email = trim($_POST['email']);
    if (empty($email)) {
        echo 'error 1';
    } else {

        include_once '../../.back-end/.others/.Dbconnect.php';

        $error = false;

        $sql = "SELECT email, imagen FROM users WHERE email='$email' ";

        if (!mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'>alert('Credenciales incorrectas!');</script>";
            die('Error: ' . mysqli_error($conn));
        }

        $user = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($user);

        if ($email == $row['email']) {

            $user_img = $row['imagen'];

                $email = trim($_POST['email']);
                $level = trim($_POST['level']);
                $tema = trim($_POST['tema']);
                $question = trim($_POST['question']);
                $correctAns = trim($_POST['correctAns']);
                $incorrectAns1 = trim($_POST['incorrectAns1']);
                $incorrectAns2 = trim($_POST['incorrectAns2']);
                $incorrectAns3 = trim($_POST['incorrectAns3']);

                if (empty($email)) {
                    echo "<p class='check_error'>El email se encuentra vacio<p>";
                } else if (!preg_match("/^(([a-zA-Z]{1,})+[0-9]{3})+@ikasle\.ehu\.+(eus|es)$/", $email)) {
                    echo "<p class='check_error'> email no cumple con lo establecido<p>";
                } else if (empty($level)) {
                    echo "<p class='check_error'>Introduce un nivel<p>";
                } else if (!preg_match("/^[1-5]{1}$/", $level)) {
                    echo "<p class='check_error'>Introduce un nivel valido<p>";
                } else if (empty($tema)) {
                    echo "<p class='check_error'>Introduce un tema<p>";
                } else if (empty ($question)) {
                    echo "<p class='check_error'>Introduce una pregunta<p>";
                } else if (strlen($question) < 10) {
                    echo "<p class='check_error'>La pregunta debe contener al menos 10 caracteres<p>";
                } else if (empty($correctAns)) {
                    echo "<p class='check_error'>Introduce una respuesta<p>";
                } else if (empty($incorrectAns1)) {
                    echo "<p class='check_error'>Introduce una respuesta incorrecta 1<p>";
                } else if (empty($incorrectAns2)) {
                    echo "<p class='check_error'>Introduce una respuesta incorrecta 2<p>";
                } else if (empty($incorrectAns3)) {
                    echo "<p class='check_error'>Introduce una respuesta incorrecta 3<p>";
                } else {

                    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] > 0) {
                        $sql = "INSERT INTO Preguntas(dificultad, tema, pregunta, respuesta, no_respuesta_1, no_respuesta_2, no_respuesta_3, email)
                         VALUES ($level,'$tema','$question','$correctAns','$incorrectAns1','$incorrectAns2','$incorrectAns3','$email')";
                    } else {
                        $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
                        $limite_kb = 16384;

                        if (in_array($_FILES['image']['type'], $permitidos) && $_FILES['image']['size'] <= $limite_kb * 1024) {

                            // Archivo temporal
                            $imagen_temporal = $_FILES['image']['tmp_name'];

                            // Tipo de archivo
                            $tipo = $_FILES['image']['type'];

                            $data = file_get_contents($imagen_temporal);

                            $data = $conn->real_escape_string($data);

                            $sql = "INSERT INTO Preguntas(dificultad, tema, pregunta, respuesta, no_respuesta_1, no_respuesta_2, no_respuesta_3, email, image, tipo_imagen)
                           VALUES ($level,'$tema','$question','$correctAns','$incorrectAns1','$incorrectAns2','$incorrectAns3','$email', '$data', '$tipo')";
                        } else {
                            echo "Formato de archivo no permitido o excede el tamaño límite de $limite_kb Kbytes.";
                        }
                    }
                    if (!mysqli_query($conn, $sql)) {
                        echo "<p> <button onclick='window.history.back()'>Volver atras</button></p>";
                        die('Error: ' . mysqli_error($conn));
                    }

                    echo "<p style='color: green'>one record added</p>";

                    mysqli_close($conn);

                    if (true) {
                        echo "<script type='text/javascript'> alert('insercion realizada correctamente'); </script>";
                    }
                }

        }
    }
}

?>


</html>
