<?php
session_start(); //seguridad

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

echo "Conexion establecida";