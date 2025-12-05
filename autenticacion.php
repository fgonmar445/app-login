<?php
include "establecer-sesion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Comprobar si el token CSRF enviado en el formulario coincide con el token almacenado en la sesión
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        // El token es válido, procesar el formulario
        // Realizar la acción deseada 
        echo "Formulario enviado correctamente."; // totalmente opcional, si acaso, en un alert
    } else {
        // El token no es válido, posible ataque CSRF
        die("Solicitud no válida. Token CSRF no coincide."); // o mensaje en alert y redirección a index
    }
}

if (isset($_POST['user']) && isset($_POST['pass'])) { //comprobacion insegura

    //Inicializacion de parametros de conexion
    $host = 'localhost';
    $username = 'root';         //INSEGURO nunca acceder como root
    $password = '';             //INSEGURO
    $database = 'login-php';

    //establecimiento de conexion
    $my = new mysqli($host, $username, $password, $database);

    if ($my->connect_error) {
        $_SESSION['error'] = "No se puede comprobar el usuario";
        header('Location:./index.php');
    }

    //HAY QUE COMPROBAR SI HUBO INTENTO DE XSS Y CONTESTAR CON MENSAJE DE ERROR
    $username = htmlspecialchars($_POST['user']);
    $password = htmlspecialchars($_POST['pass']);

    //QUERY
    $querySQL = "SELECT * FROM users WHERE iduser = '$username'";

    $resultado = $my->query($querySQL);

    if ($resultado->num_rows == 0) { //user inexistente
        $_SESSION['error'] = "Usuario incorrecto";
        header('Location:./index.php'); // que lo vuelva a intentar
    } else { //user encontrado
        $row = mysqli_fetch_object(($resultado));
        //Comprobar si la pass coincide


        if ($row->password == $password) {

            //Cojo los datos del usuario y los envio como var sesion.
            $_SESSION['nombre'] = $row->nombre;
            $_SESSION['apellidos'] = $row->apellidos;

            header("Location:./inicio.php"); //entra en la app
        } else {
            $_SESSION['error'] = "Contraseña incorrecta";
            header("Location:./index.php");
        }
        //Libera la conexion con la BD
        $my->close();
    }

    //REDIRECCIONAR SI PASS O USER ES INCORRECTO
    //SI TODO ES CORRECTO A INICIO.PHP
    echo $username . ": " . $password;
    echo "<br>Conexion establecida";
} else {
    $_SESSION['error'] = "Debes hacer login para acceder, contenido sensible";
    header('Location:./index.php');
}
