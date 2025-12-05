<?php

include "establecer-sesion.php";

$_SESSION = [];
//Destruir de manera explicita la cookie de sesion y otras cookies potencialmente peligrosas.
if (isset($_COOKIE[session_name()])) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', 1, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
}
session_destroy();
header("Location: ./index.php");
