<?php
include "establecer-sesion.php";
// 1. Vaciar variables de sesión
$_SESSION = [];
//Destruir de manera explicita la cookie de sesion y otras cookies potencialmente peligrosas.
if (isset($_COOKIE[session_name()])) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
}
// 3. Destruir la sesión
session_destroy();
// 4. Redirigir
header("Location: ./index.php");
