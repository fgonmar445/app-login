<?php

include "establecer-sesion.php";

$_SESSION = [];
session_destroy();
header("Location: ./index.php");
