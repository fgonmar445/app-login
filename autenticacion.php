<?php
session_start(); //seguridad

if (isset($_POST['user']) && isset($_POST['pass'])) {

    //Inicializacion de parametros de conexion
    $host = 'localhost';
    $username = 'root';         //INSEGURO
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
    //REDIRECCIONAR SI PASS O USER ES INCORRECTO
    //SI TODO ES CORRECTO A INICIO.PHP
    echo $username . ": " . $password;
    echo "<br>Conexion establecida";
} else {
    $_SESSION['error'] = "Debes hacer login para acceder, contenido sensible";
    header('Location:./index.php');
}
